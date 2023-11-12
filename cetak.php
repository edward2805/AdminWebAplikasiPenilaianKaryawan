<?php

require 'function.php';

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

if(isset($_POST['cetak'])){
    $tanggal_mulai = $_GET['tanggal_mulai'];
    $tanggal_selesai = $_GET['tanggal_selesai'];
    if($tanggal_mulai != NULL || $tanggal_selesai != NULL){
        $tgs = query("SELECT tb_tugas.tt_number, 
        tb_tugas.site_name, tb_tugas.status, user.nama, tb_tugas.tugas_selesai, penilaian.nilai,
        DATEDIFF (tb_tugas.end_tugas, tb_tugas.tugas_selesai) AS total_durasi
        FROM penilaian 
        INNER JOIN tb_tugas ON penilaian.id_tugas = tb_tugas.id_tugas
        INNER JOIN user ON tb_tugas.user_id = user.id_user
        WHERE 
        status LIKE 'sudah dinilai' AND
        tb_tugas.tugas_selesai BETWEEN '$tanggal_mulai' AND '$tanggal_selesai'
        ORDER BY tb_tugas.id_tugas");
    }else if($tanggal_mulai == NULL || $tanggal_selesai == NULL){
        $tgs = query("SELECT tb_tugas.tt_number, 
        tb_tugas.site_name, tb_tugas.status, user.nama, tb_tugas.tugas_selesai, penilaian.nilai,
        DATEDIFF (tb_tugas.end_tugas, tb_tugas.tugas_selesai) AS total_durasi
        FROM penilaian 
        INNER JOIN tb_tugas ON penilaian.id_tugas = tb_tugas.id_tugas
        INNER JOIN user ON tb_tugas.user_id = user.id_user
        WHERE 
        status LIKE 'sudah dinilai' 
        ORDER BY tb_tugas.id_tugas");
    }
} else{
    $tgs = query("SELECT tb_tugas.tt_number, 
    tb_tugas.site_name, tb_tugas.status, user.nama, tb_tugas.tugas_selesai, penilaian.nilai,
    DATEDIFF (tb_tugas.end_tugas, tb_tugas.tugas_selesai) AS total_durasi
    FROM penilaian 
    INNER JOIN tb_tugas ON penilaian.id_tugas = tb_tugas.id_tugas
    INNER JOIN user ON tb_tugas.user_id = user.id_user    
    WHERE 
    status LIKE 'sudah dinilai' 
    ORDER BY tb_tugas.id_tugas");
}

$html = '<!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <title></title>

        <link rel="stylesheet" href="print.css" >
        </head>
        <body>

        <h3>Report Tugas Sudah Selesai<hr></h3>
        
        <table border="1" cellpadding="10" cellspacing="0">
            
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Karyawan</th>
                <th scope="col">TT Number</th>
                <th scope="col">Site Name</th>
                <th scope="col">Status</th>
                <th scope="col">Tanggal Selesai</th>
                <th scope="col">Lama Pengerjaan</th>
                <th scope="col">Nilai Tugas</th>
                </tr>
            </thead>
            <tbody>';
            $i = 1;
            foreach( $tgs as $tugas ) {
                $html .= '<tr>
                <th scope="row">'. $i++ .'</th>
                <td>'. $tugas["nama"] .'</td>
                <td>'. $tugas["tt_number"] .'</td>
                <td>'. $tugas["site_name"] .'</td>
                <td>'. $tugas["status"] .'</td>
                <td>'. $tugas["tugas_selesai"] .'</td>
                <td>'. $tugas["total_durasi"] .' Day</td>
                <td>'. $tugas["nilai"] .'</td>
                </tr>';
            }
            
$html .='</tbody>  
        </table> 
        </body>
        </html>
';



$mpdf->WriteHTML($html);
$mpdf->Output('Daftar-Tugas-Selesai.pdf', \Mpdf\Output\Destination::INLINE);

?>