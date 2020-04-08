<div class="card">
  <div class="card-body">
    <form action="<?= base_url('infopertemuan/edit') ?>" method="post">
      <input type="hidden" name="id" value="<?= $info['idPertemuan'] ?>">
      <div class="form-group">
        <label for="tanggalPertemuan">Tanggal Pertemuan</label>
        <input type="text" name="tanggal" class="form-control" required id="tanggalPertemuan" placeholder="Masukkan tanggal pertemuan" autocomplete="off" value="<?= $info['tanggalPertemuan'] ?>">
      </div>  
      <div class="form-group">
        <label for="nama">Nama Pertemuan</label>
        <input type="text" name="nama" id="nama" autocomplete="off" class="form-control" placeholder="Masukkan nama pertemuan"  value="<?= $info['namaPertemuan'] ?>" required>
      </div>
      <div class="form-group">
        <label for="tempat">Tempat Pertemuan</label>
        <input type="text" name="tempat" id="tempat" class="form-control" autocomplete="off" placeholder="Masukkan tempat pertemuan" value="<?= $info['tempatPertemuan'] ?>" required>
      </div>
      <div class="form-group">
        <label for="guest">Guest Speaker</label>
        <textarea name="guest" id="guest" cols="30" rows="10"><?= $info['guestSpeaker'] ?></textarea>
      </div>
      <div class="form-group">
        <label for="house">House Couple</label>
        <textarea name="house" id="house" cols="30" rows="10"><?= $info['houseCouple'] ?></textarea>
      </div>
      <div class="form-group">
        <label for="nowa">No WhatsApp</label>
        <input type="number" name="no" class="form-control" autocomplete="off" id="nowa" required placeholder="Masukkan no whatsApp" value="<?= $info['noWa'] ?>">
      </div>
       
      <button type="submit" class="btn btn-primary">Update</button>
      <a href="<?= base_url('infopertemuan') ?>" class="btn btn-danger">Kembali</a>
    </form>
  </div>
</div>