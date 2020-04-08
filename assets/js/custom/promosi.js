$(document).ready(function() {
    // bsCustomFileInput.init();

    const baseurl = $('.baseurl').data('baseurl');
    //datatables
    $('#datatable-promosi').DataTable({ 

        "processing": true, 
        "serverSide": true, 
        "order": [], 
         
        "ajax": {
            "url": `${baseurl}promosi/getPromosi`,
            "type": "POST"
        },

         
        "columnDefs": [
        { 
            "targets": [ 0 ], 
            "orderable": false, 
        },
        ],

    });


     /** Editing */
      $('#datatable-promosi').on('click','.btn-promosi', function(){
        var idpromosi = $(this).data('idpromosi');
        $('#formEdit')[0].reset(); // reset form
        $('#modalPromosi').modal({
          show:true,
          backdrop: 'static',
          keyboard: false  // to prevent closing with Esc button (if you want this too)
        });

        $.ajax({
          url : `${baseurl}promosi/EditPromosi/${idpromosi}`,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
           if(data.status == 'true'){
            $('.idEdit').val(idpromosi);
            $('.fotoEdit').attr("data-default-file",`${baseurl}assets/img/promosi/${data.dataPromosi['fotoPromosi']}`);
            $('.fotoEdit').dropify();
            $('.namaEdit').val(data.dataPromosi['namaPromosi']);
           }else{
            alert('Error pengambilan ajax detail promosi');
           }
          },
          error: function (jqXHR, textStatus, errorThrown)
          {

            alert('Error pengambilan ajax detail promosi');
          }
        });  

          
      });

      // $('.btn-close').on('click', function(){
        
      //   $('#formEditCategory')[0].reset(); // reset form
      //   $('#myModalEdit').modal('hide');
      // });

      $('.foto').dropify({
          messages: {
              default: 'Drag atau drop untuk memilih gambar',
              replace: 'Ganti',
              remove:  'Hapus',
              error:   'error'
          }
      });

     

});


