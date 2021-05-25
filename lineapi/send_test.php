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


				$msg = '$ LINE emoji $';



				$msg_type = 'text';
				$line_type = 'message';
				$line_user = 'Ud12fd847bebfac765c4e44c6749b75e7';

				$pushdata = ([
				    'to' => $line_user,
				    'messages' => [
				        [
				            'type' => $msg_type,
				            'text' => $msg,


						'emojis' => [
						      [
						        'index' => 0,
						        'productId' => '5ac1bfd5040ab15980c9b435',
						        'emojiId' => '001'
						      ],
						      [
						        'index' => 13,
						        'productId' => '5ac1bfd5040ab15980c9b435',
						        'emojiId' => '001'
						      ],
						]

				        ]
				    ]
				]);

				var_dump($client->pushMessage($pushdata));

				$rsv_json = json_encode($pushdata);

var_dump($rsv_json);

				$rsv_json = mysqli_real_escape_string($link, $rsv_json);


include "/var/www/html/lineapi/inc_dbclose_jawhm.php";

