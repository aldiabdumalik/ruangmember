<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
  Tambah
</button>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data Marketing Plan</h3>
  </div>
            <!-- /.card-header -->
  <div class="card-body">
    <table id="datatable-marketing" class="table table-bordered table-hover" style="width:100%">
      <thead>
      <tr>
        <th>No</th>
        <th>Deskripsi Marketing Plan</th>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Marketing Plan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <?php echo form_open_multipart('marketingplan/simpan');?>
        
          <div class="card-body">
            <div class="form-group">
              <label for="deskripsi">Deskripsi Marketing</label>
              <textarea name="deskripsi" id="deskripsi" cols="30" required rows="10" class="form-control"></textarea>
            </div>
            <div class="form-group">
              <label for="foto">Foto Marketing</label>
              <input type="file" name="foto[]" multiple id="foto" class="form-control">
            </div>
            <div id="dvPreview">
            </div>
          </div>
          <!-- /.card-body -->        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Marketing Plan</h5>
       <!--  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <div class="modal-body">
       <?php echo form_open_multipart('marketingplan/edit','id="formEditMarketing"');?>
        <input type="hidden" name="id2" class="id2">
          <div class="card-body">
            <div class="form-group">
              <label for="deskripsi2">Deskripsi Marketing</label>
              <textarea name="deskripsi" id="deskripsi2" cols="30" required rows="10" class="form-control"></textarea>
            </div>
            <div class="form-group">
              <label for="foto2">Foto Marketing</label>
              <input type="file" name="foto[]" multiple id="foto2" value="" class="form-control">
            </div>
            <div class="col-lg-12 text-center" id="preview_file_div"><ul></ul></div>
            <div id="dvPreview2">
            </div>
          </div>
          <!-- /.card-body -->        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-close">Keluar</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>