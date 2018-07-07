<?php
	if(empty($_SESSION["username_adm"])){
		$_SESSION["alert"]="Anda harus login terlebih dahulu";
		header("Location: ../index.php");
	}
?>