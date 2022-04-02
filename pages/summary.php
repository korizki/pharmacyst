<?php 
    $now = date('Y-m-d');
    // informasi hari ini
    function cekSum($field, $asfield, $now){
        include "../code/connection.php";
        return mysqli_query($connection, "SELECT SUM($field) AS $asfield FROM t_penjualan WHERE tanggal_trx_jual = '$now' ");
    }
    $inctoday = cekSum('harga_total_jual', 'TOTAL', $now);
    $itemtoday = cekSum('jumlah_obat_jual', 'TOTALOBAT', $now);
    $labatoday = cekSum('laba_jual', 'TOTALLABA', $now);
    $inctodayx = mysqli_fetch_array($inctoday);
    $itemtodayx = mysqli_fetch_array($itemtoday);
    $labatodayx = mysqli_fetch_array($labatoday);
    $cekstokobat = mysqli_query($connection, "SELECT * FROM t_stok WHERE jumlah_obat_stok <= 3");
    $cekstokobatok = mysqli_num_rows($cekstokobat);
?>
<div class="contentSummary">
    <h1>Informasi untukmu hari ini!</h1>
    <div class="controw1">
        <div class="box">
            <i class="fi fi-rr-chart-histogram"></i>
            <div>
                <h1>Sales Today</h1>
                <div>
                    <h2>Rp <?php echo number_format($inctodayx['TOTAL'])?>,-</h2>
                    <p>Total penjualan hari ini</p>
                </div>
            </div>
        </div>
        <div class="box">
            <i class="fi fi-rr-medicine"></i>
            <div>
                <h1>Item Sold Today</h1>
                <div>
                    <h2><?php echo number_format($itemtodayx['TOTALOBAT'])?> Item</h2>
                    <p>Total obat terjual hari ini</p>
                </div>
            </div>
        </div>
        <div class="box">
            <i class="fi fi-rr-dollar"></i>
            <div>
                <h1>Profit Today</h1>
                <div>
                    <h2>Rp <?php echo number_format($labatodayx['TOTALLABA'])?>,-</h2>
                    <p>Total keuntungan hari ini</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="contentSummary" style="margin-top:40px" >
    <h1>Yang menjadi perhatian!</h1>
    <div class="controw1">
        <div class="box box2">
            <div>
                <h1> <i class="fi fi-rr-search-alt " style="margin-inline-end: 8px; position:relative; top: 3px"></i> Stok Minim</h1>
                <div>
                    <p>Stok beberapa obatmu minim, jangan sampai terlewat, cek kembali apakah sudah waktunya di re-stock?</p>
                </div>
                <button class="buttoncek">Cek Sekarang!</button>
            </div>
            <h2 class='itemrow2'><?php echo $cekstokobatok ?></h2>
        </div>
        <div class="box box2">
            <div>
                <h1><i class="fi fi-rr-shield-exclamation" style="margin-inline-end: 8px; position:relative; top: 3px"></i> Cek Kadaluarsa</h1>
                <div>
                    <p>Beberapa obatmu hampir kadaluarsa, segera ambil tindakan terhadap obat tersebut ya.</p>
                </div>
                <button class="buttoncek">Cek Sekarang!</button>
            </div>
            <h2 class='itemrow2'>20</h2>
        </div>
        <div class="box box2">
            <div>
                <h1><i class="fi fi-rr-shopping-cart-add" style="margin-inline-end: 10px; position:relative; top: 3px"></i>Sering Dicari</h1>
                <div>
                    <p>Ada beberapa obat dengan penjualan cukup tinggi, apakah ini waktunya re-stok lebih banyak. </p>
                </div>
                <button class="buttoncek">Cek Sekarang!</button>
            </div>
            <h2 class='itemrow2'>20</h2>
        </div>
    </div>
</div>