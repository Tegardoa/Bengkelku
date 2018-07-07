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
    <h2>Status Reservasi</h2>
        <div class="uk-container">
            <table class="uk-table uk-table-responsive uk-table-hover uk-table-divider">
            <thead>
                <tr>
                    <th><center>Kode Transaksi</center></th>
                    <th><center>Tanggal</center></th>
                    <th><center>Waktu</center></th>
                    <th><center>Username</center></th>
                    <th><center>Nomor Polisi</center></th>
                    <th><center>Status</center></th>
                    <th><center>
                        <form class="uk-form-stacked" action="#" method="POST" autocomplete="off">
                            <div class="uk-form-controls">
                                Status Reservasi :
                                <select class="uk-select uk-form-width-small" id="form-stacked-select" name="status" required>
                                    <option></option>
                                    <option>Belum</option>
                                    <option>Proses</option>
                                    <option>Selesai</option>
                                    <option>Batal</option>
                                </select>
                                <button class="uk-button uk-button-primary" type="submit" name="button">Set</button>
                            </div>
                        </form>
                    </center>
                    <th>
                </tr>
            </thead>
            
            <tbody>
                <?php
                    include 'action/koneksi.php';
                    if(isset($_POST['status'])){
                        $status=$_POST['status'];
                        $data=mysqli_query($koneksi,"SELECT * FROM transaksi inner join jadwal on transaksi.kode_jadwal=jadwal.kode_jadwal where status='$status' ORDER BY tanggal,waktu,kode_transaksi asc") or die(mysqli_error($koneksi));
                    }elseif(empty($_POST['status'])){
                        $data=mysqli_query($koneksi,"SELECT * FROM transaksi inner join jadwal on transaksi.kode_jadwal=jadwal.kode_jadwal ORDER BY tanggal,waktu,kode_transaksi asc") or die(mysqli_error($koneksi));
                    }
                    foreach($data as $baris){ ?>
                        <tr>
                            <td><center><a href="admin_transaksi_page.php?kode_transaksi=<?php echo $baris['kode_transaksi']?>"><?php echo $baris['kode_transaksi']?></center></td>
                            <td><center><?php echo $baris['tanggal']?></center></td>
                            <td><center><?php echo $baris['waktu']?></center></td>
                            <td><center><?php echo $baris['username']?></center></td>
                            <td><center><?php echo $baris['no_polisi']?></center></td>
                            <td><center><?php echo $baris['status']?></center></td>
                            <td><center>
                                <a class="uk-button uk-button-danger" href="action/act_delete_status_reservasi_admin.php?kode_transaksi=<?php echo $baris['kode_transaksi']?>">Hapus</a>
                            </center></td>
                        </tr>
                    <?php   }
                ?>
            </tbody>
        </table>
        </div>
</div>
<br>

</body>

</html>