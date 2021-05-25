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

$channelAccessToken = '/012QstLq7n6B6pbY6/btf9YugCaEoSbs23cL0rYlZfvwKj88yRbpQjcJeCh6OxQdqrO9Ro+ajktrcYezpmRa4d9pTJR3vUuW73CL3mCsLXKU3Tm6hfU+k/jHspJFzT8c9vxyizjpurXkal1rdfpKAdB04t89/1O/w1cDnyilFU=';
$channelSecret = '3ae771cbed73e83cd0418af86e00f1d7';

include "/var/www/html/lineapi/inc_dbopen_jawhm.php";

$client = new LINEBotTiny($channelAccessToken, $channelSecret);


		// ユーザ情報取得
		$cnt = 0;
		$query = "SELECT * FROM m_user WHERE status = 1 and friend = 1 and displayname is null ORDER BY id LIMIT 1";

		if ($result = mysqli_query($link, $query)) {
			foreach ($result as $row) {
				$id = $row['id'];
				$line_user = $row['line_user'];


				$rsv_json = $client->getProfile($line_user);
				$rsv_data = json_decode($rsv_json, true);

var_dump($rsv_data);
				$displayName	= @$rsv_data["displayName"];
				$pictureUrl	= @$rsv_data["pictureUrl"];
				$statusMessage	= @$rsv_data["statusMessage"];

				$displayName	= mysqli_real_escape_string($link, $displayName);
				$pictureUrl	= mysqli_real_escape_string($link, $pictureUrl);
				$statusMessage	= mysqli_real_escape_string($link, $statusMessage);


				// 状態変更
				$upd_m_user  = "UPDATE m_user SET ";
				$upd_m_user .= "   displayname = '".$displayName."'";
				$upd_m_user .= ' , pictureurl = "'.$pictureUrl.'"';
				$upd_m_user .= ' , statusmessage = "'.$statusMessage.'"';
				$upd_m_user .= " , profilegetdate = '".date("Y-m-d H:i:s")."'";
				$upd_m_user .= " , upd_date = '".date("Y-m-d H:i:s")."'";
				$upd_m_user .= " WHERE line_user = '$line_user'";
				if (mysqli_query($link, $upd_m_user)) {
				    echo "update at M_USER\n";
				}else{
			            error_log('Sql error : ' . $upd_m_user);

var_dump($upd_m_user);

				}
			}
		}


include "/var/www/html/lineapi/inc_dbclose_jawhm.php";

