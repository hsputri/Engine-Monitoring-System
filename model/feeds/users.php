<?php

require_once "../koneksi.php";

$stmnt = $dbh->prepare("SELECT id, nipp, nama, divisi, email, username FROM `users` ORDER BY id DESC");
$stmnt -> execute();

try{
    $output = array();
    $i = 0;
    $no = 1;
    while($row = $stmnt->fetch()){
        $output[$i] = [$no, $row["nipp"], $row["nama"], $row["divisi"], $row["email"],
        '<a href="#!" class="btn btn-info edit-user" data-toggle="modal" data-target="#modal-default" data-id="' . $row['id'] . '"><i class="fa fa-edit"></i> Edit</a>
        <button class="btn btn-danger delete-user" idu="' . $row['id'] . '" data-id="' . $row['id'] . '"><i class="fa fa-trash"></i> Hapus</button>'];
        $i++;
        $no++;
    }
    echo '{"data": ' . json_encode($output) . '}';
}catch(Exception $ex){
    echo $ex->getMessage();
}