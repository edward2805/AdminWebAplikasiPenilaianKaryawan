<?php 

session_start();

if( !isset($_SESSION["login"]) ) {
    header("location: login.php");
    exit;
}

require 'function.php';

// $tgs = query("SELECT * FROM tb_tugas");

$tgs = query("SELECT tb_tugas.user_id, tb_tugas.tt_number, admin.nama_admin,
                    tb_tugas.site_id, tb_tugas.site_name, tenant.tenant_name, 
                    tb_tugas.status, tb_tugas.alamat, tb_tugas.tipe, user.nama, tb_tugas.id_tugas, 
                    tb_tugas.start_tugas, tb_tugas.end_tugas, DATEDIFF (end_tugas, start_tugas) AS total_durasi 
                    FROM tb_tugas 
                    INNER JOIN user ON tb_tugas.user_id = user.id_user
                    INNER JOIN tenant ON tb_tugas.id_tenant = tenant.id_tenant 
                    INNER JOIN admin ON tb_tugas.id_admin = admin.id_admin 
                    ORDER BY tb_tugas.id_tugas");

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
        <h3>Daftar Tugas<hr></h3>
            <div class="table-responsive p-2">
                <a href="tambah/tambahtugas.php" style="color:black;">
                <button type="submit" class="btn btn-primary mt-3 mb-3" name="tambah" style="float: left;">Tambah Tugas</button>
                </a>

                <table class="table table-striped table-bordered pt-3 pb-3" id="datatablestugas">
                <thead>
                    <tr>
                    <th scope="col" style="width: 10px;">No</th>
                    <th scope="col" style="width: 120px;">Nama Karyawan</th>
                    <th scope="col" style="width: 100px;">Nama Admin</th>
                    <th scope="col" style="width: 90px;">Site Name</th>
                    <th scope="col" style="width: 50px;">Status</th>
                    <th scope="col" style="width: 90px;">Start Project</th>
                    <th scope="col" style="width: 90px;">End Project</th>
                    <th scope="col" style="width: 20px;">Durasi Project</th>
                    <th scope="col" style="width: 75px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;  ?>
                    <?php foreach( $tgs as $tugas ) : ?>
                    <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $tugas["nama"]; ?></td>
                    <td><?= $tugas["nama_admin"]; ?></td>
                    <td><?= $tugas["site_name"]; ?></td>
                    <td><?= $tugas["status"]; ?></td>
                    <td><?= $tugas["start_tugas"]; ?></td>
                    <td><?= $tugas["end_tugas"]; ?></td>
                    <td><?= $tugas["total_durasi"]; ?> Day</td>
                    <td>
                        <a href="hapus/hapustugas.php?id_tugas=<?= $tugas["id_tugas"]; ?>" 
                        onclick="return confirm('Yakin untuk menghapus data Tugas ini ????');">
                        <i class="fa-solid fa-trash" style="color:black;"></i></a> |

                        <a href="informasi/informasitugas.php?id_tugas=<?= $tugas["id_tugas"]; ?>">
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
            $('#datatablestugas').DataTable();
        });
    </script>

<?php include('newlayout/footer.php') ?>