<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
  Tambah
</button>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Info Pertemuan</h3>
  </div>
  
            <!-- /.card-header -->
  <div class="card-body">
    <table id="datatable-info" class="table table-bordered table-hover" style="width:100%">
      <thead>
      <tr>
        <th>No</th>
        <th>Tanggal Pertemuan</th>
        <th>Nama Pertemuan</th>
        <th>Tempat Pertemuan</th>
        <th>Nomor WA</th>
        <th>Aksi</th>
      </tr>
      </thead>
      <tbody>
        
      </tbody>
    </table>
  </div>
<!-- /.card-body -->
</div>

<!-- Modal Add -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Info Pertemuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <?php echo form_open_multipart('infopertemuan/simpan');?>
          <div class="card-body">
            <div class="form-group">
              <label for="tanggalPertemuan">Tanggal Pertemuan</label>
              <input type="text" name="tanggal" class="form-control" required id="tanggalPertemuan" placeholder="Masukkan tanggal pertemuan" autocomplete="off">
            </div>  
            <div class="form-group">
              <label for="nama">Nama Pertemuan</label>
              <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama pertemuan">
            </div>
            <div class="form-group">
              <label for="tempat">Tempat Pertemuan</label>
              <input type="text" name="tempat" id="tempat" class="form-control" placeholder="Masukkan tempat pertemuan">
            </div>
            <div class="form-group">
              <label for="guest">Guest Speaker</label>
              <textarea name="guest" id="guest" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group">
              <label for="house">House Couple</label>
              <textarea name="house" id="house" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group">
              <label for="nowa">No WhatsApp</label>
              <input type="number" name="no" class="form-control" id="nowa" required placeholder="Masukkan no whatsApp">
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