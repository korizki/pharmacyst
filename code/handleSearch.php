<?php 
    include "connection.php";
    // handle cari penjualan
    if(isset($_GET['caridengannama'])){
        $namaobatjual = $_GET['namaobatjual'];
        header("Location: ../pages/summaryMed.php?content=editsales&cari=nama&namaobat=$namaobatjual");
    } else if(isset($_GET['caridengantanggal'])){
        $tanggal = $_GET['tanggalsales'];
        header("Location: ../pages/summaryMed.php?content=editsales&cari=tanggal&tanggal=$tanggal");
    } else if(isset($_GET['caribelinama'])){
        $namaobatjual = $_GET['namaobatbeli'];
        header("Location: ../pages/summaryMed.php?content=editpurchase&cari=nama&namaobat=$namaobatjual");
    } else if(isset($_GET['caribelitanggal'])){
        $tanggal = $_GET['tanggalbeli'];
        header("Location: ../pages/summaryMed.php?content=editpurchase&cari=tanggal&tanggal=$tanggal");
    } else if(isset($_GET['cariobatnama'])){
        $obat = $_GET['namaobat'];
        header("Location: ../pages/summaryMed.php?content=editmedicine&cari=nama&nama=$obat");
    } else if(isset($_GET['cariobatkategori'])){
        $kategori = $_GET['jenis'];
        header("Location: ../pages/summaryMed.php?content=editmedicine&cari=kategori&kategori=$kategori");
    } 


?>