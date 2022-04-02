
<?php
    include "../code/connection.php";
    include "../code/function.php";
    if(isset($_POST['cekdataobat'])){
        $namaobat = $_POST['namaobatjual'];
        $search = mysqli_query($connection, "SELECT * FROM t_obat WHERE nama_obat = '$namaobat'");
        $row = mysqli_fetch_array($search);
        $namaobat1 = $row['nama_obat'];
        $hbeli = $row['harga_beli_obat'];
        $hjual = $row['harga_jual_obat'];
    }
?>
<script>
    // membuka menu detail penjulaan
    document.getElementById('detpenjualan').open = true;
</script>
<div class='inputDataBox' style="padding-bottom: 30px;">
    <div class="headerok">
        <h1><a href="summaryMed.php?content=addsales" style="font-weight: 500">Tambah Data Penjualan</a></h1>
        <?php 
            if(isset($_GET['status'])){
                if($_GET['status'] == 'addsalessuccess'){
                    echo "<p class='success'>Simpan Data Berhasil</p>";
                } else if($_GET['status'] == 'addsalesfailed'){
                    echo "<p class='failed'>Data gagal disimpan, periksa kembali data anda!</p>";
                }
            }
        ?>
    </div>
    <div class='forminput' >
        <form action="#" method="post">
            <div class="col1" style="padding-bottom: 0">
                <div>
                    <label for="namaobatjual">Nama Obat</label>
                    <div style="display: flex; gap: 20px; ">
                        <input name="namaobatjual" id="namaobatjual" style="flex: 1" list="namaobatjuals" required value="<?php echo (empty($namaobat1)) ? "" : $namaobat1?>">
                        <datalist id="namaobatjuals">
                            <?php 
                                $query = mysqli_query($connection, "SELECT DISTINCT(nama_obat) FROM t_obat");
                                while($row = mysqli_fetch_array($query)){
                                    ?>
                                        <option value="<?php echo $row['nama_obat']?>"></option>            
                                    <?php
                                }
                            ?>
                        </datalist>
                        <button type="submit" name="cekdataobat" id="btncekobat" style="margin-top: 0; background: var(--blue2); color: white"><i class="fa fa-paper-plane"  style="margin-inline-end: 8px;"></i>Cek Data Obat</button>
                    </div>
                </div>
            </div>
        </form>
        <form action="../code/handleSubmit.php" method="post">
            <div class="col1" style="margin-top: 1px">
                <div>
                    <label for="namaobatjualok">Nama Obat</label>
                    <input type="text" id="namaobatjualok"  name="namaobatjualok" readonly value="<?php echo (empty($namaobat1)) ? "" : $namaobat1?>">
                </div>
                <div>
                    <label for="hrgjual">Harga Jual</label>
                    <input type="number" id="hrgjual"  readonly name="hrgjual" value="<?php echo $hjual ?>">
                </div>
                <div>
                    <label for="hrgmodal">Harga Modal</label>
                    <input type="number" id="hrgmodal" readonly name="hrgmodal" value="<?php echo $hbeli ?>">
                </div>
                
            </div>
            <div class="col1">
                <div>
                    <label for="tgljual">Tanggal Penjualan</label>
                    <input type="date" id="tgljual" required name="tgljual">
                </div>
                <div>
                    <label for="idkw">No Kwitansi Penjualan</label>
                    <input type="text" id="idkw" name="idkw">
                </div>
                <div>
                    <label for="jmlhjual">Jumlah | Stok </label>
                    <input type="number" id="jmlhjual" required name="jmlhjual">
                </div>
                <button type="submit" name="simpansales"><i class="fa fa-paper-plane"  style="margin-inline-end: 8px"></i>Simpan Data Penjualan</button>
            </div>
        </form>
    </div>
    <div class="tabledata" style="margin-top: -30px">
        <h1>List Data Penjualan</h1>
        <div style=" overflow: auto; height: 300px;">
            <table >
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal Transaksi</th>
                        <th>ID Kwitansi</th>
                        <th>Nama Obat</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Keuntungan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $date = date('Y-m-d');
                        $query = mysqli_query($connection, "SELECT * FROM t_penjualan WHERE tanggal_trx_jual = '$date' ORDER BY id_trx_jual DESC");
                        $no = 1;
                        while($row = mysqli_fetch_array($query)){
                            ?>
                                <tr index="<?php echo $no ?>">
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $row['tanggal_trx_jual'] ?></td>
                                    <td><?php echo $row['id_trx_jual'] ?></td>
                                    <td><?php echo $row['nama_obat_jual'] ?></td>
                                    <td><?php echo $row['jumlah_obat_jual'] ?></td>
                                    <td><?php echo mysqli_fetch_array(getSatuan($row['nama_obat_jual']))['SATUAN'] ?>
                                    <td><?php echo number_format($row['harga_modal']) ?></td>
                                    <td><?php echo number_format($row['harga_total_jual']) ?></td>
                                    <td><?php echo number_format($row['laba_jual']) ?></td>
                                </tr>
                                
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php 
    
?>


<script>
    document.getElementById("tgljual").focus()
const namaobat = document.getElementById('namaobatjual');
namaobat.addEventListener('keyup',function(e){
    if(e.keyCode === 13){
        e.preventDefault()
        document.getElementById("cekdataobat").click()
        
    }
})
</script>