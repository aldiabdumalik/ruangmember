<div class="card">
  <div class="card-body">
    <?php echo form_open_multipart('produk/simpan');?>
      <div class="form-group">
        <label for="kategori">Kategori</label>
        <select name="kategori" id="kategori" class="form-control" required>
          <option value="">Pilih kategori</option>
          <option value="retail">Retail</option>
          <option value="reguler">Paket Reguler</option>
          <option value="ft">Paket Fast Track</option>
        </select>
      </div>
      <div class="paket collapse">
        <label>Detail Paket</label>
        <div class="form-group">
          <label for="paket_produk">Produk dalam paket</label>
          <select multiple="multiple" id="paket_produk" name="paket_produk[]">
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="Image">Image Produk / Paket</label>
        <input type="file" name="image" class="dropify" data-height="150">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Nama Produk / Paket</label>
        <input type="text" name="nama" class="form-control" required id="exampleInputEmail1" placeholder="Masukkan nama produk">
      </div>
      <div class="form-group">
        <label for="deskripsi">Deskripsi Produk / Paket</label>
        <textarea name="deskripsi" id="deskripsi" cols="30" required rows="10" class="form-control" placeholder="Masukkan deskripsi produk"></textarea>
      </div>
      <div class="form-group">
        <label for="hargaProduk">Harga Produk / Paket</label>
        <input type="number" name="harga" class="form-control" id="hargaProduk" required placeholder="Masukkan harga produk">
      </div>
      <div class="form-group">
        <label for="stokProduk">Stok Produk / Paket</label>
        <input type="number" name="stok" class="form-control" id="stokProduk" required placeholder="Masukkan stok produk">
      </div>
      <button type="submit" class="btn btn-primary">Simpan</button>
      <a href="<?= base_url('produk') ?>" class="btn btn-danger">Kembali</a>
    </form>
  </div>
</div>