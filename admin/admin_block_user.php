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
    <h2>Block User</h2>
        <div class="uk-container">
            <table class="uk-table uk-table-responsive uk-table-hover uk-table-divider">
            <thead>
                <tr>
                    <th><center>Username</center></th>
                    <th><center>Nama</center></th>
                    <th><center>Block ?</center></th>
                    <th><center>
                        <form class="uk-form-stacked" action="#" method="POST" autocomplete="off">
                            <div class="uk-form-controls">
                                Cari User :
                                <input class="uk-input uk-form-width-small" id="form-stacked-text" type="text" name="username" placeholder="Masukkan Username" required>
                                <button class="uk-button uk-button-primary" type="submit" name="button">Cari</button>
                            </div>
                        </form>
                        <br>
                        <form class="uk-form-stacked" action="#" method="POST" autocomplete="off">
                            <div class="uk-form-controls">
                                Block User :
                                <select class="uk-select uk-form-width-small" id="form-stacked-select" name="block" required>
                                    <option></option>
                                    <option>Tidak</option>
                                    <option>Blocked</option>
                                </select>
                                <button class="uk-button uk-button-primary" type="submit" name="button">Set</button>
                            </div>
                        </form>
                    </center>
                    </th>

                </tr>
            </thead>
            
            <tbody>
                <?php
                    include 'action/koneksi.php';
                    if(isset($_POST['block'])){
                        $block=$_POST['block'];
                        $data=mysqli_query($koneksi,"SELECT * FROM user where block='$block'") or die(mysqli_error($koneksi));
                    }else{
                    if(isset($_POST['username'])){
                        $username=$_POST['username'];
                        $data=mysqli_query($koneksi,"SELECT * FROM user where username='$username'") or die(mysqli_error($koneksi));
                    }elseif(empty($_POST['username'])){
                        $data=mysqli_query($koneksi,"SELECT * FROM user") or die(mysqli_error($koneksi));
                    }
                }
                    foreach($data as $baris){ ?>
                        <tr>
                            <td><center><a href='admin_profil_user.php?username=<?php echo $baris['username']?>'><?php echo $baris['username']?></a></center></td>
                            <td><center><?php echo $baris['nama']?></center></td>
                            <td><center><?php echo $baris['block']?></center></td>
                            <td><center>
                                <?php
                                    if($baris['block']=="Tidak"){?>
                                        <a class="uk-button uk-button-danger" href="action/act_block_user_admin.php?username=<?php echo $baris['username']?>">Block</a>
                                <?php }
                                    if($baris['block']=="Ya"){?>
                                        <a class="uk-button uk-button-primary" href="action/act_unblock_user_admin.php?username=<?php echo $baris['username']?>">Unblock</a>
                                <?php   }
                            ?>
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