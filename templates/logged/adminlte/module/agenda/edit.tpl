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
                <strong>Tanggal Mulai</strong>
            </div>
            <div class="col-md-10">
                <input style="width:200px" data-validation="required" data-validation-error-msg="Silahkan isi Tanggal" type="text" name="tgl_mulai" class="form-control datetimepicker" value="{$data.tgl_mulai}" />
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Tanggal Selesai</strong>
            </div>
            <div class="col-md-10">
                <input style="width:200px" data-validation="required" data-validation-error-msg="Silahkan isi Tanggal" type="text" name="tgl_selesai" class="form-control datetimepicker" value="{$data.tgl_selesai}" />
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Judul</strong>
            </div>
            <div class="col-md-10">
                <input data-validation="required" data-validation-error-msg="Silahkan isi Judul" name="judul" type="text" class="form-control" id="kegiatan" value="{$data.judul}" />
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Tempat</strong>
            </div>
            <div class="col-md-10">
                <textarea class="form-control" name="lokasi">{$data.lokasi}</textarea>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Keterangan</strong>
            </div>
            <div class="col-md-10">
                <textarea name="deskripsi" class="form-control editorhtml" rows="7">{$data.deskripsi}</textarea>
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