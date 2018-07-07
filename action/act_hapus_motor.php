<?php
	session_start(); 

	include 'koneksi.php';
	$no_polisi=$_GET['no_polisi'];
	
	$query=mysqli_query($koneksi,"DELETE FROM motor WHERE no_polisi='$no_polisi'")
		or die(mysqli_error($koneksi));
	
	if($query){
		$_SESSION['alert']="Data Motor Berhasil Dihapus";
		header("Location: ../profil_motor.php");
	}else {
		echo "Gagal";
	}
?>