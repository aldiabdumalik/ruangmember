$(document).ready(function() {
    // bsCustomFileInput.init();
    $('#tanggalPertemuan').datetimepicker({
       format: "dd MM yyyy hh:ii",
        autoclose: true,
        todayBtn: true,
        pickerPosition: "bottom-right"
    }); 

    $('#tanggalPertemuanEdit').datetimepicker({
       format: "dd MM yyyy hh:ii",
        autoclose: true,
        todayBtn: true,
        pickerPosition: "bottom-right"
    });

    const baseurl = $('.baseurl').data('baseurl');
    //datatables
    $('#datatable-info').DataTable({ 

        "processing": true, 
        "serverSide": true, 
        "order": [], 
         
        "ajax": {
            "url": `${baseurl}infopertemuan/getInfo`,
            "type": "POST"
        },

         
        "columnDefs": [
        { 
            "targets": [ 0 ], 
            "orderable": false, 
        },
        ],

    });

    $('#guest').summernote({
        height: 300,                 
        minHeight: null,             
        maxHeight: null,            
        focus: true,    
        placeholder: "Masukkan guest speaker" ,
        toolbar: [
            [ 'style', [ 'style' ] ],
            [ 'font', [ 'bold', 'italic', 'underline', 'superscript', 'subscript', 'clear'] ],
            [ 'fontname', [ 'fontname' ] ],
            [ 'fontsize', [ 'fontsize' ] ]
        ]          
    });

    $('#house').summernote({
        height: 300,                 
        minHeight: null,             
        maxHeight: null,            
        focus: true,    
        placeholder: "Masukkan house couple" ,
        toolbar: [
            [ 'style', [ 'style' ] ],
            [ 'font', [ 'bold', 'italic', 'underline', 'superscript', 'subscript', 'clear'] ],
            [ 'fontname', [ 'fontname' ] ],
            [ 'fontsize', [ 'fontsize' ] ]
        ]          
    });

      // $('.btn-close').on('click', function(){
        
      //   $('#formEditCategory')[0].reset(); // reset form
      //   $('#myModalEdit').modal('hide');
      // });

      $('.dropify').dropify({
          messages: {
              default: 'Drag atau drop untuk memilih gambar',
              replace: 'Ganti',
              remove:  'Hapus',
              error:   'error'
          }
      });

  // $("#mySelect").select2()
     
});


 // $(document).ready(function(){
 //  const baseurl = $('.baseurl').data('baseurl');
 //      $("#mySelect2").select2({
 //         ajax: { 
 //           url: baseurl+"infopertemuan/getPageDetail",
 //           type: "post",
 //           dataType: 'json',
 //           delay: 250,
 //           data: function (params) {
 //              return {
 //                searchTerm: params.term // search term
 //              };
 //           },
 //           processResults: function (response) {
 //              return {
 //                 results: response
 //              };
 //           },
 //           cache: true
 //         }
 //     });
 //   });