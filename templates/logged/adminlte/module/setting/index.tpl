<div class="box">
    <div class="box-body">
    <form id="multiform_add" method="POST" enctype="multipart/form-data">
	    <div class="row form-group">
	        <div class="col-md-2">
	            <strong>Client</strong>
	        </div>
	        <div class="col-md-10">
	            <input class="form-control" type="text" name="nama_pemda" id="nama_pemda" value="{$nama_pemda}" maxlength="200" />
	        </div>
	    </div>

	    <div class="row form-group">
	        <div class="col-md-2">
	            <strong>Nama Aplikasi Web</strong>
	        </div>
	        <div class="col-md-10">
	            <input class="form-control" type="text" name="nama_app" id="nama_app" value="{$nama_app}" maxlength="200" />
	        </div>
	    </div>
	    
	    <div class="row form-group">
	        <div class="col-md-2">
	            <strong>Nama Singkap Aplikasi Web</strong>
	        </div>
	        <div class="col-md-10">
	            <input class="form-control" type="text" name="nama_app_singkat" id="nama_app_singkat" value="{$nama_app_singkat}" maxlength="200" />
	        </div>
	    </div>
	    
	    <div class="row form-group">
	        <div class="col-md-2">
	            <strong>Alamat</strong>
	        </div>
	        <div class="col-md-10">
	            <textarea class="form-control" name="alamat">{$alamat}</textarea>
	        </div>
	    </div>
	    
	    <div class="row form-group">
	        <div class="col-md-2">
	            <strong>Telp.</strong>
	        </div>
	        <div class="col-md-10">
	            <input class="form-control" type="text" name="telp" id="telp" value="{$telp}" maxlength="200" />
	        </div>
	    </div>
	    
	    <div class="row form-group">
	        <div class="col-md-2">
	            <strong>Email</strong>
	        </div>
	        <div class="col-md-10">
	            <input class="form-control" type="text" name="email" id="email" value="{$email}" maxlength="200" />
	        </div>
	    </div>
	    
	    <div class="row form-group">
	        <div class="col-md-2">
	            <strong>Facebook</strong>
	        </div>
	        <div class="col-md-10">
	            <input class="form-control" type="text" name="facebook" id="facebook" value="{$facebook}" maxlength="200" />
	        </div>
	    </div>
	    
	    <div class="row form-group">
	        <div class="col-md-2">
	            <strong>Twitter</strong>
	        </div>
	        <div class="col-md-10">
	            <input class="form-control" type="text" name="twitter" id="twitter" value="{$twitter}" maxlength="200" />
	        </div>
	    </div>
	    
	    <div class="row form-group">
	        <div class="col-md-2">
	            <strong>Instagram</strong>
	        </div>
	        <div class="col-md-10">
	            <input class="form-control" type="text" name="instagram" id="instagram" value="{$instagram}" maxlength="200" />
	        </div>
	    </div>
	    <div class="row form-group">
	        <div class="col-md-2">
	            <strong>Youtube</strong>
	        </div>
	        <div class="col-md-10">
	            <input class="form-control" type="text" name="youtube" id="youtube" value="{$youtube}" maxlength="200" />
	        </div>
	    </div>
	    <div class="row form-group" hidden>
	        <div class="col-md-2">
	            <strong>Whatsapp</strong>
	        </div>
	        <div class="col-md-10">
	            <input type="text" multiple class="form-control bootstrap-tagsinput" name="wa[]" value="{$wa}">
	        </div>
	    </div>
	    <div class="row form-group" >
	        <div class="col-md-2" hidden>
	            <strong>Kepala Sekolah</strong>
	        </div>
	        <div class="col-md-4" hidden>
	            <input class="form-control" type="text" name="nama_kdh" id="nama_kdh" value="{$nama_kdh}" maxlength="200" />
	            <img src="{$basedir}files/setting/{$foto_kdh}" style="width: 200px;">
	            <input type="file" name="foto_kdh[]" class="form-control">
	        </div>
	        <div class="col-md-2">
	            <strong>Logo</strong>
	        </div>
	        <div class="col-md-4">
	            <img src="{$basedir}files/setting/{$gambar}" style="max-height: 175px; box-shadow: 2px 2px 10px;">
	            <input type="file" name="gambar[]" class="form-control">
	        </div>
	    </div>
	    <div class="row form-group" hidden>
	        <div class="col-md-2" hidden>
	            <strong>Wakil Bupati</strong>
	        </div>
	        <div class="col-md-4" hidden>
	            <input class="form-control" type="text" name="nama_wa_kdh" id="nama_wa_kdh" value="{$nama_wa_kdh}" maxlength="200" />
	            <img src="{$basedir}files/setting/{$foto_wa_kdh}" style="width: 200px;">
	            <input type="file" name="foto_wa_kdh[]" class="form-control">
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