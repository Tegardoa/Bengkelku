<?php
	session_start();

	include 'koneksi.php';
	
	$username=$_POST['username'];
	$nama=$_POST['nama'];
	$tgl_lahir=$_POST['tgl_lahir'];
	$jk=$_POST['jk'];
	$no_telp=$_POST['no_telp'];
	$alamat=$_POST['alamat'];

	$query=mysqli_query($koneksi,"UPDATE user SET nama='$nama',tgl_lahir='$tgl_lahir',jk='$jk',no_telp='$no_telp',alamat='$alamat' WHERE username='$username'")
		or die(mysqli_error($koneksi));

	if($query){
		$_SESSION['alert']="Profil Berhasil Diubah";
		header("Location: ../admin_profil_user.php?username=$username");
	}else {
		echo "Gagal";
	}
?>