<?php
		if (isset($_GET['k']))	{
	        $redirection='../mobileform/member_form.php?k='.$_GET['k'];
		}else{
	        $redirection='../mobileform/member_form.php';
		}
        require 'memberscript.php';
?>
