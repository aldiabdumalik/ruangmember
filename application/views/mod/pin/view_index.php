<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahpin">
  Tambah
</button>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data pin</h3>
  </div>
  <div class="card-body">
    <table id="datatable-pin" class="table table-bordered table-hover" style="width:100%">
      <thead>
      <tr>
        <th>No</th>
        <th>Pin</th>
        <th>Aksi</th>
      </tr>
      </thead>
      <tbody>
        
      </tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="tambahpin" tabindex="-1" role="dialog" aria-labelledby="labelpin" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelpin">Tambah pin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <?php echo form_open('pin/simpan');?>
          <div class="card-body">
            <div class="form-group">
              <label for="pin">Pin</label>
              <input type="text" minlength="6" maxlength="6" name="pin" class="form-control" id="pin" required placeholder="Masukkan pin" autocomplete="off">
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

<div class="modal fade" id="deletepin" tabindex="-1" role="dialog" aria-labelledby="labelpin" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelpin">Hapus pin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <?php echo form_open('pin/delete');?>
          <div class="card-body">
            <input type="hidden" name="idpinedit" class="idpinedit">
              <h5 id="pinpin"></h5>
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