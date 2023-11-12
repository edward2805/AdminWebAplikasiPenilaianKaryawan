<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
    header("location: ../login.php");
    exit;
}
require '../function.php';

$id_tugas = $_GET["id_tugas"];

include('function_tgl_ubah.php');

$tgs = query("SELECT * FROM tb_tugas WHERE id_tugas= $id_tugas")[0];



$karyawaninner = query("SELECT tb_tugas.user_id, user.nama, tenant.tenant_name, tb_tugas.id_tenant
                        FROM tb_tugas
                        INNER JOIN user ON tb_tugas.user_id = user.id_user
                        INNER JOIN tenant ON tb_tugas.id_tenant = tenant.id_tenant
                        WHERE id_tugas='$id_tugas'")[0];

$durasi = query("SELECT *, DATEDIFF (end_tugas, start_tugas) AS total_durasi 
                FROM tb_tugas WHERE id_tugas='$id_tugas'")[0];


if( isset($_POST["ubah"]) ){

    if( ubah_tugas($_POST) > 0 ){
        echo "
        <script>
            alert('Data Tugas Berhasil di ubah');
            document.location.href = '../daftartugas.php';
        </script>
        ";
    }else{
        echo "
        <script>
            alert('Data Tugas Gagal di ubah!!!!!');
            document.location.href = '../daftartugas.php';
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
    <form action="" method="POST" style="padding-bottom: 100px">

        <input type="hidden" name="id_tugas" readonly value="<?= $tgs["id_tugas"]; ?>">

        <div class="form-group" style="margin-top: 10px;">
            <label><b>Nama Karyawan</b></label>
            <?php 
                $kry = query("SELECT * FROM user");
            ?>

            <select class="form-select" aria-label="Default select example" name="user_id">
                <option value="<?= $karyawaninner["user_id"]; ?>" 
                selected><?= $karyawaninner["nama"]; ?></option>

                <?php foreach( $kry as $karyawan ) : ?>
                <option value="<?= $karyawan["id_user"]; ?>">
                <?= $karyawan["nama"]; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group" style="margin-top: 10px;">
            <label for="tt_number"><b>TT Number</b></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input id="tt_number" type="text" name="tt_number" class="form-control" 
                    placeholder="Masukkan TT Number" required value="<?= $tgs["tt_number"]; ?>">
                </div>
        </div>

        <div class="form-group" style="margin-top: 10px;">
            <label for="site_id"><b>Site id</b></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input id="site_id" type="text" name="site_id" class="form-control" 
                    placeholder="Masukkan Site_id" required value="<?= $tgs["site_id"]; ?>">
                </div>
        </div>

        <div class="form-group" style="margin-top: 10px;">
            <label for="site_name"><b>Site Name</b></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input id="site_name" type="site_name" name="site_name" 
                    class="form-control" placeholder="Masukkan Site_name" required value="<?= $tgs["site_name"]; ?>">
                </div>
        </div>

        <div class="form-group" style="margin-top: 10px;">
            <label for="tenant"><b>Tenant</b></label>
            <?php 
                $tenant = query("SELECT * FROM tenant");
            ?>

            <select class="form-select" aria-label="Default select example" name="id_tenant">
                <option value="<?= $karyawaninner["id_tenant"]; ?>" 
                selected><?= $karyawaninner["tenant_name"]; ?></option>

                <?php foreach( $tenant as $tnt ) : ?>
                <option value="<?= $tnt["id_tenant"]; ?>">
                <?= $tnt["tenant_name"]; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group" style="margin-top: 10px;">
            <label><b>Status</b></label>
            <select class="form-select" aria-label="Default select example" name="status">
                <option selected value="<?= $tgs["status"]; ?>"><?= $tgs["status"]; ?></option>
                <option value="Open">Open</option>
                <option value="On Proses">On Proses</option>
                <option value="Close">Close</option>
            </select>
        </div>

        <div class="form-group" style="margin-top: 10px;">
            <label for="alamat"><b>Alamat</b></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input id="alamat" type="text" name="alamat" class="form-control" 
                    placeholder="Masukkan Alamat" required value="<?= $tgs["alamat"]; ?>">
                </div> 
        </div>

        <div class="form-group" style="margin-top: 10px;">
            <label for="tipe"><b>Tipe</b></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input id="tipe" type="text" name="tipe" class="form-control" 
                    placeholder="Masukkan Tipe Masalah" required value="<?= $tgs["tipe"]; ?>">
                </div> 
        </div>

        <div class="form-group" style="margin-top: 10px;">
            <label for="start_tugas"><b>Start Project</b></label>
                <div class="input-group" style="width: 200px;">
                    <div class="input-group-prepend">
                    </div>
                    <input id="start_tugas" type="text" name="start_tugas" class="form-control" 
                    placeholder="Masukkan Tanggal Start" required autocomplete="off"
                    value="<?= edit_tanggal($tgs["start_tugas"]); ?>">
                </div> 
        </div>

        <div class="form-group" style="margin-top: 10px;">
            <label for="end_tugas"><b>End Project</b></label>
                <div class="input-group" style="width: 200px;">
                    <div class="input-group-prepend">
                    </div>
                    <input id="end_tugas" type="text" name="end_tugas" class="form-control" 
                    placeholder="Masukkan Tanggal End" required autocomplete="off"
                    value="<?= edit_tanggal($tgs["end_tugas"]); ?>">
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

        <button type="submit" class="btn btn-primary mt-3" name="ubah" style="float: left;">Ubah Tugas Karyawan</button>
        <a href="../daftartugas.php">
            <button type="button" class="btn btn-danger mt-3 ms-2" name="cancel" style="float: left;">Cancel</button>
        </a>

        </form>
    </div>
</div>

    <script>
    $( function() {
        $( "#start_tugas" ).datepicker({
            minDate : new Date(),
            maxDate : new Date(),
            dateFormat : "dd/mm/yy",
            dateMonth : true,
            dateYear : true
        });
    } );

    $( function() {
        $( "#end_tugas" ).datepicker({
            minDate : new Date(),
            dateFormat : "dd/mm/yy",
            dateMonth : true,
            dateYear : true
        });
    } );
    </script>
    

<?php include('../newlayout/footer.php') ?>