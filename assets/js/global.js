// SWEETALERT
const flashdata = $('.flashdata').data('flashdata');
$(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 5000
    });

    if (flashdata == 'berhasil') {
      Toast.fire({
        type: 'success',
        title: 'Data berhasil disimpan'
      });
    }else if(flashdata == 'gagalDisimpan'){
      Toast.fire({
        type: 'error',
        title: 'Data gagal disimpan, periksa lagi datanya.'
      });
    }else if(flashdata == 'errorGambar'){
      Toast.fire({
        type: 'warning',
        title: 'Maaf, silahkan periksa lagi type gambar nya.(gif|jpg|png|jpeg)'
      });
    }else if(flashdata == 'hapus'){
      Toast.fire({
        type: 'success',
        title: 'Data berhasil dihapus.'
      });
    }else if(flashdata == 'gagalDihapus'){
      Toast.fire({
        type: 'error',
        title: 'Maaf, data gagal dihapus.'
      });
    }else if(flashdata == 'dataKosong'){
      Toast.fire({
        type: 'error',
        title: 'Maaf, data tidak ada.'
      });
    }else if(flashdata == 'edit'){
      Toast.fire({
        type: 'success',
        title: 'Data berhasil diubah.'
      });
    }else if(flashdata == 'gagalDiedit'){
      Toast.fire({
        type: 'error',
        title: 'Maaf, data gagal diubah.'
      });
    }else if(flashdata == 'errorFile'){
      Toast.fire({
        type: 'warning',
        title: 'Maaf, hanya file ppt.'
      });
    }else if(flashdata == 'aktif'){
      Toast.fire({
        type: 'success',
        title: 'Akun telah aktif.'
      });
    }else if(flashdata == 'password'){
      Toast.fire({
        type: 'success',
        title: 'Password berhasil diubah.'
      });
    }else if(flashdata == 'gagalpassword'){
      Toast.fire({
        type: 'error',
        title: 'Password yang anda masukkan salah.'
      });
    }else if(flashdata == 'konfirmasi'){
      Toast.fire({
        type: 'success',
        title: 'Order sukses dikonfirmasi.'
      });
    }else if(flashdata == 'gagalKonfir'){
      Toast.fire({
        type: 'error',
        title: 'Order gagal di konfirmasi.'
      });
    }
    
});