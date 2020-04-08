$(document).ready(function() {
    bsCustomFileInput.init();

    const baseurl = $('.baseurl').data('baseurl');
    //datatables
    $('#datatable-produk').DataTable({ 

        "processing": true, 
        "serverSide": true, 
        "order": [], 
         
        "ajax": {
            "url": `${baseurl}produk/getProduk`,
            "type": "POST"
        },

         
        "columnDefs": [
        { 
            "targets": [ 0 ], 
            "orderable": false, 
        },
        ],

    });

    $('#deskripsi').summernote({
        height: 300,                 
        minHeight: null,             
        maxHeight: null,            
        focus: true,    
        placeholder: "Masukkan deskripsi produk" ,
        toolbar: [
            [ 'style', [ 'style' ] ],
            [ 'font', [ 'bold', 'italic', 'underline', 'superscript', 'subscript', 'clear'] ],
            [ 'fontname', [ 'fontname' ] ],
            [ 'fontsize', [ 'fontsize' ] ],
            ['insert', ['link', 'picture']],
            ['view', ['fullscreen', 'codeview', 'help']],
        ],
        callbacks: {
            onImageUpload: function(image) {
                uploadImage(image[0]);
                // console.log(image[0]);
            },
            onMediaDelete : function(target) {
                deleteImage(target[0].src);
            }
          }          
    });

    function uploadImage(image) {
        var data = new FormData();
        data.append("image", image);
        $.ajax({
            url: `${baseurl}produk/upload_image`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "POST",
            success: function(url) {
          $('#deskripsi').summernote("insertImage", url);
            },
            error: function(data) {
                console.log('error');
            }
        });
    }

    function deleteImage(src) {
        $.ajax({
            data: {src : src},
            type: "POST",
            url: `${baseurl}produk/delete_image`,
            cache: false,
            success: function(response) {
                console.log(response);
            }
        });
    }

     

      $('.dropify').dropify({
          messages: {
              default: 'Drag atau drop untuk memilih gambar',
              replace: 'Ganti',
              remove:  'Hapus',
              error:   'error'
          }
      });

      $('.dropifyEdit').dropify({
          messages: {
              default: 'Drag atau drop untuk memilih gambar',
              replace: 'Ganti',
              remove:  'Hapus',
              error:   'error'
          }
      });

      multi_select_add();

      function multi_select_add() {
        $.ajax({
            type: "GET",
            url: `${baseurl}produk/getProdukForSelect`,
            cache: false,
            success: function(response) {
                response = JSON.parse(response);
                $.each(response, function (d, data) {
                  $('#paket_produk').append(
                    $('<option></option>').attr({"value":data['idProduk']}).text(data['namaProduk'])
                  );
                });
                $('#paket_produk').multiSelect();
            }
        });
      }

      $('#kategori').change(function () {
        console.log($('#kategori').val());
        if ($('#kategori').val() !== 'retail') {
          $('.paket').removeClass('collapse');
        }else{
          $('.paket').addClass('collapse');
        }
      });
});


