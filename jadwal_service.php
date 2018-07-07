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

<div class="uk-container" style="padding-top:25px;">
    <?php
        include "action/act_alert.php";
    ?>
    <h2>Jadwal Service Motor</h2>
    <div class="uk-container">
        <div class="uk-margin">
            <form class="uk-form-stacked" action="#" method="POST" <?php if(isset($_POST['tanggal'])){ echo "hidden";}else{} ?>>
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">Lihat Tanggal</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="form-stacked-text" type="date" name="tanggal" min="<?php echo date('Y-m-d',strtotime('+1 day'));?>" max="<?php echo date('Y-m-d',strtotime('+7 day'));?>" required>
                    </div>
                </div>
                <?php
                if(isset($_POST['tanggal'])){
                }else{
                echo "<div class='uk-margin'>
                        <button class='uk-button uk-button-primary' type='submit' name='button'>Submit</button>
                    </div>";}
                ?>
            </form>
            
            <form class="uk-form-stacked" action="#" method="POST" <?php if(isset($_POST['tanggal'])){}else{ echo "hidden";} ?>>
                <label class="uk-form-label" for="form-stacked-text">Status Reservasi</label>
                <table class="uk-table uk-table-divider uk-table-hover">
                    <thead>
                        <tr>
                            <th><center>09.00 WIB</center></th>
                            <th><center>11.00 WIB</center></th>
                            <th><center>13.00 WIB</center></th>
                            <th><center>15.00 WIB</center></th>
                        </tr>
                    </thead>
            
                    <tbody>
                        <?php
                            include 'action/koneksi.php';
                            $tanggal=$_POST['tanggal'];
                            
                            $data=mysqli_query($koneksi,"SELECT * FROM transaksi where tanggal='$tanggal'") or die(mysqli_error($koneksi));

                            $query1=mysqli_query($koneksi,"SELECT * FROM transaksi where tanggal='$tanggal' and kode_jadwal='kdjw001'");
                            $hasil1=mysqli_num_rows($query1);
                            
                            $query2=mysqli_query($koneksi,"SELECT * FROM transaksi where tanggal='$tanggal' and kode_jadwal='kdjw002'");
                            $hasil2=mysqli_num_rows($query2);
                            
                            $query3=mysqli_query($koneksi,"SELECT * FROM transaksi where tanggal='$tanggal' and kode_jadwal='kdjw003'");
                            $hasil3=mysqli_num_rows($query3);

                            $query4=mysqli_query($koneksi,"SELECT * FROM transaksi where tanggal='$tanggal' and kode_jadwal='kdjw004'");
                            $hasil4=mysqli_num_rows($query4);

                            
                            echo "<tr>
                                    <td><center>$hasil1</center></td>
                                    <td><center>$hasil2</center></td>
                                    <td><center>$hasil3</center></td>
                                    <td><center>$hasil4</center></td>
                                </tr>";
                        ?>
                    </tbody>
                </table>
                <label class="uk-form-label" for="form-stacked-text" style="color:grey">Keterangan :</label>
                <label class="uk-form-label" for="form-stacked-text" style="color:grey">0 - 5 (kosong - penuh)</label>

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">Tanggal</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="form-stacked-text" type="date" name="tanggal" min="<?php echo date('Y-m-d',strtotime('+1 day'));?>" max="<?php echo date('Y-m-d',strtotime('+7 day'));?>" value="<?php if(isset($_POST['tanggal'])){ echo $_POST['tanggal'];}else{ echo'';} ?>" required>
                    </div>
                </div>

                <div class='uk-margin'>
                        <button class='uk-button uk-button-primary' type='submit' name='button'>Submit</button>
                    </div>

            </form>
        </div>
    </div>
</div>

</body>
</html>