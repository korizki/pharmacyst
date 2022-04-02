<?php 
    include "connection.php";
    // handle update data obat
    if(isset($_POST['updateobat'])){
        $idobat = $_POST['idobat'];
        $namaobat = $_POST['namaobat'];
        $satuan = $_POST['satuan'];
        $jenis = $_POST['jenis'];
        $supplier = $_POST['supplier'];
        $hargabeli = $_POST['hargabeli'];
        $hargajual = $_POST['hargajual'];
        $expirydate = $_POST['expirydate'];
        // query update data
        $queryupdate = mysqli_query($connection, "UPDATE t_obat SET nama_obat = '$namaobat', satuan='$satuan', jenis_obat='$jenis', supplier_obat='$supplier', harga_beli_obat = '$hargabeli', harga_jual_obat='$hargajual', expired_date='$expirydate' WHERE id_obat = '$idobat' ");
        // jika berhasil redirect ke halaman edit data
        if($queryupdate){
            header('Location: ../pages/summaryMed.php?content=editmedicine&status=editobatsuccess');
        } else {
            header('Location: ../pages/summaryMed.php?content=editmedicine&status=editobatfailed');
        }
    }
    // handle update data sales
    if(isset($_POST['updatesales'])){
        $idobat = $_POST['idobat'];
        $namaobat = $_POST['namaobatjualok'];
        $hrgjual = $_POST['hrgjual'];
        $hrgmodal = $_POST['hrgmodal'];
        $tgljual = $_POST['tgljual'];
        $idkw = $_POST['idkw'];
        $jmlhjual = $_POST['jmlhjual'];
        // total penjualan
        $hrgtotal = (int)$hrgjual * (int)$jmlhjual;
        // total modal
        $totmodal = (int)$hrgmodal * (int)$jmlhjual;
        // total laba
        $laba = $hrgtotal - $totmodal;
        // query update data
        $queryupdate = mysqli_query($connection, "UPDATE t_penjualan SET no_bukti_jual='$idkw', tanggal_trx_jual='$tgljual', nama_obat_jual='$namaobat', jumlah_obat_jual='$jmlhjual',harga_obat_jual='$hrgjual', harga_total_jual='$hrgtotal', harga_modal='$hrgmodal', laba_jual='$laba' WHERE id_trx_jual='$idobat' ");
        // jika berhasil redirect ke halaman edit data
        if($queryupdate){
            header('Location: ../pages/summaryMed.php?content=editsales&status=editsalessuccess');
        } else {
            header('Location: ../pages/summaryMed.php?content=editsales&status=editsalesfailed');
        }
    }

?>