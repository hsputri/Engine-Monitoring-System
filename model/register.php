<?php
    require_once "koneksi.php";

if (isset($_POST['hak_akses'])){
    // date_default_timezone_set("Asia/Jakarta");
    $nipp = filter_input(INPUT_POST, "nipp");
    $nama = filter_input(INPUT_POST, "nama");
    $divisi = filter_input(INPUT_POST, "divisi");
    $email = filter_input(INPUT_POST, "email");
    $username = filter_input(INPUT_POST, "username");

    // echo $nipp, $nama, $divisi, $username;
    $length = 10;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    echo $randomString;
    $stmnt = $dbh->prepare("INSERT INTO users (nipp, nama, divisi, email, username, `password`) VALUES ('".$nipp."','".$nama."','".$divisi."','".$email."','".$username."','".$randomString."')");
    $stmnt -> execute();
    // $stmnt->debugDumpParams();
    // print_r($stmnt->errorInfo()[2]);
    if ($stmnt) {
        echo '<script>alert("Berhasil Menambah User");window.location.replace("../usertable.php");</script>';
    } else {
        echo '<script>alert("Gagal Menambah User");window.location.replace("../usertable.php");</script>';
    }
}
?>