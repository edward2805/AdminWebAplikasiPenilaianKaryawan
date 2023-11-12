<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
    header("location: ../login.php");
    exit;
}
require '../function.php';

$id_user = $_GET["id_user"];

if( hapus_user($id_user) > 0 ) {
        echo "
        <script>
            alert('Data User Berhasil di Hapus');
            document.location.href = '../daftarkaryawan.php';
        </script>
        ";
    }else{
        echo "
        <script>
            alert('Data User Gagal di Hapus!!!!!');
            document.location.href = '../daftarkaryawan.php';
        </script>
        ";
    }

?>