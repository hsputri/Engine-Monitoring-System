<?php

require_once 'koneksi.php';
if(isset($_POST['update'])){
    $id = filter_input(INPUT_POST, "id");
    $nip = filter_input(INPUT_POST, "nipp");
    $nama = filter_input(INPUT_POST, "nama");
    $divisi = filter_input(INPUT_POST, "divisi");
    $email = filter_input(INPUT_POST, "email");

    // echo $id, $nip, $nama, $divisi;
    $stmnt = $dbh->prepare("UPDATE users SET nipp = '".$nip."', nama = '".$nama."', divisi = '".$divisi."',email = '".$email."' WHERE id = $id");
    $stmnt->execute();
    if ($stmnt) {
        echo '<script>alert("Berhasil Mengubah");window.location.replace("../usertable.php");</script>';
    } else {
        echo '<script>alert("Gagal Meng ubah");window.location.replace("../usertable.php");</script>';
    }

}
?>