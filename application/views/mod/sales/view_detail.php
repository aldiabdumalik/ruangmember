<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data <?= $sales['nama_sales']; ?></h3>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-12 col-lg-6">
        <div class="form-group">
          <label>ID PLM</label>
          <input type="text" id="id_plm" class="form-control" value="<?= $sales['id_plm']; ?>" readonly>
        </div>
        <div class="form-group">
          <label>Nama</label>
          <input type="text" class="form-control" value="<?= $sales['nama_sales']; ?>" readonly>
        </div>
        <div class="form-group">
          <label>No Whatsapp</label>
          <input type="text" class="form-control" value="<?= $sales['nowa_sales']; ?>" readonly>
        </div>
        <div class="form-group">
          <label>Nama Bank</label>
          <input type="text" class="form-control" value="<?= $sales['nama_bank']; ?>" readonly>
        </div>
        <div class="form-group">
          <label>Nomor Rekening</label>
          <input type="text" id="norek" class="form-control" value="<?= $sales['norek_bank']; ?>" readonly>
        </div>
        <div class="form-group">
          <label>Atas nama</label>
          <input type="text" class="form-control" value="<?= $sales['an_bank']; ?>" readonly>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12 col-lg-4">
    <div class="card">
      <div class="card-body">
        <div class="form-group">
          <label for="bulan">Bulan</label>
          <select name="bulan" id="bulan" class="form-control">
            <option value="">Pilih bulan</option>
            <option value="01">Januari</option>
            <option value="02">Februari</option>
            <option value="03">Maret</option>
            <option value="04">April</option>
            <option value="05">Mei</option>
            <option value="06">Juni</option>
            <option value="07">Juli</option>
            <option value="08">Agustus</option>
            <option value="09">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
          </select>
        </div>
        <div class="form-group">
          <label for="tahun">Tahun</label>
          <select name="tahun" id="tahun" class="form-control">
            <option value="">Tahun</option>
            <?php for ($i=2020; $i <= date('Y'); $i++): ?>
            <option value="<?= $i ?>"><?= $i ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <div class="form-group">
          <button type="button" id="btn-cek-bonus" class="btn btn-success" style="width:100%">Cari</button>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12 col-lg-8">
    <div class="card">
      <div class="card-body">
        <table id="datatable-bonus" class="table table-bordered table-hover" style="width:100%">
          <thead>
            <tr>
              <th>ID Order</th>
              <th>Tanggal</th>
              <th>Jumlah</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody id="datatable-bonus-tb"></tbody>
          <tbody id="datatable-bonus-tb2"></tbody>
        </table>
      </div>
    </div>
  </div>
</div>