<!DOCTYPE html>
<?php
	session_start();
?>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bengkel.css">
	<script src="js/uikit.min.js"></script>
	<script src="js/uikit-icons.min.js"></script>
	<title>Andy Yudithio</title>
</head>

<body>

<nav class="uk-navbar-container" style="background-color:rgb(30,135,240);" uk-navbar>
    <div class="uk-navbar-left">
        <ul class="uk-navbar-nav">
            <li class="uk-active"><a href="index.php" style="color:white; padding:30px; font-size: 40px;font-family:rockwell;">Bengkel Ku</a></li></li>
            <?php
                if(empty($_SESSION["username"])){
                    echo "<li><a href='jadwal_service.php' style='color:white'>Lihat Jadwal Service</a></li>";
                }elseif(isset($_SESSION["username"])){
                    echo "<li><a href='pesan_jadwal_service.php' style='color:white'>Reservasi Jadwal Service</a></li>";
                    echo "<li><a href='reservasi_aktif.php' style='color:white;'>Reservasi Service Aktif</a></li>";
                }
            ?>
        </ul>
    </div>
	
	<div class="uk-navbar-right">
        <ul class="uk-navbar-nav">
            <li>
                <?php 
                    if(empty($_SESSION["username"])){
                        echo "<a href='#'' class='uk-icon-link uk-margin-small-left' uk-icon='user' style='color:white; padding-right:80px;'>Akun</a>";
                    }elseif(isset($_SESSION["username"])){
                        $akun = $_SESSION["username"];
                        echo "<a href='#' class='uk-icon-link uk-margin-small-left' uk-icon='user' style='color:white; padding-right:80px;'>Hai, $akun</a>";
                    }
                ?>
                <div class="uk-navbar-dropdown">
                    <ul class="uk-nav uk-navbar-dropdown-nav">
                        <?php
                            if(empty($_SESSION["username"])){
                                echo "<li class='uk-active'><a href='login.php'>Masuk</a></li>";
						        echo "<li class='uk-active'><a href='daftar.php'>Daftar</a></li>";
                            }elseif(isset($_SESSION["username"])){
                                echo "<li class='uk-active'><a href='profil.php'>Profil Akun</a></li>";
                                echo "<li class='uk-active'><a href='profil_motor.php'>Data Motor</a></li>";
                                echo "<li><hr></li>";
                                echo "<li class='uk-active'><a href='action/act_logout.php'>Keluar</a></li>";

                            }
                        ?>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>

<center>
<div class="uk-container" style="padding-top:30px">

    <div class="uk-tile uk-tile-primary">
            <p class="uk-h1" style="font-family:rockwell;">Selamat Datang di<br>BENGKELKU</p>
    </div>

    <div class="uk-tile uk-tile-muted">
            <p class="uk-h5" style="font-family:rockwell;">BENGKELKU merupakan sistem reservasi jadwal service motor berbasis web.<br></p>
    
            <p align=left class="uk-h5" style="font-family:rockwell; padding-left:80px;">Cara melakukan reservasi jadwal service cukup mudah :
                <br>&emsp;1. Daftar dan Login Akun
                <br>&emsp;2. Isi Data Motor
                <br>&emsp;3. Pilih Jadwal yang Tersedia
                <br>&emsp;4. Reservasi Berhasil
                <br>&emsp;5. Datanglah ke Bengkel dengan Motor yang Direservasikan Sebelumnya
            </p>
    </div>
</div>
</center>

</body>
</html>