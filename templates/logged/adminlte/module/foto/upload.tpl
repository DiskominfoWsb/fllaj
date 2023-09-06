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
                <strong>Kategori</strong>
            </div>
            <div class="col-md-10">
               <select name="id_kategori" class="form-control">
                    {foreach $data as $r}
                    <option value="{$r.id_kategori}">{$r.nama_kategori}</option>
                    {/foreach}
                </select>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Judul</strong>
            </div>
            <div class="col-md-10">
                <input data-validation="required" data-validation-error-msg="Silahkan isi Judul" name="judul" type="text" class="form-control" id="judul" />
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Foto/ Gambar</strong>
            </div>
            <div class="col-md-10">
                <input type="file" name="file[]" multiple id="file" class="form-control">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Keterangan</strong>
            </div>
            <div class="col-md-10">
                <textarea data-validation="required" data-validation-error-msg="Silahkan isi Keterangan" name="keterangan" class="form-control" id="keterangan" rows="7"></textarea>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Status</strong>
            </div>
            <div class="col-md-10">
                <select name="status" class="form-control" style="width:200px">
                    <option value="1">Publish</option>
                    <option value="0">Un Publish</option>
                </select>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-md-10 col-md-offset-2">
                <button type="submit" class="btn btn-primary" id="btn_update"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
    </form>
</div>
</div>