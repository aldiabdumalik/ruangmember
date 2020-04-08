<div class="card">
  <div class="card-header">
    <h3 class="card-title">Permintaan user</h3>
  </div>
            <!-- /.card-header -->
  <div class="card-body">
    <table id="datatable-dashboard" class="table table-bordered table-hover" style="width:100%">
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
        <?php $no=1; foreach ($user as $u): ?>
        <?php if (!$u->status_sales == 1): ?>
          <td><?= $no++; ?></td>
          <td><?= $u->nama_sales ?></td>
          <td><?= $u->nowa_sales ?></td>
          <td>
            <?php if ($u->status_sales == 1): ?>
              <span class="badge badge-pill badge-success">aktif</span>
            <?php else: ?>
              <span class="badge badge-pill badge-danger">tidak aktif</span>
            <?php endif ?>
          </td>
          <td>
            <?php if ($u->status_sales != 1): ?>
              <a href="<?= base_url('dashboard/aktif/'.$u->id_plm) ?>" class="btn btn-success btn-sm">aktifkan</a>
            <?php else: ?>
              <p class="badge badge-info">sudah aktif</p>
            <?php endif ?>
          </td>
        <?php endif ?>
          
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
<!-- /.card-body -->
</div>