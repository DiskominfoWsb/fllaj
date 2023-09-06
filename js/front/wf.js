$(document).ready(function(){
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
	                $('#respon_post').html('<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Berhasil! '+data.message+'</div>');
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
	
    $("#pencarian").submit(function(e){
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
	            console.log(data);
            	$('#result').html(data.data);

	            $("#btn_update").html('<i class="fa fa-search"></i> Pencarian');
	            $("#btn_update").removeClass('disabled');          
	        }          
	   });
	    e.preventDefault();
	    e.unbind();
    });
});