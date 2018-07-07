<?php
	session_start();

	include 'koneksi.php';
	
	$username=$_POST['username'];
	$username=str_replace("'","",$username);
	$password=str_replace("'","",$_POST["password"]);
	$password=md5($_POST['password']);
	$nama=$_POST['nama'];
	$tgl_lahir=$_POST['tgl_lahir'];
	$jk=$_POST['jk'];
	$no_telp=$_POST['no_telp'];
	$alamat=$_POST['alamat'];
	$block="Tidak";

	$querycek=mysqli_query($koneksi,"SELECT username from user where username='$username'") or die(mysqli_error($koneksi));
	if (mysqli_num_rows($querycek)==1){
		$_SESSION["alert"]="Username telah digunakan";
		header("Location: ../daftar.php");
	}else{
	
		$query=mysqli_query($koneksi,"INSERT INTO user (username,password,nama,tgl_lahir,jk,no_telp,alamat,block) VALUES ('$username','$password','$nama','$tgl_lahir','$jk','$no_telp','$alamat','$block')") or die(mysqli_error($koneksi));
		
		if($query){
			$querylogin=mysqli_query($koneksi,"SELECT * FROM user WHERE username='$username' AND password='$password'") or die(mysqli_error($koneksi));
			if($data=mysqli_fetch_array($querylogin)){
				$_SESSION['alert']="Akun telah berhasil dibuat, silahkan mengisi data motor";
				$_SESSION['username']=$data['username'];
				header("Location: ../profil_motor.php");
			}
		}else{
			echo "Gagal";
		}
	}
?>