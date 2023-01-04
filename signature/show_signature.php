<?php
// $link = new mysqli('localhost', 'root', '', 'signature');
require_once "../model/koneksi.php";
//cek apakah koneksi dengan MySQL berhasil
// $sql="SELECT * FROM users WHERE username = 'hsputri' ORDER BY id DESC";
// $result=mysqli_query($link,$sql);

// $row=mysqli_fetch_array($result,MYSQLI_ASSOC);

$stmnt = $dbh->prepare("SELECT * FROM users WHERE username = 'hsputri' ORDER BY id DESC");
$stmnt->execute();
$row = $stmnt->fetch();


$filename = $row['img'];
$image = $row['base64'];

$pecah = explode(",", $image);
echo '<img src="data:image/jpeg;base64,'.$hasil = $pecah[1].'"/>';
?>