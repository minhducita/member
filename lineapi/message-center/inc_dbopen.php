<?php

	$link = mysqli_connect('jawhm-member.cekhenpprsiu.us-west-2.rds.amazonaws.com', 'lineapi', 'Mhwaj303pitt$ST', 'lineapi');
	if (mysqli_connect_errno()) {
	    die("�f�[�^�x�[�X�ɐڑ��ł��܂���:" . mysqli_connect_error() . "\n");
	}
	mysqli_query($link, 'SET NAMES utf8');

?>