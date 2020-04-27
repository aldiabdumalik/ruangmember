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



      $('#datatable-sales').on('click','.btn-bonus', function(){
        console.log($(this).data('idsales'));
        location.href = baseurl+'sales/detail?sales='+$(this).data('idsales')
      });

      $('#btn-cek-bonus').click(function () {
        if ($('#id_plm').val() != "" && $('#bulan').val() != "" && $('#tahun').val() != "") {
          $.ajax({
            type: "GET",
            url: `${baseurl}sales/get_bonus?id=${$('#id_plm').val()}&bulan=${$('#bulan').val()}&tahun=${$('#tahun').val()}`,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (response) {
              $('#datatable-bonus-tb').empty();
              result = JSON.parse(JSON.stringify(response));
              console.log(result);
              if (result.request == 'true') {
                $.each(result.data, function (d, data) {
                  if (data.status_bonus == 0) {
                    var status = `<span class="text-warning">Belum ditransfer</span>`;
                    var btn = `<button type="button" class="btn btn-info btn-sm" onclick="transferkan('${data.id_order}')"><i class="fa fa-check"></i></button>`;
                  }else{
                    var status = `<span class="text-success">Sudah ditransfer</span>`;
                    var btn = '-';
                  }
                  $('#datatable-bonus-tb').append(`
                    <tr>
                      <td>${data.id_order}</td>
                      <td>${data.tgl_bonus}</td>
                      <td>${data.komisi}</td>
                      <td>${status}</td>
                    </tr>
                  `);
                });
                if (result.total_belom.total_bonus == null) {
                  var belom = 0;
                  var btnnya = '-';
                }else{
                  var belom = result.total_belom.total_bonus;
                  var btnnya = '<button type="button" id="transferkan" class="btn btn-info btn-sm"><i class="fa fa-check-circle"></i> Transfer</button>';
                }
                if (result.total_udah.total_bonus == null) {
                  var sudah = 0;
                }else{
                  var sudah = result.total_udah.total_bonus;
                }
                $('#datatable-bonus-tb2').append(`
                  <tr>
                    <td colspan="2" align="right">Total belum ditransfer (-10%)</td>
                    <td>${belom}</td>
                    <td>${btnnya}</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="right">Total sudah ditransfer (-10%)</td>
                    <td>${sudah}</td>
                    <td>-</td>
                  </tr>
                `);

                $('#transferkan').click(function () {
                  var r = confirm("Apakah anda yakin akan mentransfer ke rekening "+$('#norek').val()+"?");
                  if (r == true) {
                    $.ajax({
                      type: "POST",
                      url: `${baseurl}sales/update_status`,
                      data: {id_plm:$('#id_plm').val()},
                      dataType: "json",
                      success: function (response) {
                        result = JSON.parse(JSON.stringify(response));
                        alert('Berhasil mengirim bonus');
                        location.reload();
                      }
                    });
                  }
                }); 
              }
            }
          });
        }
      });

     

});


