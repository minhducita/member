<?php

ini_set( 'display_errors', 1 );
date_default_timezone_set('Asia/Tokyo');

	$dat_act = @$_POST['act'];
	$dat_id = @$_POST['id'];
	if ($dat_act == '')	{
		$dat_act = @$_GET['act'];
		$dat_id = @$_GET['id'];
	}

	include './inc_header.php';

?>
<body>

<input type="button" value="このページを再読込します" onclick="window.location.reload();" />

<h1><a href="./index.php">メッセージセンター</a></h1>

<div class="block_main">

