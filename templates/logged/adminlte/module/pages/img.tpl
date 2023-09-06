<div class="box">
    <div class="box-body">
	    <form id="multiform_add" method="POST" enctype="multipart/form-data">
	    	<div class="row form-group">
	    		<div class="col-md-2">
	    			<label>Gambar / File</label>
	    		</div>
	    		<div class="col-md-10">
	    			<input type="file" name="gambar[]" multiple class="form-control">
	    		</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-10 col-md-offset-2">
	                <button class="btn btn-primary" id="btn_update"><i class="fa fa-save"></i> Simpan</button>
	            </div>
	    	</div>
	    </form>
    </div>
</div>
<div class="box">
    <div class="box-body">
    	{foreach $arr_data as $r}
    		{if $r.no % 6 == 1}
    			<div class="row form-group">
    		{/if}
    		<div class="col-md-2">
    			{if $r.is_img == 'image'}
    				<div style="background-color: #ccc; height: 100px; width: 100%;">
					    <center>
					    	<div class="text-center" style="background-color: #ccc; height: 100px; width: 100%; display:table-cell; vertical-align:middle; text-align:center;">
					    		<img src="{$r.file}" onclick="preview('{$r.is_img}', '{$r.file}')" style="max-height: 100px; max-width: 100%; cursor: pointer;">
					    	</div>
					    </center>
				    </div>
    			{else}
    				<div style="background-color: #ccc; height: 100px; width: 100%;" >
					    <center>
					    	{if $r.is_img == 'pdf'}
					    	<div class="text-center" style="background-color: #ccc; height: 100px; width: 100%; display:table-cell; vertical-align:middle; text-align:center; cursor: pointer;" onclick="preview('{$r.is_img}','{$r.file}')">
					    		<big class="fa fa-file"></big><br>
					    		<b>{$r.nama}</b>
					    	</div>
					    	{else}
					    	<div class="text-center" style="background-color: #ccc; height: 100px; width: 100%; display:table-cell; vertical-align:middle; text-align:center; cursor: pointer;">
					    		<a href="{$r.file}" download target="_blank">
					    			<big class="fa fa-file"></big><br>
					    			<b>{$r.nama}</b>
					    		</a>
					    	</div>
					    	{/if}
					    </center>
				    </div>
    			{/if}
			    <a class="btn btn-danger btn-xs delete btn-block" data-href="{$basedir}giadmin/{$menu}/delete" data-id="{$r.nama}" data-toggle="modal" data-target="#confirm-delete" title="Hapus">
                	<i class="fa fa-times"></i> Hapus
           		</a>
    		</div>
    		{if $r.no % 6 == 0 and $r.no == $r.end}
    			</div>
    		{/if}
    	{/foreach}
    </div>
</div>

<div class="modal fade bd-example-modal-md" id="preview_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <!-- <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5> -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          </div>
          <!-- <div class="modal-footer">
            <button type="button" class="btn btn-black" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-default">Save changes</button>
          </div> -->
        </div>
      </div>
    </div>
<script type="text/javascript">
    function preview(is_img ,img) {
    	if (is_img == 'image') {
        	$('#preview_modal').find('.modal-body').html('<img style="width: 100%;" src="'+img+'">');
    	}else{
        	$('#preview_modal').find('.modal-body').html('<iframe style="width: 100%; height: 70vh;" src="'+img+'">');
    	}
        $('#preview_modal').modal('show');
    }
</script>