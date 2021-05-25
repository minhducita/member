<?php
	echo date("Y-m-d h:i:s")."<br>";
	
	$host = 'jawhm-member.cekhenpprsiu.us-west-2.rds.amazonaws.com';
	$user = 'admin';
	$password = 'Mhwaj303pitt$ST';
	$database = 'member';
	
	mysqli_connect($host,$user,$password,$database) or die("Error MySQL First Test");
	echo "Success MySQL First Test";
?>
