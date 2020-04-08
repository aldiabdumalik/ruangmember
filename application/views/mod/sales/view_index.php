<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data sales</h3>
  </div>
  <div class="card-body">
    <table id="datatable-sales" class="table table-bordered table-hover" style="width:100%">
      <thead>
      <tr>
        <th>No</th>
        <th>Nama Sales</th>
        <th>No Wa Sales</th>
        <th>Status Sales</th>
        <th>Aksi</th>
      </tr>
      </thead>
      <tbody>
        
      </tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="sales" tabindex="-1" role="dialog" aria-labelledby="labelpromosi" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelpromosi">Ubah Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <?php echo form_open('sales/ubahpassword',['id' => 'changepassword']);?>
          <div class="card-body">
            <input type="hidden" name="idsales" class="idsales">
            <div class="form-group">
              <label for="nama">Password</label>
              <input type="password" minlength="8" name="password1" class="form-control" required id="password1" placeholder="Masukkan password">
            </div>        
            <div class="form-group">
              <label for="password2">Ulangi Password</label>
              <input type="password" minlength="8" name="password2" class="form-control" required id="password2" placeholder="Ulangi masukkan password" onchange="cek()">
              <div class="registrationFormAlert" id="divCheckPasswordMatch"></div>
            </div>
            <small>Note* : Password minimal 8 karakter</small>
          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
        <button type="submit" class="btn btn-primary" id="update">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="deletesales" tabindex="-1" role="dialog" aria-labelledby="labelpromosi" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelpromosi">Hapus sales</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <?php echo form_open('sales/delete');?>
          <div class="card-body">
            <input type="hidden" name="idsalesdelete" class="idsalesdelete">
              <h5 id="salsales"></h5>
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