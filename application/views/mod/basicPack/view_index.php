<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
  Tambah
</button>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data Basic Pack</h3>
  </div>
            <!-- /.card-header -->
  <div class="card-body">
    <table id="datatable-basicpack" class="table table-bordered table-hover" style="width:100%">
      <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Link</th>
        <th>Aksi</th>
      </tr>
      </thead>
      <tbody>
        
      </tbody>
    </table>
  </div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Basic Pack</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <?php echo form_open_multipart('basicpack/simpan');?>
          <div class="card-body">
            <div class="form-group">
              <label for="nama">Nama Basic Pack</label>
              <input type="text" name="nama" class="form-control" required id="nama" placeholder="Masukkan nama basic pack">
            </div>
            <div class="form-group">
              <label for="deskripsi">Deskripsi Basic Pack</label>
              <textarea name="deskripsi" id="deskripsi" cols="30" required rows="10" class="form-control" placeholder="Masukkan deskripsi basic pack"></textarea>
            </div>        
            <div class="form-group">
              <label for="link">Link Youtube</label>
              <input type="text" name="link" class="link form-control" placeholder="Masukkan link youtube">
            </div>
          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit-->
<div class="modal fade" id="modalBasic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <?php echo form_open_multipart('basicpack/edit','class="formEdit"');?>
      <div class="modal-body">
        <input type="hidden" name="id" class="idEdit">
          <div class="card-body">
            <div class="form-group">
              <label for="namaEdit">Nama Basic Pack</label>
              <input type="text" name="namaEdit" class="form-control namaEdit" required id="namaEdit" placeholder="Masukkan nama bsic pack">
            </div>
            <div class="form-group">
              <label for="deskripsiEdit">Deskripsi Basic Pack</label>
              <textarea name="deskripsiEdit" id="deskripsiEdit" cols="30" required rows="10" class="form-control deskripsiEdit" placeholder="Masukkan deskripsi basic pack"></textarea>
            </div>   
            <div class="form-group">
              <label for="link">Link Youtube</label>
              <input type="text" name="linkEdit" class="linkEdit form-control" placeholder="Masukkan link youtube">
            </div>     
          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>