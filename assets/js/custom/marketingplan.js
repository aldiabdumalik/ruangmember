$(document).ready(function() {
    bsCustomFileInput.init();

    const baseurl = $('.baseurl').data('baseurl');
    //datatables
    $('#datatable-marketing').DataTable({ 

        "processing": true, 
        "serverSide": true, 
        "order": [], 
         
        "ajax": {
            "url": `${baseurl}marketingplan/getMarketing`,
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
        placeholder: "Masukkan deskripsi marketing plan", 
        toolbar: [
            [ 'style', [ 'style' ] ],
            [ 'font', [ 'bold', 'italic', 'underline', 'superscript', 'subscript', 'clear'] ],
            [ 'fontname', [ 'fontname' ] ],
            [ 'fontsize', [ 'fontsize' ] ]
        ]          
    });


     /** Editing */
      $('#datatable-marketing').on('click','.btn-edit', function(){
        var idmarketing = $(this).data('idmarketing');
        $('#formEditMarketing')[0].reset(); // reset form
        $('#modalEdit').modal({
          show:true,
          backdrop: 'static',
          keyboard: false  // to prevent closing with Esc button (if you want this too)
        });

        $.ajax({
          url : `${baseurl}marketingplan/EditMarketing/${idmarketing}`,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
           if(data.status == 'true'){
            $('.id2').val(data.dataMarketing[0]['idMarketing']);
            var markupStr = data.dataMarketing[0]['deskripsiMarketing'];
            $('#deskripsi2').summernote('code', markupStr);
            
                for (i = 0; i < data.dataMarketing.length; i++) {
                  var img = document.createElement("img");
                  img.height = "100";
                  img.width = "100";
                  img.src =  `${baseurl}assets/img/marketingplan/${data.dataMarketing[i]['foto']}`;
                  var src = document.getElementById("dvPreview2");
                  src.appendChild(img);
                }
            
           }else{
            alert('Error pengambilan ajax detail marketingplan');
           }
          },
          error: function (jqXHR, textStatus, errorThrown)
          {

            alert('Error pengambilan ajax detail marketingplan');
          }
        });  

          
      });

      $('.btn-close').on('click', function(){
        $("#dvPreview2 img").remove();
        $('#modalEdit').modal('hide');
      });

      window.onload = function () {
      var fileUpload = document.getElementById("foto");
      fileUpload.onchange = function () {
          if (typeof (FileReader) != "undefined") {
              var dvPreview = document.getElementById("dvPreview");
              dvPreview.innerHTML = "";
              var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
              for (var i = 0; i < fileUpload.files.length; i++) {
                  var file = fileUpload.files[i];
                  if (regex.test(file.name.toLowerCase())) {
                      var reader = new FileReader();
                      reader.onload = function (e) {
                          var img = document.createElement("IMG");
                          img.height = "100";
                          img.width = "100";
                          img.src = e.target.result;
                          dvPreview.appendChild(img);
                      }
                      reader.readAsDataURL(file);
                  } else {
                      alert(file.name + " is not a valid image file.");
                      dvPreview.innerHTML = "";
                      return false;
                  }
              }
          } else {
              alert("This browser does not support HTML5 FileReader.");
          }
      }
  };


      var input_file = document.getElementById('foto2');
      var deleted_file_ids = [];
      var dynm_id = 0;

      $("#foto2").change(function (event) {
          var len = input_file.files.length;
          $('#dvPreview2').html("");
          
          for(var j=0; j<len; j++) {
              var src = "";
              var name = event.target.files[j].name;
              var mime_type = event.target.files[j].type.split("/");
              if(mime_type[0] == "image") {
                src = URL.createObjectURL(event.target.files[j]);
              } else if(mime_type[0] == "video") {
                src = 'icons/video.png';
              } else {
                src = 'icons/file.png';
              }
              $('#dvPreview2').append("<img src="+src+" width='100' height='100'/>");
              dynm_id++;
          }
      });

});


