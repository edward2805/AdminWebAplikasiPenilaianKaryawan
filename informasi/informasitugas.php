<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
    header("location: ../login.php");
    exit;
}
require '../function.php';

$id_tugas = $_GET["id_tugas"];


$tgs = query("SELECT * FROM tb_tugas WHERE id_tugas= $id_tugas")[0];


$karyawaninner = query("SELECT tb_tugas.user_id, user.nama, tenant.tenant_name, tb_tugas.id_tenant
                        FROM tb_tugas
                        INNER JOIN user ON tb_tugas.user_id = user.id_user
                        INNER JOIN tenant ON tb_tugas.id_tenant = tenant.id_tenant
                        WHERE id_tugas='$id_tugas'")[0];

$durasi = query("SELECT *, DATEDIFF (end_tugas, start_tugas) AS total_durasi 
                FROM tb_tugas WHERE id_tugas='$id_tugas'")[0];

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
        <h3>Details Data Tugas<hr></h3>
            <div class="container" style="background-color: #ffffff; border-radius:3%;">

                <form action="" method="POST" style="padding-bottom: 50px; margin-top:50px;">                

                <input type="hidden" name="id_tugas" readonly value="<?= $tgs["id_tugas"]; ?>">

                <div class="form-group" style="margin-top: 10px;">
                    <label><b>Nama Karyawan</b></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            </div>
                            <input id="nama" type="text" name="nama" class="form-control" 
                            required readonly value="<?= $karyawaninner["nama"]; ?>">
                        </div>
                </div>

                <div class="form-group" style="margin-top: 10px;">
                    <label for="tt_number"><b>TT Number</b></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            </div>
                            <input id="tt_number" type="text" name="tt_number" class="form-control" 
                            readonly required value="<?= $tgs["tt_number"]; ?>">
                        </div>
                </div>

                <div class="form-group" style="margin-top: 10px;">
                    <label for="site_id"><b>Site id</b></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            </div>
                            <input id="site_id" type="text" name="site_id" class="form-control" 
                            readonly required value="<?= $tgs["site_id"]; ?>">
                        </div>
                </div>

                <div class="form-group" style="margin-top: 10px;">
                    <label for="site_name"><b>Site Name</b></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            </div>
                            <input id="site_name" type="site_name" name="site_name" 
                            class="form-control" readonly required value="<?= $tgs["site_name"]; ?>">
                        </div>
                </div>

                <div class="form-group" style="margin-top: 10px;">
                    <label for="tenant"><b>Tenant</b></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            </div>
                            <input id="tenant" type="text" name="tenant_name" class="form-control" 
                            required readonly value="<?= $karyawaninner["tenant_name"]; ?>">
                        </div> 
                </div>

                <div class="form-group" style="margin-top: 10px;">
                    <label><b>Status</b></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            </div>
                            <input id="status" type="text" name="status" class="form-control" 
                            readonly required value="<?= $tgs["status"]; ?>">
                        </div> 
                </div>
                
                <div class="form-group" style="margin-top: 10px;">
                    <label for="alamat"><b>Alamat</b></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            </div>
                            <input id="alamat" type="text" name="alamat" class="form-control" 
                            readonly required value="<?= $tgs["alamat"]; ?>">
                        </div> 
                </div>

                <div class="form-group" style="margin-top: 10px;">
                    <label for="tipe"><b>Tipe</b></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            </div>
                            <input id="tipe" type="text" name="tipe" class="form-control" 
                            readonly required value="<?= $tgs["tipe"]; ?>">
                        </div> 
                </div>
                <div class="form-group" style="margin-top: 10px;">
                    <label for="start_tugas"><b>Start Project</b></label>
                        <div class="input-group" style="width: 200px;">
                            <div class="input-group-prepend">
                            </div>
                            <input id="start_tugas" type="text" name="start_tugas" class="form-control" 
                            placeholder="Masukkan Tanggal Start" required autocomplete="off"
                            readonly value="<?= $tgs["start_tugas"]; ?>">
                        </div> 
                </div>

                <div class="form-group" style="margin-top: 10px;">
                    <label for="end_tugas"><b>End Project</b></label>
                        <div class="input-group" style="width: 200px;">
                            <div class="input-group-prepend">
                            </div>
                            <input id="end_tugas" type="text" name="end_tugas" class="form-control" 
                            placeholder="Masukkan Tanggal End" required autocomplete="off"
                            readonly value="<?= $tgs["end_tugas"]; ?>">
                        </div> 
                </div>     
                <div class="form-group" style="margin-top: 10px;">
                    <label for="total"><b>Durasi Project</b></label>
                        <div class="input-group" style="width: 200px;">
                            <div class="input-group-prepend">
                            </div>
                            <input id="total" type="text" name="durasi" class="form-control" required autocomplete="off"
                            readonly value="<?= $durasi['total_durasi']; ?> Hari">
                        </div> 
                </div>
                <div class="form-group" style="margin-top: 10px;">
                    <label for="gambar"><b>Gambar Project</b></label>
                        <div class="input-group" style="width: 200px;">
                            <div class="input-group-prepend">
                            </div>
                            <img src="<?= $tgs["path_gambar"]; ?>" class="img-fluid" alt="...">
                        </div> 
                </div>
                <div class="form-group" style="margin-top: 10px;">
                    <label for="keterangan"><b>keterangan Project</b></label>
                        <div class="input-group" style="height: 100px;">
                            <div class="input-group-prepend">
                            </div>
                            <input id="keterangan" type="text" name="keterangan" class="form-control" required autocomplete="off"
                            readonly value="<?= $tgs['keterangan']; ?>">
                        </div> 
                </div>
                </form>
    </div>
</div>

<?php include('../newlayout/footer.php') ?>