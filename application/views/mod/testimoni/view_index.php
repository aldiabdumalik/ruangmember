<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
  Tambah
</button>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data Testimoni</h3>
  </div>
  <div class="card-body">
    <table id="datatable-testimoni" class="table table-bordered table-hover" style="width:100%">
      <thead>
      <tr>
        <th>No</th>
        <th>Nama Testimoni </th>
        <th>Deskripsi Testimoni </th>
        <th>Link Youtube Testimoni </th>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Testimoni</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <?php echo form_open('testimoni/simpan');?>
          <div class="card-body">
            <div class="form-group">
              <label for="nama">Nama Testimoni</label>
              <input type="text" name="nama" class="form-control" id="nama" required placeholder="Masukkan nama testimoni" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="deskripsi">Deskripsi</label>
              <textarea name="deskripsi" class="form-control" id="deskripsi" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group">
              <label for="link">Link Youtube</label>
              <input type="text" name="link" class="form-control" id="link" required placeholder="Masukkan link youtube" autocomplete="off">
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
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Testimoni </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <?php echo form_open('testimoni/edit','class="formEdit"');?>
       <input type="hidden" name="id" class="idEdit">
          <div class="card-body">
            <div class="form-group">
              <label for="namaEdit">Nama Testimoni</label>
              <input type="text" name="namaEdit" class="form-control" id="namaEdit" required placeholder="Masukkan nama testimoni">
            </div>
            <div class="form-group">
              <label for="deskripsiEdit">Deskripsi</label>
              <textarea name="deskripsiEdit" class="form-control" placeholder="Masukkan Deskripsi..." id="deskripsiEdit" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group">
              <label for="link">Link Youtube</label>
              <input type="text" name="linkEdit" class="form-control" id="linkEdit" required placeholder="Masukkan link youtube" autocomplete="off">
            </div>
            
          </div>       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
        <button type="submit" class="btn btn-primary">Edit</button>
      </div>
      </form>
    </div>
  </div>
</div>