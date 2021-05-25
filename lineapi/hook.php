<?php

ini_set( 'display_errors', 1 );
date_default_timezone_set('Asia/Tokyo');

/**
 * Copyright 2016 LINE Corporation
 *
 * LINE Corporation licenses this file to you under the Apache License,
 * version 2.0 (the "License"); you may not use this file except in compliance
 * with the License. You may obtain a copy of the License at:
 *
 *   https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

require_once('./LINEBotTiny.php');

$channelAccessToken = 'hhvp1mk7y5T+Hd9fhf3GZhhOHND9qMq3I3yf5PtrD6YFTr+o4TJ2paLef0QtJqtg6gmEdeJs5444q0qLPf1iyms2+SlHGP9z83X8CpJPfasvUEb4vXBcEUpLNCUC8d7Rz2/tIYf/6WXAEvIfDL8orQdB04t89/1O/w1cDnyilFU=';
$channelSecret = 'ee177371e605e7134ce3a6a7d94465f7';

include "./message-center/inc_dbopen.php";

$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {


	// log.php出力用（テストロジック）
	$file = './log.php';
	$current = file_get_contents($file);
	$current .= date('Y-m-d H:i:s')."\n";
	$current .= json_encode($event)."\n\n";
	file_put_contents($file, $current);

	// sql用データ
	$msg = "";
	$msg_type = "";
	$rsv_json = json_encode($event);
	$line_type = $event['type'];
	$reply_token = "";
	$line_user = "";

	$friend = 0;


    switch ($event['type']) {
        case 'follow':
			$reply_token = $event['replyToken'];
			$line_user = $event['source']['userId'];
			$friend = 1;
            break;
        case 'unfollow':
			$line_user = $event['source']['userId'];
			$friend = 9;
            break;
        case 'message':
			$reply_token = $event['replyToken'];
			$line_user = $event['source']['userId'];

            $message = $event['message'];
            switch ($message['type']) {
                case 'text':
					$msg = $message['text'];
					$msg_type = $message['type'];

					// ここから、本番稼働時はコメントアウトすること
					$rep_msg = 'LINE-BOT RSV.';
                    $client->replyMessage([
                        'replyToken' => $event['replyToken'],
                        'messages' => [
                            [
                                'type' => 'text',
                                'text' => $rep_msg,
                            ]
                        ]
                    ]);

                    break;
                default:
                    error_log('Unsupported message type: ' . $message['type']);
                    break;
            }
            break;
        default:
            error_log('Unsupported event type: ' . $event['type']);
            break;
    }


	// インジェクション対応
	$msg			= mysqli_real_escape_string($link, $msg);
	$line_type		= mysqli_real_escape_string($link, $line_type);
	$msg_type		= mysqli_real_escape_string($link, $msg_type);
	$rsv_json		= mysqli_real_escape_string($link, $rsv_json);
	$reply_token	= mysqli_real_escape_string($link, $reply_token);
	$line_user		= mysqli_real_escape_string($link, $line_user);

	if ($friend != 0)	{

		// M_USERのレコードあるかなぁ
		$cnt = 0;
		$query = "SELECT count(id) as cnt FROM m_user WHERE line_user = '$line_user' and status = 1";
		if ($result = mysqli_query($link, $query)) {
			foreach ($result as $row) {
				$cnt = $row['cnt'];
			}
		}
		if ($cnt == 0)	{
			// M_USER 追加
			$ins_m_user  = "INSERT m_user ( line_user, status, ins_date, upd_date )";
			$ins_m_user .= " values ( ";
			$ins_m_user .= "  '$line_user'";
			$ins_m_user .= " ,1";
			$ins_m_user .= " ,'".date("Y-m-d H:i:s")."'";
			$ins_m_user .= " ,'".date("Y-m-d H:i:s")."'";
			$ins_m_user .= " ) ";
			if (mysqli_query($link, $ins_m_user)) {
			    echo "insert at M_USER\n";
			}else{
	            error_log('Sql error : ' . $ins_m_user);
			}
		}

		// 状態変更
		$upd_m_user  = "UPDATE m_user SET ";
		$upd_m_user .= "  friend = $friend ";
		if ($friend == 1)	{
			// 友達になった
			$upd_m_user .= " , follow_date = '".date("Y-m-d")."'";
		}
		if ($friend == 9)	{
			// ブロックされた
			$upd_m_user .= " , unfollow_date = '".date("Y-m-d")."'";
		}
		$upd_m_user .= " ,upd_date = '".date("Y-m-d H:i:s")."'";
		$upd_m_user .= " WHERE line_user = '$line_user' and status = 1";
		if (mysqli_query($link, $upd_m_user)) {
		    echo "update at M_USER\n";
		}else{
            error_log('Sql error : ' . $upd_m_user);
		}

	}

	// T_MSG 追加
	$ins_t_msg  = "INSERT t_msg ( mtype, mstatus, msg, msg_type, line_type, rsv_json, reply_token, line_user, ins_date, upd_date )";
	$ins_t_msg .= " values ( ";
	$ins_t_msg .= " 'hook'";
	$ins_t_msg .= " ,2";
	$ins_t_msg .= " ,'$msg'";
	$ins_t_msg .= " ,'$msg_type'";
	$ins_t_msg .= " ,'$line_type'";
	$ins_t_msg .= " ,'$rsv_json'";
	$ins_t_msg .= " ,'$reply_token'";
	$ins_t_msg .= " ,'$line_user'";
	$ins_t_msg .= " ,'".date("Y-m-d H:i:s")."'";
	$ins_t_msg .= " ,'".date("Y-m-d H:i:s")."'";
	$ins_t_msg .= " ) ";
	if (mysqli_query($link, $ins_t_msg)) {
	    echo "insert at T_MSG\n";
	}else{
        error_log('Sql error : ' . $ins_t_msg);
	}

};

include "./message-center/inc_dbclose.php";

