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

require_once('/var/www/html/lineapi/LINEBotTiny.php');

$channelAccessToken = 'hhvp1mk7y5T+Hd9fhf3GZhhOHND9qMq3I3yf5PtrD6YFTr+o4TJ2paLef0QtJqtg6gmEdeJs5444q0qLPf1iyms2+SlHGP9z83X8CpJPfasvUEb4vXBcEUpLNCUC8d7Rz2/tIYf/6WXAEvIfDL8orQdB04t89/1O/w1cDnyilFU=';
$channelSecret = 'ee177371e605e7134ce3a6a7d94465f7';

include "/var/www/html/lineapi/message-center/inc_dbopen.php";

$client = new LINEBotTiny($channelAccessToken, $channelSecret);


		$cnt = 0;
		$query = "SELECT * FROM t_msg WHERE mtype = 'send' and mstatus = 1 ORDER BY ins_date, id LIMIT 1";

		if ($result = mysqli_query($link, $query)) {
			foreach ($result as $row) {
				$id = $row['id'];
				$msg = $row['msg'];
				$msg_type = $row['msg_type'];
				$line_type = $row['line_type'];
				$line_user = $row['line_user'];

				$pushdata = ([
				    'to' => $line_user,
				    'messages' => [
				        [
				            'type' => $msg_type,
				            'text' => $msg,
				        ]
				    ]
				]);

				$client->pushMessage($pushdata);

				$rsv_json = json_encode($pushdata);
				$rsv_json = mysqli_real_escape_string($link, $rsv_json);

				// 状態変更
				$upd_t_msg  = "UPDATE t_msg SET ";
				$upd_t_msg .= "  mstatus = 2";
				$upd_t_msg .= " ,rsv_json = '$rsv_json'";
				$upd_t_msg .= " ,upd_date = '".date("Y-m-d H:i:s")."'";
				$upd_t_msg .= " WHERE id = '$id'";
				if (mysqli_query($link, $upd_t_msg)) {
				    echo "update at T_MSG\n";
				}else{
		            error_log('Sql error : ' . $upd_t_msg);
				}


			}
		}

include "/var/www/html/lineapi/message-center/inc_dbclose.php";

