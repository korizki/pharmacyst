<?php 
    
    function getSatuan($namaobat){
        include "connection.php";
        return mysqli_query($connection, "SELECT satuan AS SATUAN FROM t_obat WHERE nama_obat = '$namaobat' ");
    }
    
?>