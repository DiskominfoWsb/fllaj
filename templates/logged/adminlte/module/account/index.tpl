<div class="box">
    <div class="box-body">
    <form id="multiform_add" method="POST" enctype="multipart/form-data">
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Nama Lengkap</strong>
            </div>
            <div class="col-md-10">
                <input type="text" name="nama_lengkap" value="{$nama_lengkap}" class="form-control" />
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>No. Telepon</strong>
            </div>
            <div class="col-md-10">
                <input type="text" name="no_hp" value="{$no_hp}" class="form-control" />
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Email</strong>
            </div>
            <div class="col-md-10">
                <input type="text" name="email" value="{$email}" class="form-control" />
            </div>
        </div>

        

        <div class="row form-group">
            <div class="col-md-2">
                <strong>Foto</strong>
            </div>
            <div class="col-md-10">
                <input type="file" name="foto[]" class="form-control" />
                <img src="{$foto}" style="max-height: 175px; height: 175px; box-shadow: 2px 2px 10px;">
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