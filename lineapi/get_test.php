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

echo 'start<br/>';





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

echo fncGetCd(128);
echo '<hr/>';
echo fncGetCd(256);
echo '<hr/>';






		// イメージファイル取得
		$cnt = 0;
		$query = "SELECT * FROM t_msg WHERE msg_type = 'image' and line_type = 'message' and mtype = 'hook' and msg = '' ORDER by id LIMIT 1";

		if ($result = mysqli_query($link, $query)) {
			foreach ($result as $row) {
				$id = $row['id'];
				$rsv_json = $row['rsv_json'];

				$msg_data = json_decode($rsv_json, true);
				$cont_id = $msg_data["message"]["id"];
				$file_name = $id."_".$cont_id.".png";

echo $cont_id;
echo '<hr/>';
echo $file_name;

				$rsv_data = $client->getContent($cont_id);

				$fp = fopen('./rsv_img/'.$file_name, 'w');
				fwrite($fp, $rsv_data);
				fclose($fp);



				// 状態変更
				$upd_t_msg  = "UPDATE t_msg SET ";
				$upd_t_msg .= "  msg = 'https://member.jawhm.or.jp/lineapi/rsv_img/".$file_name."'";
				$upd_t_msg .= " ,upd_date = '".date("Y-m-d H:i:s")."'";
				$upd_t_msg .= " WHERE id = '$id'";
				if (mysqli_query($link, $upd_t_msg)) {
				    echo "update at T_MSG\n";
				}else{
			            error_log('Sql error : ' . $upd_t_msg);
				}

			}
		}

/*

echo '<hr/>';

	$rsv_data = $client->getContent("12228348488570");


//var_dump($rsv_data);
echo '<hr/>';


$fp = fopen('./rsv_img/sample.png', 'w');
fwrite($fp, $rsv_data);
fclose($fp);



*/


echo 'end<br/>';


include "/var/www/html/lineapi/inc_dbclose_jawhm.php";

