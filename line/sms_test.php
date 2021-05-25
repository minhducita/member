<?php


ini_set( 'display_errors', 1 );
date_default_timezone_set('Asia/Tokyo');
include "../lineapi/inc_dbopen_jawhm.php";


require "/home/ec2-user/vendor/autoload.php";

use Aws\Sns\SnsClient; 
use Aws\Exception\AwsException;



$SnSclient = new SnsClient([
    'credentials' => [
        'key'    => 'AKIA45VRJ2LQYT7EOFEK',
        'secret' => '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',
    ],
    'region' => 'ap-northeast-1',
    'version' => '2010-03-31'
]);

//    'region' => 'us-east-1',



$message = '[JAWHM]ワンタイムパスワード：123456'.chr(13).'※パスワードは３０分間有効です'.chr(13);
$message .= 'ながーーぃめっせーじを送った場合にどうなるのかを検証してみようとおもいます。'.chr(13);
$message .= 'そして、URLは、どのように表示されるのか？？ https://online.jawhm.or.jp '.chr(13);
$message .= '日本ワーキングホリデー協会では、LINE公式アカウントによる情報配信を始めることとなりました。'.chr(13);
$message .= 'そこで、皆様には、ぜひともLINE公式アカウントのご登録をお願いします。';

//$phone = '+819094117165';
$phone = '+819010411769';
//$phone = '+818095690738';

try {
    $result = $SnSclient->publish([
        'Message' => $message,
        'PhoneNumber' => $phone,
    ]);
    var_dump($result);
} catch (AwsException $e) {
    // output error message if fails
    error_log($e->getMessage());
} 



?>
