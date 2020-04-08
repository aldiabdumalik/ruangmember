$(document).ready(function() {
    // bsCustomFileInput.init();

    const baseurl = $('.baseurl').data('baseurl');
    //datatables
    $('#datatable-basicpack').DataTable({ 

        "processing": true, 
        "serverSide": true, 
        "order": [], 
         
        "ajax": {
            "url": `${baseurl}basicpack/getBasicpack`,
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
        placeholder: "Masukkan deskripsi basic pack", 
        toolbar: [
            [ 'style', [ 'style' ] ],
            [ 'font', [ 'bold', 'italic', 'underline', 'superscript', 'subscript', 'clear'] ],
            [ 'fontname', [ 'fontname' ] ],
            [ 'fontsize', [ 'fontsize' ] ]
        ]          
    });

     /** Editing */
      $('#datatable-basicpack').on('click','.btn-basic', function(){
        var idbasicpack = $(this).data('idbasicpack');
        $('.formEdit')[0].reset(); // reset form
        $('#modalBasic').modal({
          show:true,
          backdrop: 'static',
          keyboard: false  // to prevent closing with Esc button (if you want this too)
        });

        $.ajax({
          url : `${baseurl}basicpack/EditBasic/${idbasicpack}`,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
           if(data.status == 'true'){
            $('.idEdit').val(idbasicpack);
            $('.namaEdit').val(data.dataBasic['namaBasicPack']);
            $('.linkEdit').val(data.dataBasic['linkYoutube']);
            var markupStr = data.dataBasic['deskripsiBasicPack'];
            $('.deskripsiEdit').summernote('code', markupStr);
           }else{
            alert('Error pengambilan ajax detail basic pack');
           }
          },
          error: function (jqXHR, textStatus, errorThrown)
          {

            alert('Error pengambilan ajax detail basic pack');
          }
        });  

          
      });

      // $('.btn-close').on('click', function(){
        
      //   $('#formEditCategory')[0].reset(); // reset form
      //   $('#myModalEdit').modal('hide');
      // });

      $('.ppt').dropify({
          messages: {
              default: 'Drag atau drop untuk memilih ppt',
              replace: 'Ganti',
              remove:  'Hapus',
              error:   'error'
          }
      });

     

});


