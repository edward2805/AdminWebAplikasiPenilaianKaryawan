<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
    header("location: ../login.php");
    exit;
}
require '../function.php';

// ambil data dari url
$id_user = $_GET["id_user"];

// query data kry berdasarkan id

$kry = query("SELECT * FROM user WHERE id_user='$id_user'")[0];




?>

<?php include('../newlayout/main.php') ?>
<?php include('../newlayout/sidebar.php') ?>


<div class="content">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="d-flex justify-content-between d-sm-none d-block">
            <button class="btn px-1 py-0 open-btn"><i class="fas fa-stream"></i></button>
            </div>
            <a class="navbar-brand fs-4" href="#"><i style="color:red;"><?= $_SESSION['nama_admin']; ?></i> | Sinar Palasari Indonesia</a>
        </div>
    </nav>
    
    <!-- content -->

    <div class="container p-5">
    <form action="" method="POST">

                <input type="hidden" name="id_user" value="<?= $kry["id_user"]; ?>">
                <div class="form-group" style="margin-top: 10px;">
                    <label for="nama">Nama Lengkap</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            </div>
                            <input id="nama" type="text" name="nama" class="form-control" 
                            placeholder="Masukkan Nama Lengkap" readonly
                            value="<?= $kry["nama"]; ?>">
                        </div>
                </div>

                <div class="form-group" style="margin-top: 10px;">
                    <label for="username">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            </div>
                            <input id="username" type="text" name="username" class="form-control" 
                            placeholder="Masukkan Username" readonly value="<?= $kry["username"]; ?>">
                        </div>
                </div>

                <div class="form-group" style="margin-top: 10px;">
                    <label for="password">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            </div>
                            <input id="password" type="password" name="password" class="form-control" 
                            placeholder="Masukkan Passowrd" readonly value="<?= $kry["password"]; ?>">
                        </div>
                </div>

                <div class="form-group" style="margin-top: 10px;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                            </div>
                            <input id="level_user" type="hidden" name="level_user" class="form-control" 
                            readonly value="<?= $kry["level_user"]; ?>">
                        </div>   
                </div>

                <div class="form-group" style="margin-top: 10px;">
                    <label for="alamat">Alamat</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            </div>
                            <input id="alamat" type="text" name="alamat" class="form-control" 
                            placeholder="Masukkan Alamat" readonly value="<?= $kry["alamat"]; ?>">
                        </div> 
                </div>

                <div class="form-group" style="margin-top: 10px;">
                    <label for="nohp">No Handphone</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            </div>
                            <input id="nohp" type="text" name="no_tlp" class="form-control" 
                            placeholder="Masukkan No Handphone" readonly value="<?= $kry["no_tlp"]; ?>">
                        </div> 
                </div>
            </form>
    </div>
</div>



<?php include('../newlayout/footer.php') ?>