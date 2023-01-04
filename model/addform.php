

<?php
    require_once "koneksi.php";

if (isset($_POST['simpan_form'])){
    // date_default_timezone_set("Asia/Jakarta");
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
    
    echo $ltg, $dipo, $sifat_perawatan, $jenis_kereta, $tgl_test;

	$stmnt = $dbh->prepare("INSERT INTO form (ltg, dipo, sifat_perawatan, jenis_kereta, seri_kereta, nogenset, typegenset, tgl_masuk, tgl_test, waktu_mulai, waktu_selesai) VALUES ('".$ltg."','".$dipo."','".$sifat_perawatan."','".$jenis_kereta."','".$seri_kereta."','".$nogenset."','".$typegenset."','".$tgl_masuk."','".$tgl_test."','".$waktu_mulai."','".$waktu_selesai."')");
    $stmnt -> execute();
	
    $stmnt->debugDumpParams();
    print_r($stmnt->errorInfo()[2]);
    if ($stmnt) {
        echo '<script>alert("Berhasil Menambah Form");window.location.replace("../form.php");</script>';
    } else {
        echo '<script>alert("Gagal Menambah Form");window.location.replace("../addform.php");</script>';
    }
}
?>