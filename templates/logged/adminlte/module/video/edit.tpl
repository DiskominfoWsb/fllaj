<div class="card-body">
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
                <input data-validation="required" data-validation-error-msg="Silahkan isi Judul" name="judul" type="text" class="form-control" id="judul" value="{$data.judul}" />
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Video URL</strong>
            </div>
            <div class="col-md-10">
                <input data-validation="required" data-validation-error-msg="Silahkan isi URL" name="link" type="text" class="form-control" id="link" value="{$data.link}" />
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Keterangan</strong>
            </div>
            <div class="col-md-10">
                <textarea data-validation="required" data-validation-error-msg="Silahkan isi Keterangan" name="keterangan" class="form-control editor" id="keterangan" rows="7">{$data.keterangan}</textarea>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Status</strong>
            </div>
            <div class="col-md-10">
                <select name="status" class="form-control" style="width:200px">
                    <option value="1" {if $data.status eq '1'} selected {/if}>Publish</option>
                        <option value="0" {if $data.status eq '0'} selected {/if}>Un Publish</option>
                </select>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-md-10 col-md-offset-2">
                <button class="btn btn-primary" id="btn_update"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
    </form>
</div>