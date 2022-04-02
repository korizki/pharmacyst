<?php 
    include "connection.php";

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        // handle delete data penjualan
        if($_GET['act'] == "deletesales"){
            $q_del_sales = mysqli_query($connection, "DELETE FROM t_penjualan WHERE id_trx_jual = '$id'");
            // redirect ke halaman pencarian data sales
            if($q_del_sales){
                header('Location: ../pages/summaryMed.php?content=editsales&status=deletesuccess');
            } else {
                header('Location: ../pages/summaryMed.php?content=editsales&status=deletefailed');
            }
        }
        // handle delete data pembelian
        if($_GET['act'] == "deletepurchase"){
            $q_del_purchase = mysqli_query($connection, "DELETE FROM t_pembelian WHERE id_trx_beli = '$id'");
            // redirect ke halaman pencarian data sales
            if($q_del_purchase){
                header('Location: ../pages/summaryMed.php?content=editpurchase&status=deletesuccess');
            } else {
                header('Location: ../pages/summaryMed.php?content=editpurchase&status=deletefailed');
            }
        }
    };
?>