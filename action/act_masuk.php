<?php
	session_start();
	
	include "koneksi.php";

	$username=$_POST["username"];
	$username=str_replace("'","", $username);
	$password=str_replace("'","",$_POST["password"]);
	$password=md5($_POST["password"]);

	$query=mysqli_query($koneksi,"SELECT * FROM user WHERE username='$username' AND password='$password'")
	or die(mysqli_error($koneksi));

	$queryblock=mysqli_query($koneksi,"SELECT * FROM user WHERE username='$username' and block='Ya'")
	or die(mysqli_error($koneksi));

	$querymotor=mysqli_query($koneksi,"SELECT * FROM motor WHERE username='$username'")
	or die(mysqli_error($koneksi));
	
	if($data=mysqli_fetch_array($query)){
		if(mysqli_num_rows($queryblock)==1){
			$_SESSION["alert"]="Maaf akun anda telah terblokir, silahkan datang ke bengkel bagian administrasi untuk membuka blokir ";
			header("Location: ../login.php");
		}else{
			$_SESSION["username"]=$data["username"];
			if(mysqli_num_rows($querymotor)==0){
				$_SESSION["alert"]="Silahkan isi data motor";
				header("Location: ../profil_motor.php");
			}else{
				header("Location: ../index.php");
			}
		}
	}else {
		$_SESSION["alert"]="Username atau Password Salah";
		header("Location: ../login.php");
	}
?>