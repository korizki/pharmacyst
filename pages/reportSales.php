<script>
    // membuka menu detail penjulaan
    document.getElementById('detpenjualan').open = true;
</script>
<?php 
    include "../code/connection.php";
    if(isset($_GET['genreport'])){
        $startdate = $_GET['startdate'];
        $enddate = $_GET['enddate'];
    } else {
        $startdate = date('Y-m-d');
        $enddate = date('Y-m-d');
    }
    // query tanggal grafik poin label
    $querytanggal = mysqli_query($connection, "SELECT DISTINCT tanggal_trx_jual AS TANGGAL from t_penjualan WHERE tanggal_trx_jual BETWEEN '$startdate' AND '$enddate' ");
    // query tanggal grafik poin total penjualan
    $querytanggal2 = mysqli_query($connection, "SELECT DISTINCT tanggal_trx_jual AS TANGGAL from t_penjualan WHERE tanggal_trx_jual BETWEEN '$startdate' AND '$enddate' ");
    // query tanggal tabel total penjualan
    $querytanggal3 = mysqli_query($connection, "SELECT DISTINCT tanggal_trx_jual AS TANGGAL from t_penjualan WHERE tanggal_trx_jual BETWEEN '$startdate' AND '$enddate' ");
    $querytanggal4 = mysqli_query($connection, "SELECT DISTINCT tanggal_trx_jual AS TANGGAL from t_penjualan WHERE tanggal_trx_jual BETWEEN '$startdate' AND '$enddate' ");
    $querytotaljual = mysqli_query($connection, "SELECT SUM(harga_total_jual) AS TOTALJUAL FROM t_penjualan WHERE tanggal_trx_jual BETWEEN '$startdate' AND '$enddate'");
    $querytotallaba = mysqli_query($connection, "SELECT SUM(laba_jual) AS TOTALLABA FROM t_penjualan WHERE tanggal_trx_jual BETWEEN '$startdate' AND '$enddate'");
    $queryjmlhobat = mysqli_query($connection, "SELECT SUM(jumlah_obat_jual) AS TOTALOBAT FROM t_penjualan WHERE tanggal_trx_jual BETWEEN '$startdate' AND '$enddate'");
    
    // function mengembalikan total penjualan di tanggal tertentu
    function getSales($date){
        include "../code/connection.php";
        return mysqli_query($connection, "SELECT SUM(harga_total_jual) AS TOTALJUAL FROM t_penjualan WHERE tanggal_trx_jual = '$date'");
    };
    // function mengembalikan total keuntungan di tanggal tertentu
    function getProfit($date){
        include "../code/connection.php";
        return mysqli_query($connection, "SELECT SUM(laba_jual) AS TOTALLABA FROM t_penjualan WHERE tanggal_trx_jual = '$date'");
    };
?>
<div  class='inputDataBox'>
    <h1>Laporan Penjualan</h1>
    <form action="summaryMed.php" method="get">
        <div class="datebox">
            <input type="text" name="content" value="repsales" style="display: none" readonly>
            <div>
                <label for="startdate">Tanggal Awal</label>
                <input type="date" name="startdate" value="<?php echo $startdate ?>">
            </div>
            <div>
                <label for="enddate">Tanggal Akhir</label>
                <input type="date" name="enddate" value="<?php echo $enddate ?>">
            </div>
            <button stype="submit" name="genreport"><i class="fa fa-paper-plane" style="margin-inline-end: 8px"></i>Tampilkan Laporan Penjualan</button>
        </div>
    </form>
    <div class="boxreport">
        <div class="section sec1">
            <div>
                <div>
                    <p>Total Keuntungan</p>
                    <h2>Rp <?php echo (isset($startdate)) ? number_format(mysqli_fetch_array($querytotallaba)['TOTALLABA']) : '' ;?>,-</h2>
                </div>
                <div>
                    <p>Total Penjualan</p>
                    <h2>Rp <?php echo (isset($startdate)) ? number_format(mysqli_fetch_array($querytotaljual)['TOTALJUAL']) : '' ?>,-</h2>
                </div>
                
                <div>
                    <p>Total Obat Terjual</p>
                    <h2><?php echo (isset($startdate)) ? number_format(mysqli_fetch_array($queryjmlhobat)['TOTALOBAT']) : '' ?> Pcs</h2>
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
                            label: 'Total Penjualan (dalam Rupiah)',
                            data: [
                                <?php 
                                
                                // perulangan untuk mendapatkan total jual di setiap tanggal
                                while($rowx = mysqli_fetch_array($querytanggal2)){
                                    echo mysqli_fetch_array(getSales($rowx['TANGGAL']))['TOTALJUAL'];echo ",";
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
                        {
                            label: 'Total Keuntungan (dalam Rupiah)',
                            data: [
                                <?php 
                                while($ro = mysqli_fetch_array($querytanggal4)){
                                    echo mysqli_fetch_array(getProfit($ro['TANGGAL']))['TOTALLABA'];echo ",";
                                }
                            
                                ?>
                            ],
                            backgroundColor: [
                                'rgba(42, 116, 255, 0.2)',
                            ],
                            borderColor: [
                                'rgba(42, 116, 255, 1)',
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
        <h1>List Transaksi</h1>
        <div class="tablebox">
        
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Jumlah Penjualan</th>
                        <th>Total Keuntungan</th>
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
                                <td><?php echo number_format(mysqli_fetch_array(getSales($rowy['TANGGAL']))['TOTALJUAL']); ?></td>
                                <td><?php echo number_format(mysqli_fetch_array(getProfit($rowy['TANGGAL']))['TOTALLABA']); ?></td>
                            </tr>
                            <?php
                        }
                    
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>