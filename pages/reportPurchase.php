<script>
    // membuka menu detail penjulaan
    document.getElementById('detpurchase').open = true;
</script>
<?php 
    
    include "../code/connection.php";
    if(isset($_GET['genreport'])){
        (isset($_GET['startdate'])) ? $_GET['startdate'] : date(); 
        $startdate = $_GET['startdate'];
        $enddate = $_GET['enddate'];
    } else {
        $startdate = date('Y-m-d');
        $enddate = date('Y-m-d');
    }
    // query tanggal grafik poin label
    $querytanggal = mysqli_query($connection, "SELECT DISTINCT tanggal_trx_beli AS TANGGAL from t_pembelian WHERE tanggal_trx_beli BETWEEN '$startdate' AND '$enddate' ");
    // query tanggal grafik poin total pembelian
    $querytanggal2 = mysqli_query($connection, "SELECT DISTINCT tanggal_trx_beli AS TANGGAL from t_pembelian WHERE tanggal_trx_beli BETWEEN '$startdate' AND '$enddate' ");
    // query tanggal tabel total pembelian
    $querytanggal3 = mysqli_query($connection, "SELECT DISTINCT tanggal_trx_beli AS TANGGAL from t_pembelian WHERE tanggal_trx_beli BETWEEN '$startdate' AND '$enddate' ");
    $querytanggal4 = mysqli_query($connection, "SELECT DISTINCT tanggal_trx_beli AS TANGGAL from t_pembelian WHERE tanggal_trx_beli BETWEEN '$startdate' AND '$enddate' ");
    $querytotalbeli = mysqli_query($connection, "SELECT SUM(total_pembelian) AS TOTALBELI FROM t_pembelian WHERE tanggal_trx_beli BETWEEN '$startdate' AND '$enddate'");

    $queryjmlhobat = mysqli_query($connection, "SELECT SUM(jumlah_obat_beli) AS TOTALOBAT FROM t_pembelian WHERE tanggal_trx_beli BETWEEN '$startdate' AND '$enddate'");

    // function mengembalikan total penjualan di tanggal tertentu
    function getPurchase($date){
        include "../code/connection.php";
        return mysqli_query($connection, "SELECT SUM(total_pembelian) AS TOTALBELI FROM t_pembelian WHERE tanggal_trx_beli = '$date'");
    };
    function getMedicine($date){
        include "../code/connection.php";
        return mysqli_query($connection, "SELECT SUM(jumlah_obat_beli) AS TOTALOBAT FROM t_pembelian WHERE tanggal_trx_beli = '$date'");
    }
    
?>
<div  class='inputDataBox'>
    
    <h1>Laporan Pembelian </h1>
    <form action="summaryMed.php" method="get">
        <div class="datebox">
            <input type="text" name="content" value="reppurchase" style="display: none" readonly>
            <div>
                <label for="startdate">Tanggal Awal</label>
                <input type="date" name="startdate" value="<?php echo $startdate ?>">
            </div>
            <div>
                <label for="enddate">Tanggal Akhir</label>
                <input type="date" name="enddate" value="<?php echo $enddate ?>">
            </div>
            <button stype="submit" name="genreport"><i class="fa fa-paper-plane" style="margin-inline-end: 8px"></i>Tampilkan Laporan Pembelian</button>
        </div>
    </form>
    <div class="boxreport">
        <div class="section sec1">
            <div>
                <div>
                    <p>Total Pembelian (Rupiah)</p>
                    <h2>Rp <?php echo (isset($startdate)) ? number_format(mysqli_fetch_array($querytotalbeli)['TOTALBELI']) : '' ?>,-</h2>
                </div>
                
                <div>
                    <p>Jumlah Beli Obat (Pcs)</p>
                    <h2><?php echo (isset($enddate)) ? number_format(mysqli_fetch_array($queryjmlhobat)['TOTALOBAT']) : '' ?> Pcs</h2>
                </div>
            </div>
            
            <div class="chartarea">
                <canvas id="myChart" width="750" height="400"></canvas>
                <script>
                const ctx = document.getElementById('myChart').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: [<?php 
                            while($rowt = mysqli_fetch_array($querytanggal)){
                                echo "'".date('d', strtotime($rowt['TANGGAL']))."',";
                            }
                        ?>],
                        datasets: [
                        {
                            label: 'Total Pembelian (dalam Rupiah)',
                            data: [
                                <?php 
                                
                                // perulangan untuk mendapatkan total jual di setiap tanggal
                                while($rowx = mysqli_fetch_array($querytanggal2)){
                                    echo mysqli_fetch_array(getPurchase($rowx['TANGGAL']))['TOTALBELI'];echo ",";
                                }
                            
                                ?>
                            ],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                            ],
                            borderWidth: 2,
                            tension: 0.2
                        },
                    ]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
                </script>
            </div>
        </div>
    </div>
    
    <div class="boxreport" >
        <h1>List Transaksi Pembelian</h1>
        <div class="tablebox">
        
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Total Pembelian (Rupiah)</th>
                        <th>Total Pembelian Obat (Pcs)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        
                        $no = 1;
                        while($rowy = mysqli_fetch_array($querytanggal3)){
                            ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo date('d-m-Y', strtotime($rowy['TANGGAL'])); ?></td>
                                <td><?php echo number_format(mysqli_fetch_array(getPurchase($rowy['TANGGAL']))['TOTALBELI']); ?></td>
                                <td><?php echo number_format(mysqli_fetch_array(getMedicine($rowy['TANGGAL']))['TOTALOBAT']); ?></td>
                            </tr>
                            <?php
                        }
                    
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>