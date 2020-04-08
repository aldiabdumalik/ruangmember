<div class="card">
 
            <!-- /.card-header -->
  <div class="card-body">
    <div class="form-group">
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#ganti">Ganti Password</button>
      </div>
    <form action="<?= base_url('user/edit') ?>" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $admin->id_user ?>">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control" required id="username" placeholder="Masukkan username" autocomplete="off" value="<?= $admin->username ?>">
      </div>
      <div class="form-group">
        <label for="foto">Foto</label>
        <input type="file" name="foto" class="foto" data-height="180" data-default-file="<?= base_url('assets/img/user/'.$admin->foto) ?>">
      </div>
      <div class="form-group">
        <label for="nowa">No whatsApp</label>
        <input type="text" name="nowa" class="form-control" required id="nowa" placeholder="Masukkan nowa" autocomplete="off" value="<?= $admin->no_wa_user ?>">
      </div>
      <div class="form-group">
        <label for="level">Level</label>
        <input type="text" disabled name="level" class="form-control" required id="username" autocomplete="off" value="<?= $admin->level ?>">
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
      <a href="<?= base_url('dashboard') ?>" class="btn btn-danger">Kembali</a>
    </form>
  </div>
<!-- /.card-body -->
</div>

<div class="modal fade" id="ganti" tabindex="-1" role="dialog" aria-labelledby="gantipass" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="gantipass">Ganti Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <?php echo form_open('user/ganti');?>
        <div class="card-body">
          <div class="form-group">
              <label for="lama">Password lama</label>
              <input type="text" name="lama" class="form-control" required id="lama" placeholder="Masukkan password lama">
          </div>
          <div class="form-group">
              <label for="baru">Password baru</label>
              <input type="text" name="baru" class="form-control" required id="baru" placeholder="Masukkan password baru">
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