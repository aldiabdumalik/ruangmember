<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data Order</h3>
  </div>
  <div class="card-body">
    <table id="datatable-order-selesai" class="table table-bordered table-hover" style="width:100%">
      <thead>
      <tr>
        <th>No</th>
        <th>ID order</th>
        <th>Nama sales</th>
        <th>Total harga order</th>
        <th>Tanggal order</th>
        <th>Foto bukti</th>
        <th>Status order</th>
        <th>Aksi</th>
      </tr>
      </thead>
      <tbody>
        
      </tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="konfir" tabindex="-1" role="dialog" aria-labelledby="labelpin" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelpin">Konfirmasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php echo form_open('order/konfir');?>
          <div class="card-body" id="FormConfirm"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
        <button type="submit" class="btn btn-primary">Konfirmasi</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="order_detail" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal">Data order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="card-body">
            <div class="form-group">
              <label for="idorderview">ID Order</label>
              <input type="text" name="idorderview" id="idorderview" class="form-control" readonly="">
            </div>
            <div class="form-group">
              <label for="namasalesview">Nama sales</label>
              <input type="text" name="namasalesview" id="namasalesview" class="form-control" readonly="">
            </div>
            <div class="form-group">
              <label for="namapenerimaview">Nama penerima</label>
              <input type="text" name="namapenerimaview" id="namapenerimaview" class="form-control" readonly="">
            </div>
            <div class="form-group">
              <label for="daftarprodukview">Daftar produk</label>            
              <table class="table table-bordered" id="produk">
                
              </table>
            </div>
            <div class="form-group row">
              <label for="totalorderview" class="col-sm-2 col-form-label">Total order</label>
              <div class="col-sm-10">
                 <input type="text" name="totalorderview" id="totalorderview" class="form-control" readonly="">
              </div>
            </div>
            <div class="form-group" style="border-top: 1px solid #eaeaea;">
              <label for="namabankview">Nama bank</label>
              <input type="text" name="namabankview" id="namabankview" class="form-control" readonly="">
            </div>
            <div class="form-group">
              <label for="norekview">No.rek</label>
              <input type="text" name="norekview" id="norekview" class="form-control" readonly="">
            </div>
            <div class="form-group">
              <label for="anbankview">Atas nama</label>
              <input type="text" name="anbankview" id="anbankview" class="form-control" readonly="">
            </div>
          </div>
      </div>
      
    </div>
  </div>
</div>