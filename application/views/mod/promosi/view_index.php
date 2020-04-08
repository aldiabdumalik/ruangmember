<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#promosi">
  Tambah
</button>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data Promosi</h3>
  </div>
            <!-- /.card-header -->
  <div class="card-body">
    <table id="datatable-promosi" class="table table-bordered table-hover" style="width:100%">
      <thead>
      <tr>
        <th>No</th>
        <th>Nama Promosi</th>
        <th>Foto Promosi</th>
        <th>Aksi</th>
      </tr>
      </thead>
      <tbody>
        
      </tbody>
    </table>
  </div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="promosi" tabindex="-1" role="dialog" aria-labelledby="labelpromosi" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelpromosi">Tambah Promosi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <?php echo form_open_multipart('promosi/simpan');?>
          <div class="card-body">
            <div class="form-group">
              <label for="nama">Nama Promosi</label>
              <input type="text" name="nama" class="form-control" required id="nama" placeholder="Masukkan nama promosi">
            </div>        
            <div class="form-group">
              <label for="foto">Foto</label>
              <input type="file" name="foto" class="foto" data-height="200">
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
<div class="modal fade" id="modalPromosi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Promosi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <?php echo form_open_multipart('promosi/edit',array('id' => 'formEdit'));?>
          <input type="hidden" name="idEdit" class="idEdit" value="">
          <div class="card-body">
            <div class="form-group">
              <label for="namaEdit">Nama Promosi</label>
              <input type="text" name="namaEdit" class="form-control namaEdit" required id="namaEdit" placeholder="Masukkan nama promosi">
            </div>        
            <div class="form-group">
              <label for="fotoEdit">Foto</label>
              <input type="file" name="fotoEdit" id="fotoEdit" class="fotoEdit" data-height="200">
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