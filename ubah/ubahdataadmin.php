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




if( isset($_POST["ubah"]) ){

    if( ubah_admin($_POST) > 0 ){
        echo "
        <script>
            alert('Data User Berhasil di ubah');
            document.location.href = '../daftaradmin.php';
        </script>
        ";
    }else{
        echo "
        <script>
            alert('Data User Gagal di ubah!!!!!');
            document.location.href = '../daftaradmin.php';
        </script>
        ";
    }
}


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
                            placeholder="Masukkan Nama Lengkap" 
                            value="<?= $admin["nama_admin"]; ?>">
                        </div>
                </div>

                <div class="form-group" style="margin-top: 10px;">
                    <label for="username">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            </div>
                            <input id="username" type="text" name="username" class="form-control" 
                            placeholder="Masukkan Username" value="<?= $admin["username"]; ?>">
                        </div>
                </div>

                <div class="form-group" style="margin-top: 10px;">
                    <label for="password">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            </div>
                            <input id="password" type="password" name="password" class="form-control" 
                            placeholder="Masukkan Passowrd" value="<?= $admin["password"]; ?>">
                        </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3" name="ubah" style="float: left;">Ubah Karyawan</button>
                <a href="../daftaradmin.php">
                    <button type="button" class="btn btn-danger mt-3 ms-2" name="cancel" style="float: left;">Cancel</button>
                </a>
            </form>
    </div>
</div>

<?php include('../newlayout/footer.php') ?>