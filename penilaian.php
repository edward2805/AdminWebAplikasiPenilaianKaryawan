<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
    header("location: login.php");
    exit;
}
require 'function.php';

$kry = query("SELECT * FROM user");

$user_id = $karyawan["id_user"];

$nilai = query("SELECT user.id_user, user.nama, tb_tugas.tt_number, penilaian.durasi_tugas, SUM(penilaian.nilai) AS total_nilai
FROM penilaian
INNER JOIN tb_tugas ON penilaian.id_tugas = tb_tugas.id_tugas
INNER JOIN user ON tb_tugas.user_id = user.id_user
WHERE user.id_user = '$user_id'")



?>
<?php include('newlayout/main.php') ?>
<?php include('newlayout/sidebar.php') ?>

<div class="content">
    <nav class="navbar navbar-expand-lg bg-body-tertiary ">
        <div class="container-fluid ">
            <div class="d-flex justify-content-between d-sm-none d-block">
            <button class="btn px-1 py-0 open-btn"><i class="fas fa-stream"></i></button>
            </div>
            <a class="navbar-brand fs-4" href="#"><i style="color:red;"><?= $_SESSION['nama_admin']; ?></i> | Sinar Palasari Indonesia</a>
        </div>
    </nav>
    
    <!-- content -->
    <div class="table-responsive p-5">
        <h3>Daftar Penilaian Karyawan<hr></h3>
    <div class="table-responsive p-2">
            <table class="table table-striped table-bordered pt-3 pb-3" id="datanilai">
            <thead>
                <tr>
                <th scope="col" style="width: 10px;">No</th>
                <th scope="col" style="width: 150px;">Nama</th>
                <th scope="col" style="width: 80px;">Username</th>
                <th scope="col" style="width: 300px;">Alamat</th>
                <th scope="col" style="width: 80px;">No Handphone</th>
                <th scope="col" style="width: 30px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;  ?>
                <?php foreach( $kry as $karyawan ) : ?>
                <tr>
                <th scope="row"><?= $i; ?></th>
                <td><?= $karyawan["nama"]; ?></td>
                <td><?= $karyawan["username"]; ?></td>
                <td><?= $karyawan["alamat"]; ?></td>
                <td><?= $karyawan["no_tlp"]; ?></td>
                <td style="text-align: center;">
                    <a href="informasi/informasinilai.php?id_user=<?= $karyawan["id_user"]; ?>">
                    <i class="fa-solid fa-circle-info" style="color:black;"></i></a>
                </td>
                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>  
            </table>
        </div>
    </div>
</div>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#datanilai').DataTable();
        });
    </script>
    

<?php include('newlayout/footer.php') ?>