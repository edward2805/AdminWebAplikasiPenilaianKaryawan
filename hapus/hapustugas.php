<?php 

session_start();

if( !isset($_SESSION["login"]) ) {
    header("location: ../login.php");
    exit;
}
require '../function.php';

$id_tugas = $_GET["id_tugas"];

if( hapustugas($id_tugas) > 0 ){
    echo "
        <script>
            alert('Data Tugas Berhasil di Hapus');
            document.location.href = '../daftartugas.php';
        </script>
        ";
    }else{
        echo "
        <script>
            alert('Data Tugas Gagal di Hapus!!!!!');
            document.location.href = '../daftartugas.php';
        </script>
        ";
}


?>