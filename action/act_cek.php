<?php
	if(empty($_SESSION["username"])){
		$_SESSION["alert"]="Anda harus login terlebih dahulu";
		header("Location: ../login.php");
	}
?>