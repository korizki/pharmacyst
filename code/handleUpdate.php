<?php 
    include "connection.php";
    if(isset($_POST['updateobat'])){
        $idobat = $_POST['idobat'];
        $namaobat = $_POST['namaobat'];
        $satuan = $_POST['satuan'];
        $jenis = $_POST['jenis'];
        $supplier = $_POST['supplier'];
        $hargabeli = $_POST['hargabeli'];
        $hargajual = $_POST['hargajual'];
        $expirydate = $_POST['expirydate'];

        $queryupdate = mysqli_query($connection, "UPDATE t_obat SET nama_obat = '$namaobat', satuan='$satuan', jenis_obat='$jenis', supplier_obat='$supplier', harga_beli_obat = '$hargabeli', harga_jual_obat='$hargajual', expired_date='$expirydate' WHERE id_obat = '$idobat' ");
        if($queryupdate){
            header('Location: ../pages/summaryMed.php?content=editmedicine&status=editobatsuccess');
        } else {
            header('Location: ../pages/summaryMed.php?content=editmedicine&status=editobatfailed');
        }
    }

?>