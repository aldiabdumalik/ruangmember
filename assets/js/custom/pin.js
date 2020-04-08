$(document).ready(function() {
    // bsCustomFileInput.init();

    const baseurl = $('.baseurl').data('baseurl');
    //datatables
    $('#datatable-pin').DataTable({ 

        "processing": true, 
        "serverSide": true, 
        "order": [], 
         
        "ajax": {
            "url": `${baseurl}pin/getPin`,
            "type": "POST"
        },

         
        "columnDefs": [
        { 
            "targets": [ 0 ], 
            "orderable": false, 
        },
        ],

    });

    $('#datatable-pin').on('click','.btn-hapus', function(){
        var idpin   = $(this).data('idpin');
        var pin     = $(this).data('pin');
        $('.idpinedit').val(idpin);
        $('#pinpin').html('Apakah anda yakin ingin menghapus pin ini <span class="text-danger pin">'+pin+'</span> ???');
        $('#deletepin').modal({
          show:true,
          backdrop: 'static',
          keyboard: false  // to prevent closing with Esc button (if you want this too)
        });
    });

    $('.form-group').on('keydown', '#pin', function(e){
        -1!==$
        .inArray(e.keyCode,[46,8,9,27,13,110,190]) || /65|67|86|88/
        .test(e.keyCode) && (!0 === e.ctrlKey || !0 === e.metaKey)
        || 35 <= e.keyCode && 40 >= e.keyCode || (e.shiftKey|| 48 > e.keyCode || 57 < e.keyCode)
        && (96 > e.keyCode || 105 < e.keyCode) && e.preventDefault()
    });
});