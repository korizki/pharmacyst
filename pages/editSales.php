
<?php
    include "../code/connection.php";
    include "../code/function.php";
?>
<script>
    // membuka menu detail penjulaan
    document.getElementById('detpenjualan').open = true;
</script>
<div class='inputDataBox' style="padding-bottom: 30px;">
    <div class="headerok">
        <h1><a href="summaryMed.php?content=editsales" style="font-weight: 500">Cari Data Penjualan</a></h1>
        <?php 
            if(isset($_GET['status'])){
                if($_GET['status'] == 'editsalessuccess'){
                    echo "<p class='success'>Update data penjualan berhasil! </p>";
                }
                if($_GET['status'] == 'editsalesfailed'){
                    echo "<p class='failed'>Data gagal disimpan, periksa kembali data anda!</p>";
                }
                if($_GET['status'] == 'deletesuccess'){
                    echo "<p class='success'>Data penjualan berhasil dihapus! </p>";
                }
                if($_GET['status'] == 'deletefailed'){
                    echo "<p class='failed'>Data penjualan gagal dihapus !</p>";
                }
            }
        ?>
    </div>
    <div class='forminput' >
        <form action="../code/handleSearch.php" method="get">
            <div class="col1" style="padding-bottom: 0">
                <div>
                    <label for="namaobatjual">Pencarian dengan Nama Obat</label>
                    <div style="display: flex; gap: 20px; ">
                        <input name="namaobatjual" id="namaobatjual" style="flex: 1; padding: 11px 15px;" list="namaobatjuals" value="<?php echo (empty($_GET['namaobat'])) ? "" : $_GET['namaobat']?>">
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
                        <button type="submit" name="caridengannama" id="btncekobat" style="margin-top: 0; background: var(--blue2); color: white"><i class="fa fa-search"  style="margin-inline-end: 8px;"></i>Cari Data Sales</button>
                    </div>
                </div>
            </div>
            <div class="col1" style="padding-bottom: 0">
                <div>
                    <label for="tanggalsales">Pencarian dengan Tanggal </label>
                    <div style="display: flex; gap: 20px; ">
                        <input name="tanggalsales" id="tanggalsales" style="flex: 1" type="date" value="<?php echo (empty($_GET['tanggal'])) ? "" : $_GET['tanggal']?>" >
                        <button type="submit" name="caridengantanggal" id="btncekobat" style="margin-top: 0; background: var(--blue2); color: white"><i class="fa fa-search"  style="margin-inline-end: 8px;"></i>Cari Data Sales</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class='forminput' id="updatesales">
        <?php 
            if(isset($_GET['id'])){
            $id = $_GET['id'];
            $query = mysqli_query($connection, "SELECT * FROM t_penjualan WHERE id_trx_jual = '$id'");
            $row = mysqli_fetch_array($query);
            echo "<script>
                document.getElementById('updatesales').style.display = 'auto';
                </script>";
            } else {
                echo "<script>
                document.getElementById('updatesales').style.display = 'none';
                </script>";
            }
            // $date = date('d/m/Y', strtotime($row['expired_date']));
        ?>
        <form action="../code/handleUpdate.php" method="post">
            <div class="col1">
                <div>
                    <label for="idobat">ID Obat</label>
                    <input type="text" id="idobat"  name="idobat" readonly value="<?php echo (empty($id)) ? "" : $id?>">
                </div>
                <div>
                    <label for="namaobatjualok">Nama Obat</label>
                    <input type="text" id="namaobatjualok"  name="namaobatjualok" readonly value="<?php echo (empty($row['nama_obat_jual'])) ? "" : $row['nama_obat_jual']?>">
                </div>
                <div>
                    <label for="hrgjual">Harga Jual</label>
                    <input type="number" id="hrgjual"  readonly name="hrgjual" value="<?php echo $row['harga_obat_jual'] ?>">
                </div>
                <div>
                    <label for="hrgmodal">Harga Modal</label>
                    <input type="number" id="hrgmodal" readonly name="hrgmodal" value="<?php echo $row['harga_modal'] ?>">
                </div>
            </div>
            <div class="col1" style="margin-top: -2px">
                <div>
                    <label for="tgljual">Tanggal Penjualan</label>
                    <input type="date" id="tgljual" required name="tgljual" value="<?php echo $row['tanggal_trx_jual'] ?>">
                </div>
                <div>
                    <label for="idkw">No Kwitansi Penjualan</label>
                    <input type="text" id="idkw" name="idkw" value="<?php echo $row['no_bukti_jual'] ?>">
                </div>
                <div>
                    <label for="jmlhjual">Jumlah | Stok </label>
                    <input type="number" id="jmlhjual" required name="jmlhjual" value="<?php echo $row['jumlah_obat_jual'] ?>">
                </div>
                <button type="submit" name="updatesales"><i class="fa fa-paper-plane"  style="margin-inline-end: 8px"></i>Update Data Penjualan</button>
            </div>
        </form>
    </div>
    <div class="tabledata" id="listsales">
        <?php 
            if(empty($_GET['id'])){
                echo "<script>
                    document.getElementById('listsales').style.display = 'auto';
                </script>";
                } else {
                    echo "<script>
                    document.getElementById('listsales').style.display = 'none';
                    </script>";
            }
        ?>
        <h1>List Data Penjualan</h1>
        <div style=" overflow: auto; height: 100%">
            <table >
                <thead id='headtable'>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal Transaksi</th>
                        <th>ID Kwitansi</th>
                        <th>Nama Obat</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        <th>Harga Beli Per Item</th>
                        <th>Total Penjualan</th>
                        <th>Keuntungan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($_GET['cari'])){
                            if($_GET['cari'] == 'nama'){
                                $namaobatjual = $_GET['namaobat'];
                                $query = mysqli_query($connection, "SELECT * FROM t_penjualan WHERE nama_obat_jual = '$namaobatjual' ORDER BY tanggal_trx_jual DESC");
                            } else if ($_GET['cari'] == 'tanggal'){
                                $tanggal = $_GET['tanggal'];
                                $query = mysqli_query($connection, "SELECT * FROM t_penjualan WHERE tanggal_trx_jual = '$tanggal' ORDER BY id_trx_jual DESC");
                            } else if ($_GET['cari'] == 'all'){
                                $query = mysqli_query($connection, "SELECT * FROM t_penjualan ORDER BY id_trx_jual DESC");
                            } 
                        } else {
                            $query = mysqli_query($connection, "SELECT * FROM t_penjualan ORDER BY id_trx_jual DESC");
                        }
                        if(mysqli_num_rows($query) < 1){
                            echo "
                            <div style='display: flex; gap: 20px; align-items: center; justify-content: center' >
                                <img src='../assets/illusbg/nodata.svg' alt='illustrasi' style='width: 380px;'>
                                <h1 style='color: var(--blue2)'>Maaf, data tidak ditemukan!</h1>
                            </div>
                            <script>
                                document.getElementById('headtable').style.display = 'none';
                            </script>
                            ";
                        } else {
                            echo "
                            <script>
                                document.getElementById('headtable').style.display = 'auto';
                            </script>
                            ";
                        }
                        $no = 1;
                        while($row = mysqli_fetch_array($query)){
                        ?>
                            <tr index="<?php echo $no ?>">
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $row['tanggal_trx_jual'] ?></td>
                                <td><?php echo $row['no_bukti_jual'] ?></td>
                                <td><?php echo $row['nama_obat_jual'] ?></td>
                                <td><?php echo $row['jumlah_obat_jual'] ?></td>
                                <td><?php echo mysqli_fetch_array(getSatuan($row['nama_obat_jual']))['SATUAN'] ?>
                                <td><?php echo number_format($row['harga_modal']) ?></td>
                                <td><?php echo number_format($row['harga_total_jual']) ?></td>
                                <td><?php echo number_format($row['laba_jual']) ?></td>
                                <td style="color: grey"><a title="Edit Data" href="?content=editsales&id=<?php echo $row['id_trx_jual'] ?>" ><i class="fa fa-edit" style="margin-inline-end: 10px"></i></a>  |  <a title="Hapus Data" href="../code/handleDelete.php?id=<?php echo $row['id_trx_jual']?>&act=deletesales" onclick="return confirm('Anda yakin ingin menghapus data?')"><i class="fa fa-trash-alt" style="margin-inline-start: 10px"></i></a></td>
                            </tr>
                            
                        <?php
                        }
                    ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

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