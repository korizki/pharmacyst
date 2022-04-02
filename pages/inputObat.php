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
                        <option value="Ampul">Ampul</option>
                        <option value="Botol">Botol</option>
                        <option value="Box">Box</option>
                        <option value="Capsul">Capsul</option>
                        <option value="Pcs">Pcs</option>
                        <option value="Strip">Strip</option>
                        <option value="Tubes">Tubes</option>
                    </select>
                </div>
                <div>
                    <label for="jenis">Jenis</label>
                    <select name="jenis" id="jenis" required>
                        <option value="Obat Keras">Obat Keras</option>
                        <option value="Obat Bebas">Obat Bebas</option>
                        <option value="Obat Bebas Terbatas">Obat Bebas Terbatas</option>
                        <option value="Jamu/Herbal">Jamu/Herbal</option>
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