<?php

require_once "../koneksi.php";

$stmnt = $dbh->prepare("SELECT 'type' FROM `type` ORDER BY id DESC");
$stmnt -> execute();
$row = $stmnt->fetch();