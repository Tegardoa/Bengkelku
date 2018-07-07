<?php
	session_start();
	
	include "koneksi.php";

	$username_adm=$_POST["username_adm"];
	$username_adm=str_replace("'","", $username_adm);
	$password_adm=str_replace("'","",$_POST["password_adm"]);
	$password_adm=md5($_POST["password_adm"]);

	$query=mysqli_query($koneksi,"SELECT * FROM admin WHERE username_adm='$username_adm' AND password_adm='$password_adm'")
	or die(mysqli_error($koneksi));


	
	if($data=mysqli_fetch_array($query)){
		$_SESSION["alert"]="Selamat datang $username_adm";
		$_SESSION["username_adm"]=$data["username_adm"];
		header("Location: ../admin_index.php");
	}else{
		$_SESSION["alert"]="Username atau Password Salah";
		header("Location: ../index.php");
	}
?>