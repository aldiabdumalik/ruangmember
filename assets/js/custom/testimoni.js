$(document).ready(function() {

    const baseurl = $('.baseurl').data('baseurl');
    //datatables
    $('#datatable-testimoni').DataTable({ 

        "processing": true, 
        "serverSide": true, 
        "order": [], 
         
        "ajax": {
            "url": `${baseurl}testimoni/getTestimoni`,
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
        placeholder: "Masukkan deskripsi testimoni", 
        toolbar: [
            [ 'style', [ 'style' ] ],
            [ 'font', [ 'bold', 'italic', 'underline', 'superscript', 'subscript', 'clear'] ],
            [ 'fontname', [ 'fontname' ] ],
            [ 'fontsize', [ 'fontsize' ] ]
        ]          
    });

     /** Editing */
      $('#datatable-testimoni').on('click','.btn-edit', function(){
        var idtestimoni = $(this).data('idtestimoni');
        $('.formEdit')[0].reset(); // reset form
        $('#modalEdit').modal({
          show:true,
          backdrop: 'static',
          keyboard: false  // to prevent closing with Esc button (if you want this too)
        });

        $.ajax({
          url : `${baseurl}testimoni/EditTestimoni/${idtestimoni}`,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
           if(data.status == 'true'){
            $('.idEdit').val(idtestimoni);
            $('#namaEdit').val(data.dataTestimoni['namaTestimoni']);
            var markupStr = data.dataTestimoni['deskripsiTestimoni'];
            $('#deskripsiEdit').summernote('code', markupStr);
            $('#linkEdit').val(data.dataTestimoni['linkTestimoni']);
           }else{
            alert('Error pengambilan ajax detail testimoni ');
           }
          },
          error: function (jqXHR, textStatus, errorThrown)
          {

            alert('Error pengambilan ajax detail testimoni ');
          }
        });  

          
      });


     
});


