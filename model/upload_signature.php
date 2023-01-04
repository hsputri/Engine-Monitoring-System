<?php
//buat koneksi dengan MySQL
session_start();
if (!isset($_SESSION['username']) && (!isset($_SESSION['level']))) {
    header("location: index");
}
require_once "koneksi.php";

$username = $_SESSION['username'];

// requires php5
define('UPLOAD_DIR', '../signature/images/');
// $img = filter_input(INPUT_POST, "img");
$img = $_POST['img'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$file = UPLOAD_DIR . uniqid() . '.jpeg';
$success = file_put_contents($file, $data);


$stmnt = $dbh->prepare("UPDATE users SET img = '".$file."', base64 = '".$img."', status = 0 WHERE username = '".$username."'");
$stmnt->execute();

if ($stmnt){
    echo '<script> alert("Berhasil Menambah Tanda Tangan");window.location.replace("../signature.php");</script>';
}else{
    echo '<script> alert("Gagal Menambah Tanda Tangan");window.location.replace("../signature.php");</script>';
}

?>