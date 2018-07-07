<?php
	session_start();
	
	include "koneksi.php";

	$username=$_GET["username"];

	$query=mysqli_query($koneksi,"UPDATE user SET block='Blocked' WHERE username='$username'")
	or die(mysqli_error($koneksi));

	if($query){
		{
			$_SESSION['alert']="$username telah diblock";
			header("Location: ../admin_block_user.php");
		}
	}else{
		echo 'gagal';
	}
?>