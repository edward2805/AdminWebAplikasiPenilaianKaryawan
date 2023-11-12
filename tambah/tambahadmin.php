<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
    header("location: ../login.php");
    exit;
}
require '../function.php';

if( isset($_POST["tambah"]) ){

    if( tambah_admin($_POST) > 0 ){
        echo "
        <script>
            alert('Data Admin Berhasil di tambahkan');
            document.location.href = '../daftaradmin.php';
        </script>
        ";
    }else{
        echo "
        <script>
            alert('Data Admin Gagal di tambahkan!!!!!');
            document.location.href = 'tambahadmin.php';
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

    

    <div class="container p-5">

    <h3>Tambah Data Admin<hr></h3>

        <form action="" method="POST" style="padding-bottom: 100px">
        <div class="form-group" style="margin-top: 10px;">
            <label for="nama">Nama Lengkap</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input id="nama" type="text" name="nama" class="form-control" placeholder="Masukkan Nama Lengkap" required>
                </div>
        </div>

        <div class="form-group" style="margin-top: 10px;">
            <label for="username">Username</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input id="username" type="text" name="username" class="form-control" placeholder="Masukkan Username" required>
                </div>
        </div>

        <div class="form-group" style="margin-top: 10px;">
            <label for="password">Password</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input id="password" type="password" name="password" class="form-control" placeholder="Masukkan Passowrd" required>
                </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3" name="tambah" style="float: left;">Tambah Admin</button>
        <a href="../daftaradmin.php">
            <button type="button" class="btn btn-danger mt-3 ms-2" name="cancel" style="float: left;">Cancel</button>
        </a>
        
        </form>
    </div>

</div>

<?php include('../newlayout/footer.php') ?>