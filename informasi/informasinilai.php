<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
    header("location: ../login.php");
    exit;
}
require '../function.php';

$id_user = $_GET["id_user"];

$tgs = query("SELECT user.nama, user.id_user, tb_tugas.tt_number, tb_tugas.site_id, tb_tugas.site_name,
              tb_tugas.tt_number, penilaian.nilai, penilaian.durasi_tugas
              FROM penilaian 
              INNER JOIN tb_tugas ON penilaian.id_tugas = tb_tugas.id_tugas
              INNER JOIN user ON tb_tugas.user_id = user.id_user
              WHERE user.id_user ='$id_user'");

$nilai = query("SELECT tb_tugas.user_id, user.nama,  
            SUM(penilaian.nilai) AS total_nilai,
            COUNT(tb_tugas.user_id) AS total_tugas
            FROM penilaian
            INNER JOIN tb_tugas ON penilaian.id_tugas = tb_tugas.id_tugas
            INNER JOIN user ON tb_tugas.user_id = user.id_user
            WHERE user.id_user ='$id_user'")[0];

$total_nilai = $nilai["total_nilai"];
$total_tugas = $nilai["total_tugas"];


if($total_tugas == 0){
    $rata_nilai = "Belum ada tugas selesai";
}else {
    $rata_nilai = $total_nilai/$total_tugas." dari total $total_tugas tugas";
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

    <div class="table-responsive p-5">
        <h3>Details Penilaian Tugas Karyawan<hr></h3>
                <a href="../penilaian.php">
                    <button type="button" class="btn btn-danger mb-3" name="cancel" style="float: left; width:100px;">Kembali</button>
                </a>

                <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                    <th scope="col" style="width: 10px;">No</th>
                    <th scope="col" style="width: 120px;">Nama Karyawan</th>
                    <th scope="col" style="width: 100px;">TT Number</th>
                    <th scope="col" style="width: 90px;">Site Name</th>
                    <th scope="col" style="width: 50px;">Nilai</th>
                    <th scope="col" style="width: 90px;">Durasi Pengerjaan</th>
                    <th scope="col" style="width: 45px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;  ?>
                    <?php foreach( $tgs as $tugas ) : ?>
                    <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $tugas["nama"]; ?></td>
                    <td><?= $tugas["tt_number"]; ?></td>
                    <td><?= $tugas["site_name"]; ?></td>
                    <td><?= $tugas["nilai"]; ?></td>
                    <td><?= $tugas["durasi_tugas"]; ?> Day</td>
                    <td>
                        <a href="">
                        <i class="fa-solid fa-check" style="color:black;"></i></a> 
                    </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                    <tr>
                        <th colspan="4" style="text-align: right;">Total rata-rata nilai adalah : </th>
                        <td colspan="3"><?= $rata_nilai; ?></td>
                    </tr>
                </tbody>  
                </table>
    </div>
</div>

<?php include('../newlayout/footer.php') ?>