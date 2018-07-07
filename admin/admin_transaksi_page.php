<!DOCTYPE html>
<?php
    session_start();
    include "action/act_cek_admin.php";
?>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/bengkel.css">
	<script src="../js/uikit.min.js"></script>
	<script src="../js/uikit-icons.min.js"></script>
	<title>Bengkel Ku</title>
</head>

<body>

<nav class="uk-navbar-container" style="background-color:rgb(30,135,240);" uk-navbar>
    <div class="uk-navbar-left">
        <ul class="uk-navbar-nav">
            <li class="uk-active"><a href="admin_index.php" style="color:white; padding:30px; font-size: 40px;font-family:rockwell;">Bengkel Ku</a></li></li>
            <?php
                if(empty($_SESSION["username_adm"])){
                }elseif(isset($_SESSION["username_adm"])){
                    echo "<li><a href='admin_jadwal_reservasi.php' style='color:white'>Jadwal Reservasi</a></li>";
                    echo "<li><a href='admin_block_user.php' style='color:white;'>Block User</a></li>";
                }
            ?>
        </ul>
    </div>
    
    <div class="uk-navbar-right">
        <ul class="uk-navbar-nav">
            <li>
                <?php 
                    if(empty($_SESSION["username_adm"])){
                        echo "<a href='#'' class='uk-icon-link uk-margin-small-left' uk-icon='user' style='color:white; padding-right:80px;'>Login</a>";
                    }elseif(isset($_SESSION["username_adm"])){
                        $akun = $_SESSION["username_adm"];
                        echo "<a href='#' class='uk-icon-link uk-margin-small-left' uk-icon='user' style='color:white; padding-right:80px;'>Hai, $akun</a>";
                    }
                ?>
                <div class="uk-navbar-dropdown">
                    <ul class="uk-nav uk-navbar-dropdown-nav">
                        <?php
                            if(empty($_SESSION["username_adm"])){
                            }elseif(isset($_SESSION["username_adm"])){
                                echo "<li class='uk-active'><a href='action/act_logout_admin.php'>Keluar</a></li>";

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
        include "action/act_alert_admin.php";
    ?>
    <h2>Profil Akun</h2>
    <?php
        include 'action/koneksi.php';
        $kode_transaksi=$_GET['kode_transaksi'];
        $data=mysqli_query($koneksi,"SELECT * FROM transaksi WHERE kode_transaksi='$kode_transaksi'") or die(mysqli_error($koneksi));
        $baris=mysqli_fetch_array($data);
    ?>
        <div class="uk-container">
            <form class="uk-form-stacked" action="action/act_update_transaksi_user_admin.php" method="post">
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">Kode Transaksi</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="form-stacked-text" type="text" name="kode_transaksi" value="<?php echo $baris['kode_transaksi']?>" maxlength="15" readonly>
                        <!--pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" title="Hanya huruf dan angka, dan harus terdiri dari 6 atau lebih karakter"-->
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-select">Status Reservasi</label>
                    <div class="uk-form-controls">
                        <select class="uk-select" id="form-stacked-select" name="status" required>
                            <option></option>
                            <option <?php if($baris['status']=='Belum') echo 'selected="selected"';?>>Belum</option>
                            <option <?php if($baris['status']=='Proses') echo 'selected="selected"';?>>Proses</option>
                            <option <?php if($baris['status']=='Selesai') echo 'selected="selected"';?>>Selesai</option>
                            <option <?php if($baris['status']=='Batal') echo 'selected="selected"';?>>Batal</option>
                        </select>
                    </div>
                </div>
                
                <button class="uk-button uk-button-primary" type="submit" name="button">Ubah</button>

                <a href="admin_jadwal_reservasi.php" style="padding-left:20px;">Kembali</a>

            </form>
        </div>
</div>
<br>


</body>
</html>