<div class="box">
    <div class="box-body">
    <div class="row">
        <div class="col-md-12 text-right">
            {$navigasi} 
        </div>         
    </div>
    <form id="multiform_add" method="POST" enctype="multipart/form-data">
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Judul</strong>
            </div>
            <div class="col-md-10">
                <input data-validation="required" data-validation-error-msg="Silahkan isi Judul" name="judul" value="{$data.judul}" type="text" class="form-control" id="judul" />
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