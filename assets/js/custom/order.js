$(document).ready(function() {
    // bsCustomFileInput.init();

    const baseurl = $('.baseurl').data('baseurl');
    //datatables
    $('#datatable-order').DataTable({ 

        "processing": true, 
        "serverSide": true, 
        "order": [], 
         
        "ajax": {
            "url": `${baseurl}order/get_order`,
            "type": "POST"
        },

         
        "columnDefs": [
        { 
            "targets": [ 0 ], 
            "orderable": false, 
        },
        ],

    });

    $('#datatable-order').on('click','.btn-konfir', function(){
        var idorder = $(this).data('idorder');
        var status = $(this).data('status');
        $('#FormConfirm').empty();
        if (status == 'diproses') {
          $('#FormConfirm').append(`
            <div class="form-group">
              <label for="id_order">ID Order</label>
              <input type="text" name="id_order" class="form-control" value="${idorder}" readonly>
            </div>
            <div class="form-group">
              <label for="status">Status</label>
              <input type="text" name="status" class="form-control" value="${status}" readonly>
            </div>
            <div class="form-group">
              <label for="noresi">Nomor Resi</label>
              <input type="text" name="noresi" class="form-control" placeholder="Masukan nomor resi" required>
            </div>
          `);
        }else{
          $('#FormConfirm').append(`
            <div class="form-group">
              <label for="id_order">ID Order</label>
              <input type="text" name="id_order" class="form-control" value="${idorder}" readonly>
            </div>
            <div class="form-group">
              <label for="status">Status</label>
              <input type="text" name="status" class="form-control" value="${status}" readonly>
            </div>
          `);
        }
        // $('.idorderkonfir').val(idorder);
        // $('#order').html('Konfirmasi orderan ini <span class="idorderkonfir text-danger">'+idorder+'</span>');
        $('#konfir').modal({
          show:true,
          backdrop: 'static',
          keyboard: false  // to prevent closing with Esc button (if you want this too)
        });
    });

    $('#datatable-order').on('click','.btn-lihat', function(){
        var idorder = $(this).data('idorder');
        $('#order_detail').modal({
          show:true,
          backdrop: 'static',
          keyboard: false  // to prevent closing with Esc button (if you want this too)
        });

        $.ajax({
          url : `${baseurl}order/order_detail_view/${idorder}`,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
           if(data.status == 'true'){
            $('#idorderview').val(data.dataorder[0]['id_order']);
            $('#namasalesview').val(data.dataorder[0]['nama_sales']);
            $('#namaconsumerview').val(data.dataorder[0]['nama_consumer']);
            $('#namapenerimaview').val(data.dataorder[0]['nama_penerima']);
            $('#namabankview').val(data.dataorder[0]['nama_bank']);
            $('#norekview').val(data.dataorder[0]['norek_bank']);
            $('#anbankview').val(data.dataorder[0]['an_bank']);
            var html = "<tr>"+
                            "<td>"+ "No" + "</td>"+
                            "<td>"+ "Nama produk" +"</td>"+
                            "<td>"+ "Harga produk" +"</td>"+
                            "<td>"+ "Jumlah" +"</td>"+
                            "<td>"+ "Total harga" +"</td>"+
                        "</tr>";
                for (var i = 0; i < data.dataorder.length; i++){
                var bilangan1 = data.dataorder[i].hargaProduk;
    
                var reverse1 = bilangan1.toString().split('').reverse().join(''),
                    hargaproduk  = reverse1.match(/\d{1,3}/g);
                    hargaproduk  = hargaproduk.join('.').split('').reverse().join('');

                var bilangan2 = data.dataorder[i].total_detail;
    
                var reverse2 = bilangan2.toString().split('').reverse().join(''),
                    total_harga  = reverse2.match(/\d{1,3}/g);
                    total_harga  = total_harga.join('.').split('').reverse().join('');

                html +=
                        "<tr>"+
                            "<td>"+ (i+1) + "</td>"+
                            "<td>"+ data.dataorder[i].namaProduk + "</td>"+
                            "<td>"+ 'Rp. '+hargaproduk + "</td>"+
                            "<td>"+ data.dataorder[i].qty_detail + "</td>"+
                            "<td>"+ 'Rp. '+total_harga + "</td>"+
                        "</tr>";
                }
            $("#produk").html(html);
            var bilangan = data.dataorder[0]['total_order'];
    
            var reverse = bilangan.toString().split('').reverse().join(''),
                ribuan  = reverse.match(/\d{1,3}/g);
                ribuan  = ribuan.join('.').split('').reverse().join('');

            $('#totalorderview').val('Rp. '+ ribuan);

           }else{
            alert('Error pengambilan ajax detail order');
           }
          },
          error: function (jqXHR, textStatus, errorThrown)
          {

            alert('Error pengambilan ajax detail order');
          }
        });  

          
      });














  $('#datatable-order-selesai').DataTable({ 

      "processing": true, 
      "serverSide": true, 
      "order": [], 
       
      "ajax": {
          "url": `${baseurl}order/get_order2`,
          "type": "POST"
      },

       
      "columnDefs": [
      { 
          "targets": [ 0 ], 
          "orderable": false, 
      },
      ],

  });

  $('#datatable-order-selesai').on('click','.btn-lihat', function(){
    var idorder = $(this).data('idorder');
    $('#order_detail').modal({
      show:true,
      backdrop: 'static',
      keyboard: false  // to prevent closing with Esc button (if you want this too)
    });

    $.ajax({
      url : `${baseurl}order/order_detail_view/${idorder}`,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
       if(data.status == 'true'){
        $('#idorderview').val(data.dataorder[0]['id_order']);
        $('#namasalesview').val(data.dataorder[0]['nama_sales']);
        $('#namaconsumerview').val(data.dataorder[0]['nama_consumer']);
        $('#namapenerimaview').val(data.dataorder[0]['nama_penerima']);
        $('#namabankview').val(data.dataorder[0]['nama_bank']);
        $('#norekview').val(data.dataorder[0]['norek_bank']);
        $('#anbankview').val(data.dataorder[0]['an_bank']);
        var html = "<tr>"+
                        "<td>"+ "No" + "</td>"+
                        "<td>"+ "Nama produk" +"</td>"+
                        "<td>"+ "Harga produk" +"</td>"+
                        "<td>"+ "Jumlah" +"</td>"+
                        "<td>"+ "Total harga" +"</td>"+
                    "</tr>";
            for (var i = 0; i < data.dataorder.length; i++){
            var bilangan1 = data.dataorder[i].hargaProduk;

            var reverse1 = bilangan1.toString().split('').reverse().join(''),
                hargaproduk  = reverse1.match(/\d{1,3}/g);
                hargaproduk  = hargaproduk.join('.').split('').reverse().join('');

            var bilangan2 = data.dataorder[i].total_detail;

            var reverse2 = bilangan2.toString().split('').reverse().join(''),
                total_harga  = reverse2.match(/\d{1,3}/g);
                total_harga  = total_harga.join('.').split('').reverse().join('');

            html +=
                    "<tr>"+
                        "<td>"+ (i+1) + "</td>"+
                        "<td>"+ data.dataorder[i].namaProduk + "</td>"+
                        "<td>"+ 'Rp. '+hargaproduk + "</td>"+
                        "<td>"+ data.dataorder[i].qty_detail + "</td>"+
                        "<td>"+ 'Rp. '+total_harga + "</td>"+
                    "</tr>";
            }
        $("#produk").html(html);
        var bilangan = data.dataorder[0]['total_order'];

        var reverse = bilangan.toString().split('').reverse().join(''),
            ribuan  = reverse.match(/\d{1,3}/g);
            ribuan  = ribuan.join('.').split('').reverse().join('');

        $('#totalorderview').val('Rp. '+ ribuan);

       }else{
        alert('Error pengambilan ajax detail order');
       }
      },
      error: function (jqXHR, textStatus, errorThrown)
      {

        alert('Error pengambilan ajax detail order');
      }
    });  

      
  });
});


