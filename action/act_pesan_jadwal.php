<?php
	session_start();

	include 'koneksi.php';
	
	$kode_transaksi=uniqid();

	$queryid=mysqli_query($koneksi,"SELECT kode_transaksi from transaksi where kode_transaksi='$kode_transaksi'") or die(mysqli_error($koneksi));
	while(mysqli_num_rows($queryid)!=0){
		$kode_transaksi=uniqid();
	}

	$tanggal=$_POST['tanggal'];
	$waktu=$_POST['waktu'];
	$kode_jadwal=mysqli_query($koneksi,"SELECT kode_jadwal from jadwal where waktu='$waktu'") or die(mysqli_error($koneksi));
	$row=mysqli_fetch_row($kode_jadwal);
	$kode_jadwal=$row[0];

	$username=$_SESSION['username'];
	$no_polisi=$_POST['no_polisi'];
	$status="Belum";

	$querycekjml=mysqli_query($koneksi,"SELECT * from transaksi where kode_jadwal='$kode_jadwal' and tanggal='$tanggal'");
	if(mysqli_num_rows($querycekjml)>=5){
		$_SESSION["alert"]="Maaf reservasi pada tanggal $tanggal dan pukul $waktu telah penuh, silahkan reservasi di lain waktu";
		header("Location: ../pesan_jadwal_service.php");
	}else{
		$querycek=mysqli_query($koneksi,"SELECT username,tanggal,no_polisi from transaksi where username='$username' and tanggal='$tanggal' and no_polisi='$no_polisi'") or die(mysqli_error($koneksi));
		if (mysqli_num_rows($querycek)>=1){
			$_SESSION["alert"]="Motor telah terdaftar pada tanggal $tanggal ini, silahkan reservasi di lain hari";
			header("Location: ../pesan_jadwal_service.php");
		}else{
	
			$query=mysqli_query($koneksi,"INSERT INTO transaksi (kode_transaksi,tanggal,kode_jadwal,username,no_polisi,status) VALUES ('$kode_transaksi','$tanggal','$kode_jadwal','$username','$no_polisi','$status')") or die(mysqli_error($koneksi));
		
			if($query){
				$_SESSION['alert']="Pesanan berhasil";
				header("Location: ../reservasi_aktif.php");
			}else{
				echo "Gagal";
			}
		}
	}
?>