<?php
	session_start();
	
	include "koneksi.php";

	$kode_transaksi=$_POST["kode_transaksi"];
	$status=$_POST["status"];

	$query=mysqli_query($koneksi,"UPDATE transaksi SET status='$status' WHERE kode_transaksi='$kode_transaksi'")
	or die(mysqli_error($koneksi));

	if($query){
		{
			$_SESSION['alert']="Status dari $kdoe_transaksi berhasil diubah";
			header("Location: ../admin_jadwal_reservasi.php");
		}
	}else{
		echo 'gagal';
	}
?>