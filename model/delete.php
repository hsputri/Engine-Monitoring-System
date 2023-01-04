<?php

require_once 'koneksi.php';

if (isset($_GET['idu'])){
    $idu = filter_input(INPUT_GET, "idu");
    $role = $dbh->prepare("DELETE FROM `users` WHERE id = $idu");
    $role->execute();
    if($role){
        echo '<script>alert("Berhasil Menghapus");window.location.replace("../usertable.php");</script>';
    }else{
        echo '<script>alert("Gagal Menghapus");window.location.replace("../usertable.php");<script>';
    }
}

if (isset($_GET['idf'])){
    $idf = filter_input(INPUT_GET, "idf");
    $role = $dbh->prepare("DELETE FROM `form` WHERE idform = $idf");
    $role->execute();
    
    if($role){
        echo '<script>alert("Berhasil Menghapus");window.location.replace("../form.php");</script>';
    }else{
        echo '<script>alert("Gagal Menghapus");window.location.replace("../form.php");<script>';
    }
}

?>