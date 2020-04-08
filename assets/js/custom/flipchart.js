$(document).ready(function() {
    // bsCustomFileInput.init();

    const baseurl = $('.baseurl').data('baseurl');
    //datatables
    $('#datatable-flipchart').DataTable({ 

        "processing": true, 
        "serverSide": true, 
        "order": [], 
         
        "ajax": {
            "url": `${baseurl}flipchart/getFlipChart`,
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
        placeholder: "Masukkan deskripsi flip chart", 
        toolbar: [
            [ 'style', [ 'style' ] ],
            [ 'font', [ 'bold', 'italic', 'underline', 'superscript', 'subscript', 'clear'] ],
            [ 'fontname', [ 'fontname' ] ],
            [ 'fontsize', [ 'fontsize' ] ]
        ]          
    });

     /** Editing */
      $('#datatable-flipchart').on('click','.btn-flip', function(){
        var idflipchart = $(this).data('idflipchart');
        $('#formEdit')[0].reset(); // reset form
        $('#modalFlip').modal({
          show:true,
          backdrop: 'static',
          keyboard: false  // to prevent closing with Esc button (if you want this too)
        });

        $.ajax({
          url : `${baseurl}flipchart/EditFlip/${idflipchart}`,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
           if(data.status == 'true'){
            $('.fotoEdit').attr("data-default-file",`${baseurl}assets/img/flipchart/${data.dataFlip['fotoFlipChart']}`);
            $('.fotoEdit').dropify();
            $('.idEdit').val(idflipchart);
            $('#namaEdit').val(data.dataFlip['namaFlipChart']);
            var markupStr = data.dataFlip['deskripsiFlipChart'];
            $('#deskripsiEdit').summernote('code', markupStr);
           }else{
            alert('Error pengambilan ajax detail flip chart');
           }
          },
          error: function (jqXHR, textStatus, errorThrown)
          {

            alert('Error pengambilan ajax detail flip chart');
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


