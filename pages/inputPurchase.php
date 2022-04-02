
<?php
    include "../code/connection.php";
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
    document.getElementById('detpurchase').open = true;
</script>
<div class='inputDataBox' style="padding-bottom: 30px;">
    <div class="headerok">
        <h1><a href="summaryMed.php?content=addpurchase" style="font-weight: 500">Tambah Data Pembelian</a></h1>
        <?php 
            if(isset($_GET['status'])){
                if($_GET['status'] == 'addpurchasesuccess'){
                    echo "<p class='success'>Simpan Data Berhasil</p>";
                } else if($_GET['status'] == 'addpurchasefailed'){
                    echo "<p class='failed'>Data gagal disimpan, periksa kembali data anda!</p>";
                }
            }
        ?>
    </div>
    <div class='forminput' >
        <form action="../code/handleSubmit.php" method="post">
            <div class="col1">
                <div>
                    <label for="namaobatbeli">Nama Obat</label>
                    <div style="display: flex; gap: 20px; ">
                        <input name="namaobatbeli" id="namaobatbeli" style="flex: 1" list="namaobatjuals" required value="<?php echo (empty($namaobat1)) ? "" : $namaobat1?>">
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
                    </div>

                </div>
                <div>
                    <label for="jmlhbeli">Jumlah Pembelian </label>
                    <input type="number" id="jmlhbeli" required name="jmlhbeli">
                </div>
                <div>
                    <label for="hrgbeli">Harga Beli</label>
                    <input type="number" id="hrgbeli"  required name="hrgbeli" >
                </div>
                
            </div>
            <div class="col1">
                
                <div>
                    <label for="tglbeli">Tanggal Pembelian</label>
                    <input type="date" id="tglbeli" required name="tglbeli">
                </div>   
                <div>
                    <label for="idkw">No Kwitansi Pembelian</label>
                    <input type="text" id="idkw" name="idkw">
                </div>
                <div>
                    <label for="totalbeli">Total Pembelian</label>
                    <input type="number" id="totalbeli" required name="totalbeli" >
                </div>
                <button type="submit" name="simpanpurchase" ><i class="fa fa-paper-plane"  style="margin-inline-end: 8px;"></i>Simpan Data Pembelian</button>
            </div>
        </form>
    </div>
    <div class="tabledata" style="margin-top: -30px">
        <h1>List Data Pembelian</h1>
        <div style=" overflow: auto; height: 300px;">
            <table >
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal Transaksi</th>
                        <th>ID Kwitansi</th>
                        <th>Nama Obat</th>
                        <th>Jumlah</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $date = date('Y-m-d');
                        $query = mysqli_query($connection, "SELECT * FROM t_pembelian WHERE tanggal_trx_beli = '$date' ORDER BY id_trx_beli DESC");
                        $no = 1;
                        while($row = mysqli_fetch_array($query)){
                            ?>
                                <tr index="<?php echo $no ?>">
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $row['tanggal_trx_beli'] ?></td>
                                    <td><?php echo $row['id_trx_beli'] ?></td>
                                    <td><?php echo $row['nama_obat_beli'] ?></td>
                                    <td><?php echo $row['jumlah_obat_beli'] ?></td>
                                    <td><?php echo number_format($row['harga_obat_beli']) ?></td>
                                    <td><?php echo number_format($row['total_pembelian']) ?></td>
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
    document.getElementById("namaobatbeli").focus();
    const hrgbeli = document.getElementById('hrgbeli');
    hrgbeli.addEventListener('input', function(e){
        const jmlhbeli = document.getElementById('jmlhbeli');
        const totalbeli = document.getElementById('totalbeli');
        totalbeli.value = parseInt(jmlhbeli.value) * parseInt(e.target.value);
    })
    totalbeli
</script>