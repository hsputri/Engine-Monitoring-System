<?php
session_start();
if (!isset($_SESSION['username']) && (!isset($_SESSION['level']))) {
    header("location: index");
}
require_once 'koneksi.php';
if(isset($_POST['validasi'])){
$username = $_SESSION['username'];
$idform = filter_input(INPUT_POST, 'idform');
echo $idform;
$stmnt = $dbh->prepare("SELECT id, type FROM users WHERE username = '$username'");
$stmnt->execute();
$row = $stmnt->fetch();

echo $row['id'], $row['type'];
}

$stmnt2 = $dbh->prepare("INSERT INTO validasi (iduser, idform, type) VALUES (".$row['id'].",".$idform.",'".$row['type']."')");
$stmnt2 -> execute();

// $stmnt2->debugDumpParams();
// print_r($stmnt2->errorInfo()[2]);
if ($stmnt2) {
    echo '<script>alert("Berhasil Validasi Form");window.location.replace("../report.php");</script>';
} else {
    echo '<script>alert("Gagal Validasi Form");window.location.replace("../report.php");</script>';
}

?>