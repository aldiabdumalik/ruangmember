<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambah">
  Tambah
</button>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data Bank</h3>
  </div>
  <div class="card-body">
    <table id="datatable-bank" class="table table-bordered table-hover" style="width:100%">
      <thead>
      <tr>
        <th>No</th>
        <th>Nama Bank</th>
        <th>Norek Bank</th>
        <th>a.n Bank</th>
        <th>Aksi</th>
      </tr>
      </thead>
      <tbody>
        
      </tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="label">Tambah bank</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <?php echo form_open('bank/simpan');?>
          <div class="card-body">
            <div class="form-group">
              <label for="namabank">Nama bank</label>
              <input type="text" name="namabank" class="form-control" id="namabank" required placeholder="Masukkan bank" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="norek">Norek bank</label>
              <input type="text" name="norek" class="form-control" id="norek" required placeholder="Masukkan norek bank" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="an">a.n bank</label>
              <input type="text" name="an" class="form-control" id="an" required placeholder="Masukkan a.n. bank" autocomplete="off">
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

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="label">Edit bank</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <?php echo form_open('bank/edit',['id'=>'formbankedit']);?>
          <div class="card-body">
            <input type="hidden" name="idbankedit" class="idbankedit">
            <div class="form-group">
              <label for="namabankedit">Nama bank</label>
              <input type="text" name="namabankedit" class="form-control" id="namabankedit" required placeholder="Masukkan bank" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="norekedit">Norek bank</label>
              <input type="text" name="norekedit" class="form-control" id="norekedit" required placeholder="Masukkan norek bank" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="anedit">a.n bank</label>
              <input type="text" name="anedit" class="form-control" id="anedit" required placeholder="Masukkan a.n. bank" autocomplete="off">
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

<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="labelpin" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelpin">Hapus bank</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <?php echo form_open('bank/delete');?>
          <div class="card-body">
            <input type="hidden" name="idbankdelete" class="idbankdelete">
              <h5 id="bank"></h5>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
        <button type="submit" class="btn btn-primary">Yakin</button>
      </div>
      </form>
    </div>
  </div>
</div>