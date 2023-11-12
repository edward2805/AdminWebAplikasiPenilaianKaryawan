<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
    header("location: ../login.php");
    exit;
}
require '../function.php';

if (isset($_POST['apply'])) {
    $id_tugas = $_GET["id_tugas"];
    $tgs = query("SELECT * FROM tb_tugas WHERE id_tugas= $id_tugas")[0];
    $karyawaninner = query("SELECT tb_tugas.user_id, user.nama, tenant.tenant_name, tb_tugas.id_tenant
    FROM tb_tugas
    INNER JOIN user ON tb_tugas.user_id = user.id_user
    INNER JOIN tenant ON tb_tugas.id_tenant = tenant.id_tenant
    WHERE id_tugas='$id_tugas'")[0];

    $durasi = query("SELECT *, 
                    DATEDIFF (end_tugas, start_tugas) AS tugas_durasi, 
                    DATEDIFF (end_tugas, tugas_selesai) AS durasi_tugas,
                    DAY(start_tugas) AS tugas_mulai,
                    DAY(end_tugas) AS tugas_deadline,
                    DAY(tugas_selesai) AS tugas_pengerjaan
                    FROM tb_tugas WHERE id_tugas='$id_tugas'")[0];


    $id_tugas = $tgs["id_tugas"];
    $id_admin = $_SESSION['id_admin']; 
    $durasi_tugas = $durasi["durasi_tugas"];
    $tugas_durasi = $durasi["tugas_durasi"];

    // perhitungan tugas 
    $tugas_mulai = $durasi["tugas_mulai"];
    $tugas_deadline = $durasi["tugas_deadline"];
    $tugas_pengerjaan = $durasi["tugas_pengerjaan"];
    
    $nilai_bonus = 10;
    $nilai_penalti = -10;
    $nilai_tugas = 100;

    $cari_nilai_tugas = ($tugas_deadline - $tugas_pengerjaan);


    if($durasi_tugas >= 0){
        $nilai_total = $nilai_tugas + ( $nilai_bonus * ($tugas_deadline - $tugas_pengerjaan) );
    }elseif($durasi_tugas <= -10){
        $nilai_total = 0;
    }
    elseif($durasi_tugas < 0){
        $nilai_total = $nilai_tugas + ( $nilai_penalti * ($tugas_pengerjaan - $tugas_deadline) );
    }

    $nilai = $nilai_total;

    $status = "Sudah Dinilai";
    
    // insert tabel nilai
    $query1 = "INSERT INTO penilaian
              VALUES
              (NULL, '$id_tugas', '$id_admin', '$durasi_tugas', '$nilai')";
    mysqli_query($conn, $query1); 

    // update status tugas
    $query2 = "UPDATE tb_tugas SET
               status = '$status'
               WHERE id_tugas = $id_tugas
               ";
    mysqli_query($conn, $query2);

    echo "<script>
    alert('Anda berhasil memberi penilaian.');
    document.location.href = '../daftartugasselesai.php';
    </script>";
}

?> 