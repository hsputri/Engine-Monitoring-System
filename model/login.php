<?php

session_start();
require_once 'koneksi.php';
$op = $_GET['op'];
if ($op == "in") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = filter_input(INPUT_POST, "username");
        $password = filter_input(INPUT_POST, "password");
        $query = "SELECT * FROM `users` WHERE username='$username'";
        $stmnt = $dbh->prepare($query);
        $stmnt->execute();
        if ($stmnt->rowCount() == 0) {
            echo '<script type="text/javascript">alert("Username tidak ditemukan");window.location.replace("../index.php");</script>';
            //header("Refresh:0; url=index.php");
        } else {
            $query = "SELECT * FROM `users` WHERE username='$username' and password='".$password . "'";
            $stmnt = $dbh->prepare($query);
            $stmnt->execute();
            if ($stmnt->rowCount() == 0) {
                echo "<script type='text/javascript'>alert('Password anda salah'); window.location.replace('../index.php');</script>";
                //header("Refresh:0; url=index.php");
            } else {
                while ($row = $stmnt->fetch()) {
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['level'] = $row['type'];
                    if (($_SESSION['username'] == $row['username']) && ($_SESSION['level'] == 'admin')) {
                        echo "<script type='text/javascript'>alert('Berhasil Masuk'); window.location.replace('../usertable.php');</script>";
                    }else{
                        echo "<script type='text/javascript'>alert('Berhasil Masuk'); window.location.replace('../datatable.php');</script>";   
                    }
                }
            }
        }
    } else {
        header("Location: index.php");
    }
} else if ($op == "out") {
    unset($_SESSION['username']);
    unset($_SESSION['level']);
    echo '<script>alert("Berhasil Logout");window.location.replace("../index.php");</script>';
}
?>
