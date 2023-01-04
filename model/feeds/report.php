<?php

require_once "../koneksi.php";

$stmnt = $dbh->prepare("SELECT idform, ltg, dipo, sifat_perawatan, jenis_kereta, seri_kereta, nogenset, typegenset, tgl_masuk, tgl_test, waktu_mulai, waktu_selesai  FROM `form` ORDER BY idform DESC");
$stmnt -> execute();

try{
    $output = array();
    $i = 0;
    $no = 1;    
    while($row = $stmnt->fetch()){
        $output[$i] = [$no, $row["ltg"],  $row["seri_kereta"], $row["nogenset"], 
        '<a href="#!" class="btn btn-primary btn-sm edit-form" data-toggle="modal" data-target="#modal-xl" data-idform="' . $row['idform'] . '"><i class="fa fa-edit"></i> Validasi</a>
        <a href="model/pdf.php?id='.$row["idform"].'" target="_blank" class="btn btn-danger btn-sm"><i class="fa fa-download"></i> Generate PDF</a>
        '];
        $i++;
        $no++;
    }
    echo '{"data": ' . json_encode($output) . '}';
}catch(Exception $ex){
    echo $ex->getMessage();
}