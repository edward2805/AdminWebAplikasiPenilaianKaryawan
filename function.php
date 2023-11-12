<?php 
$conn = mysqli_connect("localhost","root", "", "setik");

include('function_tanggal.php');

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// FUNCTION DATA ADMIN

function tambah_admin($data_admin){
    global $conn;

    $nama = htmlspecialchars($data_admin["nama"]);
    $username = htmlspecialchars($data_admin["username"]);
    $password = md5(htmlspecialchars($data_admin["password"]));

    $cek_username = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");

    if(mysqli_num_rows($cek_username) > 0) {
        echo "
            <script>
                alert('Username ".$username." Sudah ada!!! Silahkan Menggunakan username yang lain');
                document.location.href = 'tambahadmin.php';
            </script>
            ";
        return false;
    } else {
        $query = "INSERT INTO admin
        VALUES
        (NULL, '$username', '$password', '$nama')";

        mysqli_query($conn, $query); 

        return mysqli_affected_rows($conn);
    }
}

function ubah_admin($data_admin){
    global $conn;

    $id_admin = $data_admin["id_admin"];
    $nama = htmlspecialchars($data_admin["nama"]);
    $username = htmlspecialchars($data_admin["username"]);
    $password = htmlspecialchars($data_admin["password"]);

    $query = "UPDATE admin SET
              nama_admin = '$nama',
              username = '$username',
              password = '$password'
              WHERE id_admin = $id_admin
              ";

    mysqli_query($conn, $query); 

    return mysqli_affected_rows($conn);
}

function hapus_admin($id_admin){
    global $conn;

    mysqli_query($conn, "DELETE FROM admin WHERE id_admin = $id_admin");

    return mysqli_affected_rows($conn);
}

// FUNCTION DATA KARYAWAN 

function tambah_user($data_user){
    global $conn;

    $nama = htmlspecialchars($data_user["nama"]);
    $username = htmlspecialchars($data_user["username"]);
    $password = htmlspecialchars($data_user["password"]);
    $alamat = htmlspecialchars($data_user["alamat"]);
    $no_tlp = htmlspecialchars($data_user["no_tlp"]); 

    $cek_username = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    if(mysqli_num_rows($cek_username) > 0) {
        echo "
            <script>
                alert('Username ".$username." Sudah ada!!! Silahkan Menggunakan username yang lain');
                document.location.href = 'tambahuser.php';
            </script>
            ";
        return false;
    } else {
        $query = "INSERT INTO user
        VALUES
        (NULL, '$nama', '$username', '$password', '$alamat', '$no_tlp')";

        mysqli_query($conn, $query); 

        return mysqli_affected_rows($conn);
    }
}

function hapus_user($id_user){
    global $conn;

    mysqli_query($conn, "DELETE FROM user WHERE id_user = $id_user");

    return mysqli_affected_rows($conn);
}

function ubah_user($data_user){
    global $conn;

    $id_user = $data_user["id_user"];
    $nama = htmlspecialchars($data_user["nama"]);
    $username = htmlspecialchars($data_user["username"]);
    $password = htmlspecialchars($data_user["password"]);
    $alamat = htmlspecialchars($data_user["alamat"]);
    $no_tlp = htmlspecialchars($data_user["no_tlp"]); 

    $query = "UPDATE user SET
              nama = '$nama',
              username = '$username',
              password = '$password',
              alamat = '$alamat',
              no_tlp = '$no_tlp'
              WHERE id_user = $id_user
              ";

    mysqli_query($conn, $query); 

    return mysqli_affected_rows($conn);
}


// function Tugas

function tambah_tugas($data_tugas){

    global $conn;

    $user_id = htmlspecialchars($data_tugas["user_id"]);
    $id_admin = htmlspecialchars($data_tugas["id_admin"]);
    $tt_number = htmlspecialchars($data_tugas["tt_number"]);
    $site_id = htmlspecialchars($data_tugas["site_id"]);
    $site_name = htmlspecialchars($data_tugas["site_name"]);
    $id_tenant = htmlspecialchars($data_tugas["id_tenant"]);
    $status = htmlspecialchars($data_tugas["status"]);
    $alamat = htmlspecialchars($data_tugas["alamat"]);
    $tipe = htmlspecialchars($data_tugas["tipe"]);
    $start_tugas = htmlspecialchars($data_tugas["start_tugas"]);
    $end_tugas = htmlspecialchars($data_tugas["end_tugas"]);
    
    // konversi tanggal 
    $tanggal_start = input_tanggal($start_tugas);
    $tanggal_end = input_tanggal($end_tugas);


    $query = "INSERT INTO tb_tugas
              VALUES
              (NULL, '$user_id', '$id_admin', '$tt_number', '$site_id', '$site_name', 
              '$id_tenant', '$status', '$alamat', '$tipe', '$tanggal_start' ,'$tanggal_end', NULL,NULL,NULL,NULL)
              ";
    mysqli_query($conn, $query); 

    return mysqli_affected_rows($conn);
}

function hapustugas($id_tugas){
    global $conn;

    mysqli_query($conn, "DELETE FROM tb_tugas WHERE id_tugas = $id_tugas");

    return mysqli_affected_rows($conn);
}

function ubah_tugas($data_tugas){
    global $conn;

    $id_tugas = $data_tugas["id_tugas"];
    $user_id = htmlspecialchars($data_tugas["user_id"]);
    $tt_number = htmlspecialchars($data_tugas["tt_number"]);
    $site_id = htmlspecialchars($data_tugas["site_id"]);
    $site_name = htmlspecialchars($data_tugas["site_name"]);
    $id_tenant = htmlspecialchars($data_tugas["id_tenant"]);
    $status = htmlspecialchars($data_tugas["status"]);
    $alamat = htmlspecialchars($data_tugas["alamat"]);
    $tipe = htmlspecialchars($data_tugas["tipe"]); 
    $start_tugas = htmlspecialchars($data_tugas["start_tugas"]);
    $end_tugas = htmlspecialchars($data_tugas["end_tugas"]);
    
    // konversi tanggal 
    $tanggal_start = input_tanggal($start_tugas);
    $tanggal_end = input_tanggal($end_tugas);

    

    $query = "UPDATE tb_tugas SET
              user_id = '$user_id',
              tt_number = '$tt_number',
              site_id = '$site_id',
              site_name = '$site_name',
              id_tenant = '$id_tenant',
              status = '$status',
              alamat = '$alamat',
              tipe = '$tipe',
              start_tugas = '$tanggal_start',
              end_tugas = '$tanggal_end'
              WHERE id_tugas = $id_tugas
              ";

    mysqli_query($conn, $query); 

    return mysqli_affected_rows($conn);
}


?>