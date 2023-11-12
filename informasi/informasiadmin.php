<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
    header("location: ../login.php");
    exit;
}
require '../function.php';

// ambil data dari url
$id_admin = $_GET["id_admin"];

// query data admin berdasarkan id

$admin = query("SELECT * FROM admin WHERE id_admin='$id_admin'")[0];




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

                <input type="hidden" name="id_admin" value="<?= $admin["id_admin"]; ?>">
                <div class="form-group" style="margin-top: 10px;">
                    <label for="nama">Nama Lengkap</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            </div>
                            <input id="nama" type="text" name="nama" class="form-control" 
                            placeholder="Masukkan Nama Lengkap" readonly
                            value="<?= $admin["nama_admin"]; ?>">
                        </div>
                </div>

                <div class="form-group" style="margin-top: 10px;">
                    <label for="username">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            </div>
                            <input id="username" type="text" name="username" class="form-control" 
                            placeholder="Masukkan Username" readonly value="<?= $admin["username"]; ?>">
                        </div>
                </div>

                <div class="form-group" style="margin-top: 10px;">
                    <label for="password">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            </div>
                            <input id="password" type="password" name="password" class="form-control" 
                            placeholder="Masukkan Passowrd" readonly value="<?= $admin["password"]; ?>">
                        </div>
                </div>
            </form>
    </div>
</div>



<?php include('../newlayout/footer.php') ?>