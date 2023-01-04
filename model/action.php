<?php
session_start();
if (!isset($_SESSION['username']) && (!isset($_SESSION['level']))) {
    header("location: index");
}
require_once 'koneksi.php';

$username = $_SESSION['username'];
$query = $_GET['id'];
// echo $query;

//CHECK ID
$stmnt = $dbh->prepare("SELECT id FROM users WHERE username='$username'");
$stmnt->execute();
$row = $stmnt->fetch();

$stmnt2 = $dbh->prepare("UPDATE engine SET operator = ".$row['id']." WHERE idsuhu = $query");
$stmnt2->execute();
if ($stmnt2) {
    echo '<script>alert("Berhasil Mengubah");window.location.replace("../datatable.php");</script>';
} else {
    echo '<script>alert("Gagal Mengubah");window.location.replace("../datatable.php");</script>';
}
?>