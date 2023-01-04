<?php

require_once "../koneksi.php";

$id = filter_input(INPUT_GET, "id");
$stmnt = $dbh->prepare("SELECT id, nipp, nama, divisi,email, `type` FROM users WHERE id = $id");
$stmnt -> execute();

try{
    $output = array();
    while($row = $stmnt->fetch()){
        $output = [$row["id"],$row["nipp"], $row["nama"], $row["divisi"],$row["email"], $row['type']];
    }
    echo '{"data": ' . json_encode($output) . '}';
}catch(Exception $ex){
    echo $ex->getMessage();
}