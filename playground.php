<?php
print "THIS IS MY PLAYGROOOOOUND!!!<br>";

$ip_acc = $_SERVER["REMOTE_ADDR"];
	$shinjuku = gethostbynamel('shinjuku-office.jawhmnet.com');
	$osaka = gethostbynamel('osaka-office.jawhmnet.com');
	$nagoya = gethostbynamel('nagoya-office.jawhmnet.com');
	$fukuoka = gethostbynamel('fukuoka-office.jawhmnet.com');

echo $ip_acc ."<br>";
echo $shinjuku[0] ."<br>";
echo $osaka[0] . "<br>";
echo $nagoya[0] . "<br>";
echo $fukuoka[0] . "<br>";


?>