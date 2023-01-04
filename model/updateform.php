<?php

require_once 'koneksi.php';
if(isset($_POST['update'])){
    $id = filter_input(INPUT_POST, "idform");
    $ltg = filter_input(INPUT_POST, "ltg");
    $dipo = filter_input(INPUT_POST, "dipo");
    $sifat_perawatan = filter_input(INPUT_POST, "sifat_perawatan");
	$jenis_kereta = filter_input(INPUT_POST, "jenis_kereta");
	$seri_kereta = filter_input(INPUT_POST, "seri_kereta");
	$nogenset = filter_input(INPUT_POST, "nogenset");
	$typegenset = filter_input(INPUT_POST, "typegenset");
	$tgl_masuk = filter_input(INPUT_POST, "tgl_masuk");
    $tgl_test = filter_input(INPUT_POST, "tgl_test");
    $waktu_mulai = filter_input(INPUT_POST, "waktu_mulai");
    $waktu_selesai = filter_input(INPUT_POST, "waktu_selesai");

    // echo $id, $ltg, $dipo, $sifat_perawatan, $jenis_kereta, $seri_kereta, $nogenset, $typegenset, $tgl_masuk, $tgl_test;
    $stmnt = $dbh->prepare("UPDATE form SET ltg = '".$ltg."', dipo = '".$dipo."', sifat_perawatan = '".$sifat_perawatan."' , 
    jenis_kereta = '".$jenis_kereta."', seri_kereta = '".$seri_kereta."', nogenset = '".$nogenset."', typegenset = '".$typegenset."', tgl_masuk = '".$tgl_masuk."', tgl_test = '".$tgl_test."', waktu_mulai = '".$waktu_mulai."', waktu_selesai = '".$waktu_selesai."' WHERE idform = $id");
    $stmnt->execute();
    // $stmnt->debugDumpParams();
    // print_r($stmnt->errorInfo()[2]);
    if ($stmnt) {
        echo '<script>alert("Berhasil Mengubah");window.location.replace("../form.php");</script>';
    } else {
        echo '<script>alert("Gagal Meng ubah");window.location.replace("../form.php");</script>';
    }

}
?>