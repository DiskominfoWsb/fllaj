$(document).ready(function(){
	// KONFIRMASI DELETE
	$(document).on("click", ".delete", function(e) {
	    var link = $(this).attr("data-href");
	    var id = $(this).attr("data-id");
	    swal({
	        title: "Apakah Anda Yakin ?",
	        text: "Data Akan Terhapus !",
	        type: "warning",
	        showCancelButton: true,
	        confirmButtonClass: "btn-danger",
	        confirmButtonText: "Hapus",
	        cancelButtonText: "Batal",
	        closeOnConfirm: false,
	        closeOnCancel: false
	    },
	    function(isConfirm) {
	        if (isConfirm) {
	            $.ajax({
			        url: link,
			        type: 'POST',
			        data:  {id: id},
			        mimeType:"multipart/form-data",
			        dataType:"json",
			        success: function(data)
			        {
			            if (data.response=="true") {
			                swal("Berhasil !", data.message, "success");
			                window.setTimeout(function () {
			                    location.href = data.menu; 
			                }, 500); 
			            }
			            else{ 
			                swal("Gagal !", data.message, "error");
			            };       
			        }          
			   });         
	        } else {
	            swal("Dibatalkan", "Anda Batal Menghapus.", "error");
	        }
	    });
	});

	$("#multiform_add").submit(function(e){
	    var formData = new FormData(this);
	    $.ajax({
	        url: window.location.href,
	        type: 'POST',
	        data:  formData,
	        mimeType:"multipart/form-data",
	        dataType:"json",
	        contentType: false,
	        cache: false,
	        processData:false,
	        xhr: function () {
	        var xhr = new window.XMLHttpRequest();
	            xhr.upload.addEventListener("progress", function (evt) {
	                if (evt.lengthComputable) {
	                    var percentComplete = evt.loaded / evt.total;
	                    percentComplete = parseInt(percentComplete * 100);
	                    $("#btn_update").html('<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> '+percentComplete + ' %'+' Loading...');
	                    $("#btn_update").addClass('disabled');
	                }
	            }, false);
	            return xhr;
	        },
	        success: function(data)
	        {
	            if (data.response=="true") {
	                swal("Berhasil !", data.message, "success");
	                window.setTimeout(function () {
	                    location.href = data.menu; 
	                }, 500); 
	            }
	            else{ 
	                swal("Gagal !", data.message, "error");
	            };  
	            $("#btn_update").html('<i class="fa fa-save"></i> Simpan');
	            $("#btn_update").removeClass('disabled');          
	        }          
	   });
	    e.preventDefault();
	    e.unbind();
	});

  $(document).on("click", ".publish", function(e) {
    var status = $(this).attr("data-status");
    var link = $(this).attr("data-href");
    console.log(status);
    var id = $(this).attr("data-id");
    var menu = $(this).attr("data-menu");
    if (status == 0) {
      $('#unpublish'+id).html('<button class="btn btn-xs btn-danger publish" data-href="'+jbase+'giadmin/'+menu+'/publish" data-id="'+id+'" data-status="1">unpublish</button>')
    }else{
      $('#unpublish'+id).html('<button class="btn btn-xs btn-success publish" data-href="'+jbase+'giadmin/'+menu+'/publish" data-id="'+id+'" data-status="0">publish</button>')
    }
    $.ajax({
          url: link,
          type: 'POST',
          data:  {id: id, status: status},
          mimeType:"multipart/form-data",
          dataType:"json",
          success: function(data)
          {

          }          
     });         
  });

  $(document).on("click", ".approve", function(e) {
    var status = $(this).attr("data-status");
    var link = $(this).attr("data-href");
    console.log(status);
    var id = $(this).attr("data-id");
    $.ajax({
          url: link,
          type: 'POST',
          data:  {id: id, status: status},
          mimeType:"multipart/form-data",
          dataType:"json",
          success: function(data)
          {
              if (data.response=="true") {
                  swal("Berhasil !", data.message, "success");
                  window.setTimeout(function () {
                      location.href = data.menu; 
                  }, 500); 
              }else{ 
                  swal("Gagal !", data.message, "error");
              }; 
          }          
     });         
  });
});


tinymce.init({
    selector: ".editorhtml",theme: "modern",height: 300,
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
         "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
   ],
   toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
   toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
   image_advtab: true ,
   
   external_filemanager_path: jbase+"filemanager/",
   filemanager_title:"Responsive Filemanager" ,
   external_plugins: { "filemanager" :  jbase+"filemanager/plugin.min.js"}
 });
tinymce.init({
    selector: ".editor",theme: "modern",height: 300,
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
         "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
   ],
   toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
   toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
   image_advtab: true ,
   
   external_filemanager_path: jbase+"filemanager/",
   filemanager_title:"Responsive Filemanager" ,
   external_plugins: { "filemanager" :  jbase+"filemanager/plugin.min.js"}
});

$(function () {
    $('.base-style').DataTable();
    $('.base-style2').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true
    });
    $('.base-style3').DataTable({
      'paging'      : false,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
})

$(function () {
    $('.select2').select2();
    $('.datetimepicker').datetimepicker({
  		format: 'YYYY-MM-DD HH:mm:ss',
  	});
    $('.datepicker').datetimepicker({
      format: 'YYYY-MM-DD',
    });
    $('.timepicker').datetimepicker({
      format: 'HH:mm',
    });
    $(".bootstrap-tagsinput").tagsinput('items');
});