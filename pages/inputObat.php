<script>
    // membuka menu detail penjulaan
    document.getElementById('detobat').open = true;
</script>
<div class='inputDataBox'>
    <div class="headerok">
        <h1><a href="summaryMed.php?content=addmedicine" style="font-weight: 500">Tambah Data Obat</a></h1>
        <?php 
            if(isset($_GET['status'])){
                if($_GET['status'] == 'inputmedsuccess'){
                    echo "<p class='success'>Simpan Data Berhasil</p>";
                } else if($_GET['status'] == 'inputmedfailed'){
                    echo "<p class='failed'>Data gagal disimpan, periksa kembali data anda!</p>";
                }
            }
        ?>
        
    </div>
    <div class='forminput'>
        <form action="../code/handleSubmit.php" method="post">
            <div class="col1">
                <div>
                    <label for="idobat">ID Obat</label>
                    <input type="text" id="idobat" required name="idobat">
                </div>
                <div>
                    <label for="namaobat">Nama Obat</label>
                    <input type="text" id="namaobat" required name="namaobat">
                </div>
                <div>
                    <label for="satuan">Satuan</label>
                    <select name="satuan" id="satuan" required>
                        <option value="ampul">Ampul</option>
                        <option value="botol">Botol</option>
                        <option value="box">Box</option>
                        <option value="capsul">Capsul</option>
                        <option value="pcs">Pcs</option>
                        <option value="strip">Strip</option>
                        <option value="tubes">Tubes</option>
                    </select>
                </div>
                <div>
                    <label for="jenis">Jenis</label>
                    <select name="jenis" id="jenis" required>
                        <option value="obat keras">Obat Keras</option>
                        <option value="obat bebas">Obat Bebas</option>
                        <option value="obat bebas terbatas">Obat Bebas Terbatas</option>
                        <option value="jamu/herbal">Jamu/Herbal</option>
                    </select>
                </div>
            </div>
            <div class="col1">
                <div>
                    <label for="supplier">Supplier</label>
                    <input type="text" id="supplier" required name="supplier">
                </div>
                <div>
                    <label for="hargabeli">Harga Beli</label>
                    <input type="number" id="hargabeli" required name="hargabeli">
                </div>
                <div>
                    <label for="hargajual">Harga Jual</label>
                    <input type="number" id="hargajual" required name="hargajual">
                </div>
                <div>
                    <label for="expirydate">Expired Date</label>
                    <input type="date" id="expirydate" required name="expirydate">
                </div>
                <button type="submit" name="tambahobat"><i class="fa fa-paper-plane"  style="margin-inline-end: 8px"></i>Submit Data</button>
            </div>
        </form>
    </div>
</div>