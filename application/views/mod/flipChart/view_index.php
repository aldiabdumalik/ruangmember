<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
  Tambah
</button>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data Flip Chart</h3>
  </div>
            <!-- /.card-header -->
  <div class="card-body">
    <table id="datatable-flipchart" class="table table-bordered table-hover" style="width:100%">
      <thead>
      <tr>
        <th>No</th>
        <th>Foto Flip Chart</th>
        <th>Nama Flip Chart</th>
        <th>Aksi</th>
      </tr>
      </thead>
      <tbody>
        
      </tbody>
    </table>
  </div>
<!-- /.card-body -->
</div>

<!-- Modal Edit-->
<div class="modal fade" id="modalFlip" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Flip Chart</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <?php echo form_open_multipart('flipchart/edit',array('id' => 'formEdit'));?>
          <input type="hidden" name="idEdit" class="idEdit" value="">
          <div class="card-body">
            <div class="form-group">
              <label for="fotoEdit">Foto</label>
              <input type="file" name="foto" class="fotoEdit" data-height="150">
            </div>
            <div class="form-group">
              <label for="namaEdit">Nama Flip Chart</label>
              <input type="text" value="" name="nama" class="form-control" required id="namaEdit" placeholder="Masukkan nama flip chart">
            </div>
            <div class="form-group">
              <label for="deskripsiEdit">Deskripsi Flip Chart</label>
              <textarea value="" name="deskripsi" id="deskripsiEdit" cols="30" required rows="10" class="form-control" placeholder="Masukkan deskripsi flip chart"></textarea>
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


<!-- Modal Add -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Flip Chart</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <?php echo form_open_multipart('flipchart/simpan');?>
          <div class="card-body">
            <div class="form-group">
              <label for="foto">Foto</label>
              <input type="file" name="foto" class="foto" data-height="150">
            </div>
            <div class="form-group">
              <label for="nama">Nama Flip Chart</label>
              <input type="text" name="nama" class="form-control" required id="nama" placeholder="Masukkan nama flip chart">
            </div>
            <div class="form-group">
              <label for="deskripsi">Deskripsi Flip Chart</label>
              <textarea name="deskripsi" id="deskripsi" cols="30" required rows="10" class="form-control" placeholder="Masukkan deskripsi flip chart"></textarea>
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