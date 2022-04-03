
<?php
    include "../code/connection.php";
?>
<script>
    // membuka menu detail penjulaan
    document.getElementById('detpurchase').open = true;
</script>
<div class='inputDataBox' style="padding-bottom: 30px;">
    <div class="headerok">
        <h1><a href="summaryMed.php?content=editpurchase" style="font-weight: 500">Cari Data Pembelian</a></h1>
        <?php 
            if(isset($_GET['status'])){
                if($_GET['status'] == 'editpurchasesuccess'){
                    echo "<p class='success'>Update data pembelian berhasil! </p>";
                }
                if($_GET['status'] == 'editpurchasefailed'){
                    echo "<p class='failed'>Data gagal disimpan, periksa kembali data anda!</p>";
                }
                if($_GET['status'] == 'deletesuccess'){
                    echo "<p class='success'>Data pembelian berhasil dihapus! </p>";
                }
                if($_GET['status'] == 'deletefailed'){
                    echo "<p class='failed'>Data pembelian gagal dihapus!</p>";
                }
            }
        ?>
    </div>
    <div class='forminput'id="formcari">
        <form action="../code/handleSearch.php" method="get">
            <div class="col1" style="padding-bottom: 0">
                <div>
                    <label for="namaobatbeli">Pencarian dengan Nama Obat</label>
                    <div style="display: flex; gap: 20px; ">
                        <input name="namaobatbeli" id="namaobatbeli" style="flex: 1; padding: 11px 15px;" list="namaobatjuals" value="<?php echo (empty($_GET['namaobat'])) ? "" : $_GET['namaobat']?>">
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
                        <button type="submit" name="caribelinama" id="btncekobat" style="margin-top: 0; background: var(--blue2); color: white"><i class="fa fa-search"  style="margin-inline-end: 8px;"></i>Cari Data Pembelian</button>
                    </div>
                </div>
            </div>
            <div class="col1" style="padding-bottom: 0">
                <div>
                    <label for="tanggalbeli">Pencarian dengan Tanggal </label>
                    <div style="display: flex; gap: 20px; ">
                        <input name="tanggalbeli" id="tanggalbeli" style="flex: 1" type="date" value="<?php echo (empty($_GET['tanggal'])) ? "" : $_GET['tanggal']?>" >
                        <button type="submit" name="caribelitanggal" id="btncekobat" style="margin-top: 0; background: var(--blue2); color: white"><i class="fa fa-search"  style="margin-inline-end: 8px;"></i>Cari Data Pembelian</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class='forminput' id='updatepurchase'>
        <?php 
            if(isset($_GET['id'])){
                $id=$_GET['id'];
                $query = mysqli_query($connection, "SELECT * FROM t_pembelian WHERE id_trx_beli = '$id'");
                $row = mysqli_fetch_array($query);
                echo "
                <script>document.getElementById('updatepurchase').style.display = 'auto'; </script>
                " ;
            } else {
                echo "
                <script>document.getElementById('updatepurchase').style.display = 'none'</script>
                ";
            }
        ?>
        <form action="../code/handleUpdate.php" method="post">
            <div class="col1">
                <div>
                    <label for="idobat">ID Obat</label>
                    <input type="text" id='idobat' name='idobat' readonly value="<?php echo (empty($id)) ? "" : $id ?>">
                </div>
                <div>
                    <label for="namaobatbeliok">Nama Obat</label>
                    <input type="text" id="namaobatbeliok"  name="namaobatbeliok" readonly value="<?php echo (empty($row['nama_obat_beli'])) ? "" : $row['nama_obat_beli']?>">
                </div>
                <div>
                    <label for="jmlhbeli">Jumlah Pembelian</label>
                    <input type="number" id="jmlhbeli"  name="jmlhbeli" value="<?php echo (empty($row['jumlah_obat_beli'])) ? "" : $row['jumlah_obat_beli']?>">
                </div>
                <div>
                    <label for="hrgbeli">Harga Beli</label>
                    <input type="number" id="hrgbeli"  name="hrgbeli" value="<?php echo (empty($row['harga_obat_beli'])) ? "" : $row['harga_obat_beli']?>">
                </div>
            </div>
            <div class="col1">
                <div>
                    <label for="tglbeli">Tanggal Pembelian</label>
                    <input type="date" id='tgbeli' name='tglbeli' value="<?php echo (empty($row['tanggal_trx_beli'])) ? "" : $row['tanggal_trx_beli']?>">
                </div>
                <div>
                    <label for="idkw">No Kwitansi Pembelian</label>
                    <input type="text" id="idkw"  name="idkw" value="<?php echo (empty($row['no_bukti_beli'])) ? "" : $row['no_bukti_beli']?>">
                </div>
                <div>
                    <label for="totalbeli">Total Pembelian</label>
                    <input type="number" id="totalbeli"  name="totalbeli" readonly value="<?php echo (empty($row['total_pembelian'])) ? "" : $row['total_pembelian']?>">
                </div>
                <button type="submit" name="updatepurchase" ><i class="fa fa-paper-plane"  style="margin-inline-end: 8px;"></i>Update Data Pembelian</button>
            </div>
        </form>
    </div>
    <div class="tabledata" id="listpurchase">
        <?php 
            if(empty($_GET['id'])){
                echo "<script>
                    document.getElementById('listpurchase').style.display = 'auto';
                    document.getElementById('formcari').style.display = 'auto';
                </script>";
                } else {
                    echo "<script>
                    document.getElementById('listpurchase').style.display = 'none';
                    document.getElementById('formcari').style.display = 'none';
                    </script>";
            }
        ?>
        <h1>List Data Pembelian</h1>
        <div style=" overflow: auto; height: 100%">
            <table >
                <thead id='headtablepurchase'>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal Transaksi</th>
                        <th>ID Kwitansi</th>
                        <th>Nama Obat</th>
                        <th>Jumlah</th>
                        <th>Harga Beli</th>
                        <th>Total Pembelian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($_GET['cari'])){
                            if($_GET['cari'] == 'nama'){
                                $namaobatbeli = $_GET['namaobat'];
                                $query = mysqli_query($connection, "SELECT * FROM t_pembelian WHERE nama_obat_beli = '$namaobatbeli' ORDER BY tanggal_trx_beli DESC");
                            } else if ($_GET['cari'] == 'tanggal'){
                                $tanggal = $_GET['tanggal'];
                                $query = mysqli_query($connection, "SELECT * FROM t_pembelian WHERE tanggal_trx_beli = '$tanggal' ORDER BY id_trx_beli DESC");
                            } else if ($_GET['cari'] == 'all'){
                                $query = mysqli_query($connection, "SELECT * FROM t_pembelian ORDER BY id_trx_beli DESC");
                            } 
                        } else {
                            $query = mysqli_query($connection, "SELECT * FROM t_pembelian ORDER BY id_trx_beli DESC");
                        }
                        if(mysqli_num_rows($query) < 1){
                            echo "
                            <div style='display: flex; gap: 20px; align-items: center; justify-content: center' >
                                <img src='../assets/illusbg/nodata.svg' alt='illustrasi' style='width: 380px;'>
                                <h1 style='color: var(--blue2)'>Maaf, data tidak ditemukan!</h1>
                            </div>
                            <script>
                                document.getElementById('headtablepurchase').style.display = 'none';
                            </script>
                            ";
                        } else {
                            echo "
                            <script>
                                document.getElementById('headtablepurchase').style.display = 'auto';
                            </script>
                            ";
                        }
                        $no = 1;
                        while($row = mysqli_fetch_array($query)){
                        ?>
                            <tr index="<?php echo $no ?>">
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $row['tanggal_trx_beli'] ?></td>
                                <td><?php echo $row['no_bukti_beli'] ?></td>
                                <td><?php echo $row['nama_obat_beli'] ?></td>
                                <td><?php echo $row['jumlah_obat_beli'] ?></td>
                                <td><?php echo number_format($row['harga_obat_beli']) ?></td>
                                <td><?php echo number_format($row['total_pembelian']) ?></td>
                                <td style="color: grey"><a title="Edit Data" href="?content=editpurchase&id=<?php echo $row['id_trx_beli']?>" ><i class="fa fa-edit" style="margin-inline-end: 10px"></i></a>  |  <a title="Hapus Data" href="../code/handleDelete.php?id=<?php echo $row['id_trx_beli']?>&act=deletepurchase" onclick="return confirm('Anda yakin ingin menghapus data?')"><i class="fa fa-trash-alt" style="margin-inline-start: 10px"></i></a></td>
                            </tr>
                            
                        <?php
                        }
                    ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- <script>
    document.getElementById("tgljual").focus()
const namaobat = document.getElementById('namaobatjual');
namaobat.addEventListener('keyup',function(e){
    if(e.keyCode === 13){
        e.preventDefault()
        document.getElementById("cekdataobat").click()
        
    }
})
</script> -->
<script>
    const hrgbeli = document.getElementById('hrgbeli');
    hrgbeli.addEventListener('input', function(e){
        const jmlhbeli = document.getElementById('jmlhbeli');
        const totalbeli = document.getElementById('totalbeli');
        totalbeli.value = parseInt(jmlhbeli.value) * parseInt(e.target.value);
    })
    const jmlhbeli = document.getElementById('jmlhbeli');
    jmlhbeli.addEventListener('input', function(e){
        const hrgbeli = document.getElementById('hrgbeli');
        const totalbeli = document.getElementById('totalbeli');
        totalbeli.value = parseInt(hrgbeli.value) * parseInt(e.target.value);
    })
</script>