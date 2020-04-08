<div class="card">
  <div class="card-body">
    <?php echo form_open_multipart('produk/edit');?>
      <input type="hidden" name="idEdit" class="idEdit" value="<?= $produk->idProduk ?>">
      <div class="card-body">
        <div class="form-group">
          <label for="Image">Image</label>
          <input type="file" name="imageEdit" class="dropifyEdit" data-height="150" data-default-file="<?= base_url('assets/img/produk/'.$produk->fotoProduk) ?>">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Nama Produk</label>
          <input type="text" name="namaEdit" class="form-control namaEdit" required value="<?= $produk->namaProduk ?>" placeholder="Masukkan nama produk">
        </div>
        <div class="form-group">
          <label for="deskripsiEdit2">Deskripsi Produk</label>
          <textarea name="deskripsiEdit" id="deskripsi" cols="30" required rows="10" class="form-control deskripsiEdit" placeholder="Masukkan deskripsi produk"><?= $produk->deskripsiProduk ?></textarea>
        </div>
        <div class="form-group">
          <label for="hargaProduk">Harga Produk</label>
          <input type="number" name="hargaEdit" class="form-control hargaEdit" required value="<?= $produk->hargaProduk ?>" placeholder="Masukkan harga produk">
        </div>
        <div class="form-group">
          <label for="stokProduk">Stok Produk</label>
          <input type="number" name="stokEdit" class="form-control stokEdit" required value="<?= $produk->stokProduk ?>" placeholder="Masukkan stok produk">
        </div>
      <button type="submit" class="btn btn-primary">Update</button>
      <a href="<?= base_url('produk') ?>" class="btn btn-danger">Kembali</a>
    </form>
  </div>
</div>