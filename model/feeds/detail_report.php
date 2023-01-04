<?php

require_once "../koneksi.php";

$id = filter_input(INPUT_GET, "idform");
$stmnt = $dbh->prepare("SELECT idform, ltg, dipo, sifat_perawatan, jenis_kereta, seri_kereta, nogenset, typegenset, tgl_masuk, tgl_test, waktu_mulai, waktu_selesai FROM form WHERE idform = $id");
$stmnt -> execute();

try{
    $output = array();
    while($row = $stmnt->fetch()){
        $output = [$row["idform"],$row["ltg"], $row["dipo"], $row["sifat_perawatan"], $row['jenis_kereta'], $row['seri_kereta'], $row['nogenset'], $row['typegenset'], $row['tgl_masuk'], $row['tgl_test'], $row['waktu_mulai'], $row['waktu_selesai']];
    }
    echo '{"data": ' . json_encode($output) . '}';
}catch(Exception $ex){
    echo $ex->getMessage();
}