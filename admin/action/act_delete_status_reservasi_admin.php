<?php
	session_start();
	
	include "koneksi.php";

	$kode_transaksi=$_GET["kode_transaksi"];

	$query=mysqli_query($koneksi,"DELETE from transaksi WHERE kode_transaksi='$kode_transaksi'")
	or die(mysqli_error($koneksi));

	if($query){
		{
			$_SESSION['alert']="Transaksi dengan kode $kode_transaksi telah dihapus";
			header("Location: ../admin_jadwal_reservasi.php");
		}
	}else{
		echo 'gagal';
	}
?>