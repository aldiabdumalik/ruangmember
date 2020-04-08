$(document).ready(function() {
    // bsCustomFileInput.init();

    const baseurl = $('.baseurl').data('baseurl');
    //datatables
    $('#datatable-sales').DataTable({ 

        "processing": true, 
        "serverSide": true, 
        "order": [], 
         
        "ajax": {
            "url": `${baseurl}sales/getSales`,
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
      $('#datatable-sales').on('click','.btn-sales', function(){
        var idsales = $(this).data('idsales');
        $('#changepassword')[0].reset(); // reset form
        $('#sales').modal({
          show:true,
          backdrop: 'static',
          keyboard: false  // to prevent closing with Esc button (if you want this too)
        });

        $.ajax({
          url : `${baseurl}sales/editSales/${idsales}`,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
           if(data.status == 'true'){
            $('.idsales').val(idsales);
           }else{
            alert('Error pengambilan ajax detail sales');
           }
          },
          error: function (jqXHR, textStatus, errorThrown)
          {

            alert('Error pengambilan ajax detail sales');
          }
        });  

          
      });

      $('#datatable-sales').on('click','.btn-hapus', function(){
        var idsales = $(this).data('idsales');
        var namasales = $(this).data('namasales');
        $('.idsalesdelete').val(idsales);
        $('#salsales').html('Apakah anda yakin ingin menghapus data sales <span class="text-danger namasales">'+namasales+'</span> ???');
        $('#deletesales').modal({
          show:true,
          backdrop: 'static',
          keyboard: false  // to prevent closing with Esc button (if you want this too)
        });
      });

      function cek() {
          var password = $("#password1").val();
          var confirmPassword = $("#password2").val();

          if (password != confirmPassword){
              $("#divCheckPasswordMatch").html('<small class="text-danger">Password tidak sama.</small>');
              document.getElementById("update").disabled = true;
          }else{
              $("#divCheckPasswordMatch").html("");
              document.getElementById("update").disabled = false;
            }
      }

      $(document).ready(function () {
         $("#password1, #password2").keyup(cek);
      });

     

});


