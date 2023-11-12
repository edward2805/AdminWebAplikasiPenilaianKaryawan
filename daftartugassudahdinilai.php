<?php 

session_start();

if( !isset($_SESSION["login"]) ) {
    header("location: login.php");
    exit;
}

require 'function.php';

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
    
    <!-- content -->
    <div class="table-responsive p-5">
        <h3>Daftar Tugas Sudah Dinilai<hr></h3>
    <div class="table-responsive p-2">
        <a href="tambah/tambahtugas.php" style="color:black;">
            <button type="submit" class="btn btn-primary mt-3 mb-3" name="tambah" style="float: left;">Tambah Tugas</button>
        </a>
        <div class="row mt-3">
            <div class="col">
                <form action="" method="POST" class="form-inliner">
                    <label for="">Dari Tanggal</label>
                    <input type="date" name="tanggal_mulai" style="width:150px;">
                    <label for="">Sampai Tanggal</label>
                    <input type="date" name="tanggal_selesai" style="width:150px;">
                    <button name="cari_tanggal" type="submit" class="btn btn-primary">Filter Tanggal</button>
                    <button name="semua" type="submit" class="btn btn-primary">Cari Semua</button>
                </form>
            </div>
        </div>      

            <table class="table table-striped table-bordered pt-3 pb-3" id="datatablestugasdone">
            
            <thead>
                <tr>
                <th scope="col" style="width: 10px;">No</th>
                <th scope="col" style="width: 120px;">Nama Karyawan</th>
                <th scope="col" style="width: 100px;">Nama Admin</th>
                <th scope="col" style="width: 90px;">Site Name</th>
                <th scope="col" style="width: 50px;">Status</th>
                <th scope="col" style="width: 50px;">Tanggal Selesai</th>
                <th scope="col" style="width: 90px;">Durasi Pengerjaan</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    if(isset($_POST['cari_tanggal'])){
                        $tanggal_mulai = $_POST['tanggal_mulai'];
                        $tanggal_selesai = $_POST['tanggal_selesai'];
                        if($tanggal_mulai != NULL || $tanggal_selesai != NULL){
                            $tgs = query("SELECT tb_tugas.user_id, tb_tugas.tt_number, admin.nama_admin,
                            tb_tugas.site_id, tb_tugas.site_name, tenant.tenant_name, 
                            tb_tugas.status, tb_tugas.alamat, tb_tugas.tipe, user.nama, tb_tugas.id_tugas, tb_tugas.start_tugas,
                            tb_tugas.tugas_selesai, tb_tugas.end_tugas, DATEDIFF (end_tugas, tugas_selesai) AS total_durasi
                            FROM tb_tugas 
                            INNER JOIN user ON tb_tugas.user_id = user.id_user
                            INNER JOIN tenant ON tb_tugas.id_tenant = tenant.id_tenant 
                            INNER JOIN admin ON tb_tugas.id_admin = admin.id_admin 
                            WHERE 
                            status LIKE 'sudah dinilai' AND
                            tb_tugas.tugas_selesai BETWEEN '$tanggal_mulai' AND '$tanggal_selesai'
                            ORDER BY tb_tugas.id_tugas");
                        }else{
                            $tgs = query("SELECT tb_tugas.user_id, tb_tugas.tt_number, admin.nama_admin,
                            tb_tugas.site_id, tb_tugas.site_name, tenant.tenant_name, 
                            tb_tugas.status, tb_tugas.alamat, tb_tugas.tipe, user.nama, tb_tugas.id_tugas, tb_tugas.start_tugas,
                            tb_tugas.tugas_selesai, tb_tugas.end_tugas, DATEDIFF (end_tugas, tugas_selesai) AS total_durasi
                            FROM tb_tugas 
                            INNER JOIN user ON tb_tugas.user_id = user.id_user
                            INNER JOIN tenant ON tb_tugas.id_tenant = tenant.id_tenant 
                            INNER JOIN admin ON tb_tugas.id_admin = admin.id_admin 
                            WHERE 
                            status LIKE 'sudah dinilai' 
                            ORDER BY tb_tugas.id_tugas");
                        }
                    } else if(isset($_POST['semua'])){
                        $tanggal_mulai = $_POST['tanggal_mulai'];
                        $tanggal_selesai = $_POST['tanggal_selesai'];
                        if($tanggal_mulai == NULL || $tanggal_selesai == NULL){
                        $tgs = query("SELECT tb_tugas.user_id, tb_tugas.tt_number, admin.nama_admin,
                        tb_tugas.site_id, tb_tugas.site_name, tenant.tenant_name, 
                        tb_tugas.status, tb_tugas.alamat, tb_tugas.tipe, user.nama, tb_tugas.id_tugas, tb_tugas.start_tugas,
                        tb_tugas.tugas_selesai, tb_tugas.end_tugas, DATEDIFF (end_tugas, tugas_selesai) AS total_durasi
                        FROM tb_tugas 
                        INNER JOIN user ON tb_tugas.user_id = user.id_user
                        INNER JOIN tenant ON tb_tugas.id_tenant = tenant.id_tenant 
                        INNER JOIN admin ON tb_tugas.id_admin = admin.id_admin 
                        WHERE 
                        status LIKE 'sudah dinilai' 
                        ORDER BY tb_tugas.id_tugas");
                        }
                    }else{
                        $tgs = query("SELECT tb_tugas.user_id, tb_tugas.tt_number, admin.nama_admin,
                        tb_tugas.site_id, tb_tugas.site_name, tenant.tenant_name, 
                        tb_tugas.status, tb_tugas.alamat, tb_tugas.tipe, user.nama, tb_tugas.id_tugas, tb_tugas.start_tugas,
                        tb_tugas.tugas_selesai, tb_tugas.end_tugas, DATEDIFF (end_tugas, tugas_selesai) AS total_durasi
                        FROM tb_tugas 
                        INNER JOIN user ON tb_tugas.user_id = user.id_user
                        INNER JOIN tenant ON tb_tugas.id_tenant = tenant.id_tenant
                        INNER JOIN admin ON tb_tugas.id_admin = admin.id_admin  
                        WHERE 
                        status LIKE 'sudah dinilai' 
                        ORDER BY tb_tugas.id_tugas");
                    }
                ?>
                
                <?php $i = 1;  ?>
                <?php foreach( $tgs as $tugas ) : ?>
                <tr>
                <th scope="row"><?= $i; ?></th>
                <td><?= $tugas["nama"]; ?></td>
                <td><?= $tugas["nama_admin"]; ?></td>
                <td><?= $tugas["site_name"]; ?></td>
                <td><?= $tugas["status"]; ?></td>
                <td><?= $tugas["tugas_selesai"]; ?></td>
                <td><?= $tugas["total_durasi"]; ?> Day</td>
                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>  
            </table> 

            <form action="cetak.php?tanggal_mulai=<?= $tanggal_mulai; ?>&&tanggal_selesai=<?= $tanggal_selesai; ?>" method="POST" target="_blank">
                <button class="btn btn-primary mt-2" name="cetak">
                    Cetak Laporan
                </button>
            </form>
        </div>
    </div>
</div>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#datatablestugasdone').DataTable();
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#datatablestugasselesai').DataTable();
        });
    </script>
    

<?php include('newlayout/footer.php') ?>
