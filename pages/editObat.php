
<?php
    include "../code/connection.php";
?>
<script>
    // membuka menu detail penjulaan
    document.getElementById('detobat').open = true;
</script>
<div class='inputDataBox' style="padding-bottom: 30px;">
    <div class="headerok">
        <h1><a href="summaryMed.php?content=editmedicine" style="font-weight: 500">Cari Data Obat</a></h1>
        <?php 
            if(isset($_GET['status'])){
                if($_GET['status'] == 'editobatsuccess'){
                    echo "<p class='success'>Update data obat berhasil! </p>";
                }
                if($_GET['status'] == 'editobatfailed'){
                    echo "<p class='failed'>Data gagal disimpan, periksa kembali data anda!</p>";
                }
                if($_GET['status'] == 'deleteobatsuccess'){
                    echo "<p class='success'>Data obat berhasil dihapus! </p>";
                }
                if($_GET['status'] == 'deleteobatfailed'){
                    echo "<p class='failed'>Data obat gagal dihapus!</p>";
                }
            }
        ?>
    </div>
    <div class='forminput' >
        <form action="../code/handleSearch.php" method="get">
            <div class="col1" style="padding-bottom: 0">
                <div>
                    <label for="namaobat">Pencarian dengan Nama Obat</label>
                    <div style="display: flex; gap: 20px; ">
                        <input name="namaobat" id="namaobat" style="flex: 1; padding: 11px 15px;" list="namaobatjuals" value="<?php echo (empty($_GET['nama'])) ? "" : $_GET['nama']?>">
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
                        <button type="submit" name="cariobatnama" id="btncekobat" style="margin-top: 0; background: var(--blue2); color: white"><i class="fa fa-search"  style="margin-inline-end: 8px;"></i>Cari Data Obat</button>
                    </div>
                </div>
            </div>
            <div class="col1" style="padding-bottom: 0">
                <div>
                    <label for="kategoriobat">Pencarian dengan Kategori</label>
                    <div style="display: flex; gap: 20px; ">
                        <select name="jenis" id="jenis" required>
                            <option value="obat keras">Obat Keras</option>
                            <option value="obat bebas">Obat Bebas</option>
                            <option value="obat bebas terbatas">Obat Bebas Terbatas</option>
                            <option value="jamu/herbal">Jamu/Herbal</option>
                        </select>
                        <button type="submit" name="cariobatjenis" id="btncekobat" style="margin-top: 0; background: var(--blue2); color: white"><i class="fa fa-search"  style="margin-inline-end: 8px;"></i>Cari Data Obat</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="tabledata" style="margin-top: 10px">
        <h1>List Data Obat </h1>
        <div style=" overflow: auto; height: 100%">
            <table >
                <thead id='headtablepurchase'>
                    <tr>
                        <th>No.</th>
                        <th>ID Obat</th>
                        <th>Nama Obat</th>
                        <th>Satuan</th>
                        <th>Jenis Obat</th>
                        <th style="width: 200px">Supplier</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Expired</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($_GET['cari'])){
                            if($_GET['cari'] == 'nama'){
                                $namaobat = $_GET['nama'];
                                $query = mysqli_query($connection, "SELECT * FROM t_obat WHERE nama_obat = '$namaobat' ORDER BY id_obat DESC LIMIT 50");
                            } else if ($_GET['cari'] == 'kategori'){
                                $kategori = $_GET['kategori'];
                                $query = mysqli_query($connection, "SELECT * FROM t_obat WHERE jenis_obat = '$kategori' ORDER BY id_obat DESC LIMIT 50");
                            } else if ($_GET['cari'] == 'all'){
                                $query = mysqli_query($connection, "SELECT * FROM t_obat ORDER BY id_obat DESC LIMIT 50");
                            } 
                        } else {
                            $query = mysqli_query($connection, "SELECT * FROM t_obat ORDER BY id_obat DESC LIMIT 50");
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
                                <td><?php echo $row['id_obat'] ?></td>
                                <td><?php echo $row['nama_obat'] ?></td>
                                <td><?php echo $row['satuan'] ?></td>
                                <td><?php echo $row['jenis_obat'] ?></td>
                                <td><?php echo $row['supplier_obat'] ?></td>
                                <td><?php echo number_format($row['harga_beli_obat']) ?></td>
                                <td><?php echo number_format($row['harga_jual_obat']) ?></td>
                                <td><?php echo $row['expired_date'] ?></td>
                                <td style="color: grey"><a title="Edit Data" href="#" ><i class="fa fa-edit" style="margin-inline-end: 10px"></i></a>  |  <a title="Hapus Data" href="../code/handleDelete.php?id=<?php echo $row['id_obat']?>&act=deletepurchase" onclick="return confirm('Anda yakin ingin menghapus data?')"><i class="fa fa-trash-alt" style="margin-inline-start: 10px"></i></a></td>
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