<?php
	session_start();

	include 'koneksi.php';
	
	$username=$_SESSION['username'];
	$no_polisi=$_POST['no_polisi'];
	$no_polisi=str_replace(' ', '', $no_polisi);
	$jenis_motor=$_POST['jenis_motor'];
	$merk_motor=$_POST['merk_motor'];
	$nama_motor=$_POST['nama_motor'];

	$querycekjml=mysqli_query($koneksi,"SELECT * from motor where username='$username'") or die(mysqli_error($koneksi));
	if(mysqli_num_rows($querycekjml)==3){
		$_SESSION['alert']="Data motor tidak bisa ditambahkan lagi";
		header("Location: ../profil_motor.php");
	}else{
		$queryceknopol=mysqli_query($koneksi,"SELECT * from motor where no_polisi='$no_polisi'") or die(mysqli_error($koneksi));
		if(mysqli_num_rows($queryceknopol)==1){
			$_SESSION['alert']="Nomor Polisi telah terdaftar, tidak dapat ditambahkan lagi";
			header("Location: ../profil_motor.php");
		}else{
			$query=mysqli_query($koneksi,"INSERT INTO motor (no_polisi,jenis_motor,merk_motor,nama_motor,username) VALUES ('$no_polisi','$jenis_motor','$merk_motor','$nama_motor','$username')") or die(mysqli_error($koneksi));
		
			if($query){
				$_SESSION['alert']="Data Motor Berhasil Ditambahkan";
				header("Location: ../profil_motor.php");
			}else{
				echo "Gagal";
			}
		}
	}
?>