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
                <strong>Tanggal Kegiatan</strong>
            </div>
            <div class="col-md-10">
                <input style="width:200px" data-validation="required" data-validation-error-msg="Silahkan isi Tanggal" type="text" name="tanggal" class="form-control datetimepicker" />
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Kegiatan</strong>
            </div>
            <div class="col-md-10">
                <input data-validation="required" data-validation-error-msg="Silahkan isi Kegiatan" name="kegiatan" type="text" class="form-control" id="kegiatan" />
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Anggaran</strong>
            </div>
            <div class="col-md-10">
                <input type="number" name="anggaran" class="form-control">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Realisasi</strong>
            </div>
            <div class="col-md-10">
                <input type="number" name="realisasi" class="form-control">
            </div>
        </div>
        <div class="row form-group">
            {for $foo=0 to 11}
                <div class="col-md-2">
                    <strong>{$bln[$foo]}</strong>
                </div>
                <div class="col-md-2">
                    <input type="number" name="data[{$foo}]" class="form-control" value="0">
                </div>
            {/for}
        </div>

        <div class="row form-group">
            <div class="col-md-10 col-md-offset-2">
                <button class="btn btn-primary" id="btn_update"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
    </form>
</div>
</div>