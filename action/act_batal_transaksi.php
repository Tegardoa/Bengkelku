<?php
	session_start(); 

	include 'koneksi.php';
	$kode_transaksi=$_GET['kode_transaksi'];
	
	$query=mysqli_query($koneksi,"UPDATE transaksi set status='Batal' WHERE kode_transaksi='$kode_transaksi'")
		or die(mysqli_error($koneksi));
	
	if($query){
		$_SESSION['alert']="Reservasi berhasil dibatalkan";
		header("Location: ../reservasi_aktif.php");
	}else {
		echo "Gagal";
	}
?>