<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
    header("location: ../login.php");
    exit;
}
require '../function.php';

if (isset($_POST['decline'])) {
    $id_tugas = $_GET["id_tugas"];
    $tgs = query("SELECT * FROM tb_tugas WHERE id_tugas= $id_tugas")[0];
    
    $id_tugas = $tgs["id_tugas"];
    $status = "Open";
    $keterangan = "Decline";
    $gambar = "Decline";
    $path_gambar = "Decline";
        
    // update status tugas
    $query = "UPDATE tb_tugas SET
               status = '$status',
               keterangan = '$keterangan',
               gambar = '$gambar',
               path_gambar = '$path_gambar'
               WHERE id_tugas = $id_tugas
               ";
    mysqli_query($conn, $query);

    echo "<script>
    alert('Anda berhasil mendecline tugas.');
    document.location.href = '../daftartugasselesai.php';
    </script>";
}

?>