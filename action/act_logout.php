<?php
	session_start();
	
	unset($_SESSION["username"]);
	unset($_SESSION["alert"]);
	header("Location: ../index.php");
?>