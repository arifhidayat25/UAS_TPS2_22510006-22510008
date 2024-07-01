<?php 
    session_start();
    include "koneksi.php";

    if (!isset($_SESSION['namaUser']))
    {
        echo "<script>window.location.replace(\"index.php\");</script>";
        exit();
    }

    $periode = $_POST['txtPeriode'];
    $idSiswa = $_POST['txtNama'];
    $idTari = $_POST['cbbTari'];
    $metode = $_POST['cbbMetode'];
    $rand = rand(1000, 9999);

    $st = "INSERT INTO t_sista
            VALUES ('$rand','$idSiswa','$idTari','$metode','-','$periode')";
    
    $qrySS = mysqli_query($conSS, $st);

    echo "<script>window.location.replace(\"frmsiswa.php\");</script>";
    exit();
?>