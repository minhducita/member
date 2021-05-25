<?php
ini_set( 'display_errors', 1 );
date_default_timezone_set('Asia/Tokyo');

mb_language("Japanese");
mb_internal_encoding("UTF-8");




$to = "masaki@sumimasa.com";
$subject = "サブジェクトの日本語大丈夫かなぁ？";
$message = "こんにちわ。ワーホリ協会からメールを送ってますよ is TEST.\r\nHow are you?";
$headers = "From: info@jawhm.or.jp";
mb_send_mail($to, $subject, $message, $headers); 



echo ('done');

?>
