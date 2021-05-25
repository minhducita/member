<?php

	$ini = parse_ini_file('../bin/pdo_mail_list.ini', FALSE);
	$db = new PDO($ini['dsn'], $ini['user'], $ini['password']);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->query('SET CHARACTER SET utf8');
	if($db){
		echo "success PDO";
	}else{		
		echo "failed PDO";
	}	
	
	$sql = "insert into memlist (namae,furigana) values ('‚Í‚¢','ƒnƒC')";
	$exe=$db->prepare($sql);
	$exe->execute();


?>