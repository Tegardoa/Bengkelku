<?php
	session_start();

	include 'koneksi.php';
	
	$username=$_POST['username'];
	$password=md5($_POST['password']);
	$nama=$_POST['nama'];
	$tgl_lahir=$_POST['tgl_lahir'];
	$jk=$_POST['jk'];
	$no_telp=$_POST['no_telp'];
	$alamat=$_POST['alamat'];
	$block="Tidak";

	$query=mysqli_query($koneksi,"UPDATE user SET nama='$nama',password='$password',tgl_lahir='$tgl_lahir',jk='$jk',no_telp='$no_telp',alamat='$alamat' WHERE username='$username'")
		or die(mysqli_error($koneksi));

	if($query){
		$_SESSION['alert']="Profil Berhasil Diubah";
		header("Location: ../profil.php");
	}else {
		echo "Gagal";
	}
?>