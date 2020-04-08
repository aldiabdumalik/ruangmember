$(document).ready(function() {

    const baseurl = $('.baseurl').data('baseurl');
    //datatables
    $('#datatable-persentasi').DataTable({ 

        "processing": true, 
        "serverSide": true, 
        "order": [], 
         
        "ajax": {
            "url": `${baseurl}persentasi/getPersentasi`,
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
        placeholder: "Masukkan deskripsi presentasi", 
        toolbar: [
            [ 'style', [ 'style' ] ],
            [ 'font', [ 'bold', 'italic', 'underline', 'superscript', 'subscript', 'clear'] ],
            [ 'fontname', [ 'fontname' ] ],
            [ 'fontsize', [ 'fontsize' ] ]
        ]          
    });

     /** Editing */
      $('#datatable-persentasi').on('click','.btn-edit', function(){
        var idpersentasi = $(this).data('idpersentasi');
        $('.formEdit')[0].reset(); // reset form
        $('#modalEdit').modal({
          show:true,
          backdrop: 'static',
          keyboard: false  // to prevent closing with Esc button (if you want this too)
        });

        $.ajax({
          url : `${baseurl}persentasi/EditPersentasi/${idpersentasi}`,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
           if(data.status == 'true'){
            $('.idEdit').val(idpersentasi);
            $('#namaEdit').val(data.dataPersentasi['namaPersentasi']);
            var markupStr = data.dataPersentasi['deskripsiPersentasi'];
            $('#deskripsiEdit').summernote('code', markupStr);
            $('#linkEdit').val(data.dataPersentasi['linkPersentasi']);
           }else{
            alert('Error pengambilan ajax detail persentasi ');
           }
          },
          error: function (jqXHR, textStatus, errorThrown)
          {

            alert('Error pengambilan ajax detail persentasi ');
          }
        });  

          
      });


     
});


