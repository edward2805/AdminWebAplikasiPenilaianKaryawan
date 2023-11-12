<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
    header("location: ../login.php");
    exit;
}
require '../function.php';

$id_admin = $_GET["id_admin"];

if( hapus_admin($id_admin) > 0 ) {
        echo "
        <script>
            alert('Data User Berhasil di Hapus');
            document.location.href = '../daftaradmin.php';
        </script>
        ";
    }else{
        echo "
        <script>
            alert('Data User Gagal di Hapus!!!!!');
            document.location.href = '../daftaradmin.php';
        </script>
        ";
    }

?>