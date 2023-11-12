<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
    header("location: login.php");
    exit;
}

require 'function.php';

$admin = query("SELECT * FROM admin ");

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
        <h3>Daftar Admin<hr></h3>
            <div class="table-responsive p-2" style="background-color: #ffffff; border-radius:3%;">
                <a href="tambah/tambahadmin.php" style="color:black;">
                <button type="submit" class="btn btn-primary mt-3 mb-3" name="tambah" style="float: left;">Tambah Admin</button>
                </a>
                <table class="table table-striped table-bordered pt-3 pb-3" id="datatableskry">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Username</th>
                        <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;  ?>
                        <?php foreach( $admin as $adm ) : ?>
                        <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $adm["nama_admin"]; ?></td>
                        <td><?= $adm["username"]; ?></td>
                        <td>
                            <a href="ubah/ubahdataadmin.php?id_admin=<?= $adm["id_admin"]; ?>">
                            <i class="fa-solid fa-pen-to-square" style="color:black;"></i></a> | 
                            
                            <a href="hapus/hapusadmin.php?id_admin=<?= $adm["id_admin"]; ?>" 
                            onclick="return confirm('Yakin untuk menghapus data User ini ????');">
                            <i class="fa-solid fa-trash" style="color:black;"></i></a> |

                            <a href="informasi/informasiadmin.php?id_admin=<?= $adm["id_admin"]; ?>">
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
            $('#datatableskry').DataTable();
        });
    </script>

<?php include('newlayout/footer.php') ?>



