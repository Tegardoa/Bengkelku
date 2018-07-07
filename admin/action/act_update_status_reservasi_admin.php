<?php
	session_start();
	
	include "koneksi.php";

	$username=$_GET["username"];
	$tanggal=$_GET["tanggal"];
	$no_polisi=$_GET["no_polisi"];
	$status=$_POST["status"];

	$query=mysqli_query($koneksi,"UPDATE transaksi SET status='$status' WHERE username='$username' and tanggal='$tanggal' and no_polisi='$no_polisi'")
	or die(mysqli_error($koneksi));

	if($query){
		{
			$_SESSION['alert']="Status dari $username dengan nomor polisi $no_polisi pada tanggal $tanggal telah diubah";
			header("Location: ../admin_jadwal_reservasi.php");
		}
	}else{
		echo 'gagal';
	}
?>