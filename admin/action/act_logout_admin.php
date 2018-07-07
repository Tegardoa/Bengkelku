<?php
	session_start();
	
	unset($_SESSION["username_adm"]);
	unset($_SESSION["alert"]);
	header("Location: ../index.php");
?>