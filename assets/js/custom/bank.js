$(document).ready(function() {
    // bsCustomFileInput.init();

    const baseurl = $('.baseurl').data('baseurl');
    //datatables
    $('#datatable-bank').DataTable({ 

        "processing": true, 
        "serverSide": true, 
        "order": [], 
         
        "ajax": {
            "url": `${baseurl}bank/get_bank`,
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
      $('#datatable-bank').on('click','.btn-bank', function(){
        var idbank = $(this).data('idbank');
        $('#formbankedit')[0].reset(); // reset form
        $('#edit').modal({
          show:true,
          backdrop: 'static',
          keyboard: false  // to prevent closing with Esc button (if you want this too)
        });

        $.ajax({
          url : `${baseurl}bank/edit_bank/${idbank}`,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
           if(data.status == 'true'){
            $('.idbankedit').val(idbank);
            $('#namabankedit').val(data.databank['nama_bank']);
            $('#norekedit').val(data.databank['norek_bank']);
            $('#anedit').val(data.databank['an_bank']);
           }else{
            alert('Error pengambilan ajax detail bank');
           }
          },
          error: function (jqXHR, textStatus, errorThrown)
          {

            alert('Error pengambilan ajax detail bank');
          }
        });  

          
      });

      $('#datatable-bank').on('click','.btn-hapus', function(){
        var idbank = $(this).data('idbank');
        var namabank = $(this).data('namabank');
        $('.idbankdelete').val(idbank);
        $('#bank').html('Apakah anda yakin ingin menghapus data bank <span class="text-danger namabank">'+namabank+'</span> ???');
        $('#delete').modal({
          show:true,
          backdrop: 'static',
          keyboard: false  // to prevent closing with Esc button (if you want this too)
        });
      });
});


