
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
                            <option value="Obat Keras">Obat Keras</option>
                            <option value="Obat Bebas">Obat Bebas</option>
                            <option value="Obat Bebas Terbatas">Obat Bebas Terbatas</option>
                            <option value="Jamu/Herbal">Jamu/Herbal</option>
                        </select>
                        <button type="submit" name="cariobatjenis" id="btncekobat" style="margin-top: 0; background: var(--blue2); color: white"><i class="fa fa-search"  style="margin-inline-end: 8px;"></i>Cari Data Obat</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class='forminput' id="updateobat">
        <?php 
            if(isset($_GET['id'])){
            $id = $_GET['id'];
            $query = mysqli_query($connection, "SELECT * FROM t_obat WHERE id_obat = '$id'");
            $row = mysqli_fetch_array($query);
            echo "<script>
            document.getElementById('updateobat').style.display = 'auto';
            </script>";
            } else {
                echo "<script>
                document.getElementById('updateobat').style.display = 'none';
                </script>";
            }
            // $date = date('d/m/Y', strtotime($row['expired_date']));
        ?>
        <form action="../code/handleUpdate.php" method="post">
            <div class="col1">
                <div>
                    <label for="idobat">ID Obat</label>
                    <input type="text" id="idobat" required name="idobat" readonly value="<?php echo $row['id_obat']; ?>">
                </div>
                <div>
                    <label for="namaobat">Nama Obat</label>
                    <input type="text" id="namaobat" required name="namaobat" value="<?php echo $row['nama_obat']; ?>">
                </div>
                <div>
                    <label for="satuan">Satuan</label>
                    <select name="satuan" id="satuan" required>
                        <option value="Ampul" <?php echo ($row['satuan'] == 'Ampul') ? 'selected' : '';?>>Ampul</option>
                        <option value="Botol" <?php echo ($row['satuan'] == 'Botol') ? 'selected' : '';?>>Botol</option>
                        <option value="Box" <?php echo ($row['satuan'] == 'Box') ? 'selected' : '';?>>Box</option>
                        <option value="Capsul" <?php echo ($row['satuan'] == 'Capsul') ? 'selected' : '';?>>Capsul</option>
                        <option value="Pcs" <?php echo ($row['satuan'] == 'Pcs') ? 'selected' : '';?>>Pcs</option>
                        <option value="Strip" <?php echo ($row['satuan'] == 'Strip') ? 'selected' : '';?>>Strip</option>
                        <option value="Tubes" <?php echo ($row['satuan'] == 'Tubes') ? 'selected' : '';?>>Tubes</option>
                    </select>
                </div>
                <div>
                    <label for="jenis">Jenis</label>
                    <select name="jenis" id="jenis" required>
                        <option value="Obat Keras" <?php echo ($row['jenis_obat'] == 'Obat Keras') ? 'selected' : '';?>>Obat Keras</option>
                        <option value="Obat Bebas" <?php echo ($row['jenis_obat'] == 'Obat Bebas') ? 'selected' : '';?>>Obat Bebas</option>
                        <option value="Obat Bebas Terbatas" <?php echo ($row['jenis_obat'] == 'Obat Bebas Terbatas') ? 'selected' : '';?>>Obat Bebas Terbatas</option>
                        <option value="Jamu/Herbal" <?php echo ($row['jenis_obat'] == 'Jamu/Herbal') ? 'selected' : '';?>>Jamu/Herbal</option>
                    </select>
                </div>
            </div>
            <div class="col1">
                <div>
                    <label for="supplier">Supplier</label>
                    <input type="text" id="supplier" required name="supplier" value="<?php echo $row['supplier_obat']?>">
                </div>
                <div>
                    <label for="hargabeli">Harga Beli</label>
                    <input type="number" id="hargabeli" required name="hargabeli" value="<?php echo $row['harga_beli_obat']?>">
                </div>
                <div>
                    <label for="hargajual">Harga Jual</label>
                    <input type="number" id="hargajual" required name="hargajual" value="<?php echo $row['harga_jual_obat']?>">
                </div>
                <div>
                    <label for="expirydate">Expired Date</label>
                    <input type="date" id="expirydate" required name="expirydate" value="<?php echo $row['expired_date'] ?>">
                </div>
                <button type="submit" name="updateobat"><i class="fa fa-paper-plane"  style="margin-inline-end: 8px"></i>Update Data Obat</button>
            </div>
        </form>
    </div>
    <div class="tabledata" style="margin-top: 10px" id="listdataobat">
        <?php 
            if(empty($_GET['id'])){
            "<script>
            document.getElementById('listdataobat').style.display='auto';
            </script>";
            } else {
                echo "<script>
                document.getElementById('listdataobat').style.display = 'none';
                </script>";
            }
            // $date = date('d/m/Y', strtotime($row['expired_date']));
        ?>
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
                                <td style="color: grey"><a title="Edit Data" onclick="shideupdate()" href="?content=editmedicine&id=<?php echo $row['id_obat']?>" ><i class="fa fa-edit" style="margin-inline-end: 10px"></i></a>  |  <a title="Hapus Data" href="../code/handleDelete.php?id=<?php echo $row['id_obat']?>&act=deletepurchase" onclick="return confirm('Anda yakin ingin menghapus data?')"><i class="fa fa-trash-alt" style="margin-inline-start: 10px"></i></a></td>
                            </tr>
                            
                        <?php
                        }
                    ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
<div>

</div>

<script>
    function shideupdate(){
        const list = document.getElementById('listdataobat');
        const update = document.getElementById('updateobat');
        update.style.display ='auto';
    }
</script>