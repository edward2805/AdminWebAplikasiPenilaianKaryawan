<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
    header("location: login.php");
    exit;
}

require 'function.php';


$total_karyawan = query("SELECT COUNT(*) AS total_karyawan FROM user")[0];
$total_tugas = query("SELECT COUNT(*) AS total_tugas FROM tb_tugas")[0];
$total_penilaian = query("SELECT COUNT(*) AS total_penilaian FROM penilaian")[0];


?>


<?php include('newlayout/main.php') ?>
<?php include('newlayout/sidebar.php') ?>

<div class="content">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="d-flex justify-content-between d-sm-none d-block">
            <button class="btn px-1 py-0 open-btn"><i class="fas fa-stream"></i></button>
            </div>
            <a class="navbar-brand fs-4" href="#"><i style="color:red;"><?= $_SESSION['nama_admin']; ?></i> | Sinar Palasari Indonesia</a>
        </div>
    </nav>

    <div class="table-responsive p-5">
        <h3>Dashboard<hr></h3>
    <div class="container text-center">
        <div class="row">
            <div class="col-sm-4 pt-5">
                <div class="card bg-info">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Karyawan</h5>
                        <p class="card-text">Jumlah Karyawan : <?= $total_karyawan["total_karyawan"]; ?> </p>
                        <a href="daftarkaryawan.php" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 pt-5">
                <div class="card bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Tugas</h5>
                        <p class="card-text">Jumlah Tugas : <?= $total_tugas["total_tugas"]; ?></p>
                        <a href="daftartugas.php" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 pt-5">
                <div class="card bg-danger">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Penilaian</h5>
                        <p class="card-text">Jumlah Penilaian Tugas : <?= $total_penilaian["total_penilaian"]; ?></p>
                        <a href="daftartugassudahdinilai.php" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<?php include('newlayout/footer.php') ?>