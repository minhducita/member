<?php
	if(isset($_GET["FUKA"])){
		$target_type = "card";
		require "check.php";
	}else{
		require "check.php";
	}
?>