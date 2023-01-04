<?php
//buat koneksi dengan MySQL
// $link = new mysqli('localhost', 'root', '', 'signature');
require_once "../model/koneksi.php";
 
// requires php5
define('UPLOAD_DIR', 'images/');
$img = $_POST['img'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$file = UPLOAD_DIR . uniqid() . '.jpeg';
$success = file_put_contents($file, $data);

//insert ke database
// mysqli_query($link ,"INSERT INTO users (img,base64,status) VALUES('$file','$img',0)");
$stmnt = $dbh->prepare("INSERT INTO users (img,base64,status) VALUES ('".$file."','".$img."',0)");
$stmnt -> execute();
//tampilkan hasil
header("location:show_signature.php");

?>