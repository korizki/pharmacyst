<?php
    // Koneksi ke database localhost
    include "connection.php";
    // Handle Submit input data obat
    if(isset($_POST['tambahobat'])){
        $idobat = $_POST['idobat'];
        $namaobat = $_POST['namaobat'];
        $satuan = $_POST['satuan'];
        $jenis = $_POST['jenis'];
        $supplier = $_POST['supplier'];
        $hargabeli = $_POST['hargabeli'];
        $hargajual = $_POST['hargajual'];
        $expirydate = $_POST['expirydate'];
        $sqlinputobat = mysqli_query($connection, "INSERT INTO t_obat VALUES('$idobat','$namaobat','$satuan','$jenis','$supplier','$hargabeli','$hargajual','$expirydate')");
        if($sqlinputobat){
            $cekobat = mysqli_query($connection, "SELECT * FROM t_stok WHERE nama_obat_stok = '$namaobat'");
            if(mysqli_num_rows($cekobat) < 1){
                $tambahstok = mysqli_query($connection, "INSERT INTO t_stok VALUES (NULL, '$namaobat', 0)");
            }
            header('Location: ../pages/summaryMed.php?content=addmedicine&status=inputmedsuccess');
        } else {
            header('Location: ../pages/summaryMed.php?content=addmedicine&status=inputmedfailed');
        }
    };
    // simpan data penjualan
    if(isset($_POST['simpansales'])){
        $idkw = $_POST['idkw'];
        $tgljual = $_POST['tgljual'];
        $namaobatjual = $_POST['namaobatjualok'];
        $jmlhjual = $_POST['jmlhjual'];
        $hrgjual = $_POST['hrgjual'];
        $hrgmodal = $_POST['hrgmodal'];
        // total penjualan
        $hrgtotal = (int)$hrgjual * (int)$jmlhjual;
        // total modal
        $totmodal = (int)$hrgmodal * (int)$jmlhjual;
        // total laba
        $laba = $hrgtotal - $totmodal;
        $simpanjual = mysqli_query($connection, "INSERT INTO t_penjualan VALUES(NULL, '$idkw','$tgljual','$namaobatjual', '$jmlhjual','$hrgjual','$hrgtotal','$hrgmodal','$laba')");
        if($simpanjual){
            header("Location: ../pages/summaryMed.php?content=addsales&status=addsalessuccess");
        } else {
            header("Location: ../pages/summaryMed.php?content=addsales&status=addsalesfailed");
        }
    }
    // simpan data pembelian
    if(isset($_POST['simpanpurchase'])){
        $idkw = $_POST['idkw'];
        $tglbeli = $_POST['tglbeli'];
        $namaobatbeli = $_POST['namaobatbeli'];
        $jmlhbeli = $_POST['jmlhbeli'];
        $hrgbeli = $_POST['hrgbeli'];
        // total pembelian
        $hrgtotalbeli = (int)$hrgbeli * (int)$jmlhbeli;
        $simpanbeli = mysqli_query($connection, "INSERT INTO t_pembelian VALUES(NULL, '$idkw','$tglbeli','$namaobatbeli', '$jmlhbeli','$hrgbeli','$hrgtotalbeli')");
        if($simpanbeli){
            header('Location: ../pages/summaryMed.php?content=addpurchase&status=addpurchasesuccess');
        } else {
            header('Location: ../pages/summaryMed.php?content=addpurchase&status=addpurchasefailed');
        }
    }

?>