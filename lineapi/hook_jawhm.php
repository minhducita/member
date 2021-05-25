<?php

ini_set( 'display_errors', 1 );
date_default_timezone_set('Asia/Tokyo');

function fncGetCd($length = 8)	{
    $gen_text  = '';
    $gen_text .= uniqid();
    $gen_text .= base_convert(hash('sha256', uniqid()), 16, 36);
    $gen_text .= base_convert(hash('md5', uniqid()), 16, 36);
    $gen_text .= uniqid();
    $gen_text .= base_convert(hash('sha256', uniqid()), 16, 36);
    $gen_text .= base_convert(hash('md5', uniqid()), 16, 36);
    return substr($gen_text, 0, $length);
}

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

$channelAccessToken = '/012QstLq7n6B6pbY6/btf9YugCaEoSbs23cL0rYlZfvwKj88yRbpQjcJeCh6OxQdqrO9Ro+ajktrcYezpmRa4d9pTJR3vUuW73CL3mCsLXKU3Tm6hfU+k/jHspJFzT8c9vxyizjpurXkal1rdfpKAdB04t89/1O/w1cDnyilFU=';
$channelSecret = '3ae771cbed73e83cd0418af86e00f1d7';

include "./inc_dbopen_jawhm.php";

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
			//$rep_msg = 'LINE-BOT RSV.';

/*
			$rep_msg  = '';
			$rep_msg .= 'メッセージありがとうございます。（このメッセージは本番稼働時には表示しません）';

			$client->replyMessage([
				'replyToken' => $event['replyToken'],
				'messages' => [
				    [
				        'type' => 'text',
				        'text' => $rep_msg,
				    ]
				]
			]);
*/

                    break;
                default:
                    error_log('Unsupported message type: ' . $message['type']);

			$msg = $message['text'];
			$msg_type = $message['type'];

			$rep_msg  = '';
			$rep_msg .= '大変申し訳ありませんが、現在、このタイプのメッセージが受け取れません。'.chr(13);
			$rep_msg .= 'ご質問の場合は、テキストでメッセージをお送りください。';

/*
			$client->replyMessage([
				'replyToken' => $event['replyToken'],
				'messages' => [
				    [
				        'type' => 'text',
				        'text' => $rep_msg,
				    ]
				]
			]);
*/
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
	$upd_m_user .= " upd_date = '".date("Y-m-d H:i:s")."'";

	if ($friend != 0)	{
		$upd_m_user .= " , friend = $friend ";
	}
	if ($friend == 1)	{
		// 友達になった
		$upd_m_user .= " , follow_date = '".date("Y-m-d")."'";
	}
	if ($friend == 9)	{
		// ブロックされた
		$upd_m_user .= " , unfollow_date = '".date("Y-m-d")."'";
	}

	if ($line_type == 'message')	{
		// メッセージ受信の場合
		$upd_m_user .= " , msg_rsv_cnt = msg_rsv_cnt + 1";
		$upd_m_user .= " , msg_rsv = '".date("Y-m-d H:i:s")."'";
		$upd_m_user .= " , msg = 1";
	}

	$upd_m_user .= " WHERE line_user = '$line_user' and status = 1";
	if (mysqli_query($link, $upd_m_user)) {
	    echo "update at M_USER\n";
	}else{
	    error_log('Sql error : ' . $upd_m_user);
	}


	// T_MSG 追加（受信メッセージ）
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


	// T_MSG追加（送信メッセージ）
	if ($rep_msg <> '')	{
		$ins_t_msg  = "INSERT t_msg ( mtype, mstatus, msg, msg_type, line_type, reply_token, line_user, ins_date, upd_date )";
		$ins_t_msg .= " values ( ";
		$ins_t_msg .= " 'auto'";
		$ins_t_msg .= " ,1";
		$ins_t_msg .= " ,'$rep_msg'";
		$ins_t_msg .= " ,'text'";
		$ins_t_msg .= " ,'message'";
		$ins_t_msg .= " ,'$reply_token'";
		$ins_t_msg .= " ,'$line_user'";
		$ins_t_msg .= " ,'".date("Y-m-d H:i:s")."'";
		$ins_t_msg .= " ,'".date("Y-m-d H:i:s")."'";
		$ins_t_msg .= " ) ";
		if (!mysqli_query($link, $ins_t_msg)) {
		        error_log('Sql error : ' . $ins_t_msg);
		}
//		$reply_token = '';
		$rep_msg  = '';
	}

	// キャンペーン確認
	$camp_id = 0;
	$query = "SELECT * FROM m_campaign WHERE entry_text = '".$msg."' and date_from <= '".date("Y-m-d H:i:s")."' and date_to >= '".date("Y-m-d H:i:s")."' order by id";
	if ($result = mysqli_query($link, $query)) {
		foreach ($result as $row) {
			// 対象キャンペーンがある
			$camp_id = $row['id'];
			$camp_name = $row['campaign_name'];
		}
	}
	if ($camp_id <> 0)	{
		// エントリーコード
		$ecd = 'camp'.fncGetCd(124);

		// T_ENTRY_CAMPAGIN 追加
		$ins_t_entry_campagin  = "INSERT t_entry_campaign ( line_user, entry_cd, campaign_id, campaign_name, expire_date, status, ins_date, upd_date) ";
		$ins_t_entry_campagin .= " values ( ";
		$ins_t_entry_campagin .= "  '$line_user'";
		$ins_t_entry_campagin .= " ,'$ecd'";
		$ins_t_entry_campagin .= " ,'$camp_id'";
		$ins_t_entry_campagin .= " ,'$camp_name'";
		$ins_t_entry_campagin .= " ,'".date("Y-m-d H:i:s",strtotime("+31 minute"))."'";
		$ins_t_entry_campagin .= " , 0";
		$ins_t_entry_campagin .= " ,'".date("Y-m-d H:i:s")."'";
		$ins_t_entry_campagin .= " ,'".date("Y-m-d H:i:s")."'";
		$ins_t_entry_campagin .= " ) ";
		if (mysqli_query($link, $ins_t_entry_campagin)) {
		    echo "insert at T_ENTRY_CAMPAIGN\n";
		}else{
		    error_log('Sql error : ' . $ins_t_entry_campagin);
		}

		$rep_msg .= '「'.$camp_name.'」へのご参加ありがとうございます。'.chr(13);
		$rep_msg .= '次のURLからエントリーをお願いします。'.chr(13);
		$rep_msg .= 'https://member.jawhm.or.jp/line/campaign/'.$ecd.chr(13);
		$rep_msg .= 'なおこのURLは３０分後に無効となります。ご注意ください。';
	}

	// CRMデータ連携
	if ($msg == '連動' || $msg == '連携')	{
		$ecd = 'crm'.fncGetCd(125);

		// T_ENTRY_CRM 追加
		$ins_t_entry_crm  = "INSERT t_entry_crm ( line_user, entry_cd, expire_date, status, ins_date, upd_date) ";
		$ins_t_entry_crm .= " values ( ";
		$ins_t_entry_crm .= "  '$line_user'";
		$ins_t_entry_crm .= " ,'$ecd'";
		$ins_t_entry_crm .= " ,'".date("Y-m-d H:i:s",strtotime("+31 minute"))."'";
		$ins_t_entry_crm .= " , 0";
		$ins_t_entry_crm .= " ,'".date("Y-m-d H:i:s")."'";
		$ins_t_entry_crm .= " ,'".date("Y-m-d H:i:s")."'";
		$ins_t_entry_crm .= " ) ";
		if (mysqli_query($link, $ins_t_entry_crm)) {
		    echo "insert at T_ENTRY_CRM\n";
		}else{
		    error_log('Sql error : ' . $ins_t_entry_crm);
		}

		$rep_msg .= '次のURLから、お客様の情報をご入力ください。'.chr(13);
		$rep_msg .= 'https://member.jawhm.or.jp/line/jawhm/'.$ecd.chr(13);
		$rep_msg .= 'なおこのURLは３０分後に無効となります。ご注意ください。';

	}

	// ガイドブック
	if ($msg == 'ガイドブック' || $msg == 'book')	{
		$ecd = 'gb'.fncGetCd(125);

		// T_ENTRY_guidebook 追加
		$ins_t_entry_guidebook  = "INSERT t_entry_guidebook ( line_user, entry_cd, expire_date, status, ins_date, upd_date) ";
		$ins_t_entry_guidebook .= " values ( ";
		$ins_t_entry_guidebook .= "  '$line_user'";
		$ins_t_entry_guidebook .= " ,'$ecd'";
		$ins_t_entry_guidebook .= " ,'".date("Y-m-d H:i:s",strtotime("+31 minute"))."'";
		$ins_t_entry_guidebook .= " , 0";
		$ins_t_entry_guidebook .= " ,'".date("Y-m-d H:i:s")."'";
		$ins_t_entry_guidebook .= " ,'".date("Y-m-d H:i:s")."'";
		$ins_t_entry_guidebook .= " ) ";
		if (mysqli_query($link, $ins_t_entry_guidebook)) {
		    echo "insert at T_ENTRY_GUIDEBOOK\n";
		}else{
		    error_log('Sql error : ' . $ins_t_entry_guidebook);
		}

		$rep_msg .= '次のURLから、お客様の情報をご入力ください。'.chr(13);
		$rep_msg .= 'https://member.jawhm.or.jp/line/guidebook/'.$ecd.chr(13);
		$rep_msg .= 'なおこのURLは３０分後に無効となります。ご注意ください。';

	}


	// ハッシュタグ(
	if ($pos = mb_strpos($msg, "#質問"))	{
		$rep_msg .= 'ご質問を受け付けました。'.chr(13);
		$rep_msg .= 'ありがとうございます！！';
	}
	if ($pos = mb_strpos($msg, "＃質問"))	{
		$rep_msg .= 'ご質問を受け付けました。'.chr(13);
		$rep_msg .= 'ありがとうございます！！';
	}


	// T_MSG追加（送信メッセージ）
	if ($rep_msg <> '')	{
		$ins_t_msg  = "INSERT t_msg ( mtype, mstatus, msg, msg_type, line_type, reply_token, line_user, ins_date, upd_date )";
		$ins_t_msg .= " values ( ";
		$ins_t_msg .= " 'auto'";
		$ins_t_msg .= " ,1";
		$ins_t_msg .= " ,'$rep_msg'";
		$ins_t_msg .= " ,'text'";
		$ins_t_msg .= " ,'message'";
		$ins_t_msg .= " ,'$reply_token'";
		$ins_t_msg .= " ,'$line_user'";
		$ins_t_msg .= " ,'".date("Y-m-d H:i:s")."'";
		$ins_t_msg .= " ,'".date("Y-m-d H:i:s")."'";
		$ins_t_msg .= " ) ";
		if (!mysqli_query($link, $ins_t_msg)) {
		        error_log('Sql error : ' . $ins_t_msg);
		}
//		$reply_token = '';
		$rep_msg  = '';
	}


};

include "./message-center/inc_dbclose.php";

