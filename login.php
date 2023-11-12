<?php 
session_start();

require 'function.php';

$err = "";
$username = "";
$password = "";

if(isset($_POST['login'])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username == '' or $password == ''){
        $err .= "Silahkan masukkan Username dan Password.";
    }else{
        $sql1 = "SELECT * FROM admin WHERE username = '$username'";
        $q1 = mysqli_query($conn, $sql1);
        $r1 = mysqli_fetch_array($q1);

        if (empty($r1)){
            $err .= "Username <b>$username</b> tidak tersedia.";
        }elseif ($r1['password'] != md5($password)) {
            $err .= "Password yang Anda masukkan salah.";
        }

        if(empty($err)){
            $_SESSION["login"] = true;
            $_SESSION['id_admin'] = $r1['id_admin'];
            $_SESSION['nama_admin'] = $r1['nama_admin'];
            $_SESSION['session_username'] = $username;
            header("Location: index.php");
            exit(); // Penting untuk menghentikan eksekusi kode setelah melakukan redirect
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" href="css/login.css" >
    <link rel="stylesheet" href="stylelogin.css" >
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Login</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-success fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" style="text-center"><b>SINAR PALASARI INDONESIA</b></a>
        </div>
    </nav>

    <div class="login">
        <h1 class="text-center">FORM LOGIN</h1>
        <hr>
        <form action="" method="POST">
            <div class="form-group">
                <label>Username</label>
                    <div class="input-group">
                        <div class="input-group-prepend" style="margin-top: 15px;">
                            <div class="input-group-text">
                                <i class="fas fa-user" style="padding: 10px;"></i>
                            </div>
                        </div>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan Username Anda" required>
                    </div>
                
                    
            </div>
            <div class="form-group">
                <label>Password</label>
                <div class="input-group">
                        <div class="input-group-prepend" style="margin-top: 15px;">
                            <div class="input-group-text">
                                <i class="fas fa-unlock-alt" style="padding: 10px;"></i>
                            </div>
                        </div>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan Password Anda" required>
                    </div>
            </div>
            <br>
            <?php if(isset($err)) : ?>
                <p style="color: red; font-style: italic;"><?= $err; ?></p>
            <?php endif; ?>            

            <button type="submit" class="btn btn-primary" name="login">Login</button>
        </form>


    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>