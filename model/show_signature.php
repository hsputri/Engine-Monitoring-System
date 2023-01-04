<?php
// $link = new mysqli('localhost', 'root', '', 'signature');
require_once "koneksi.php";
//cek apakah koneksi dengan MySQL berhasil
$sql="SELECT * FROM users ORDER BY id DESC";
$result=mysqli_query($link,$sql);

$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

$filename = $row['img'];
$image = $row['base64'];

$pecah = explode(",", $image);
echo '<img src="data:image/jpeg;base64,'.$hasil = $pecah[1].'"/>';
?>