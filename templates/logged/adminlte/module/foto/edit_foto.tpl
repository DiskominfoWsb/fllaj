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
                <strong>Judul Album</strong>
            </div>
            <div class="col-md-10">
                <input disabled class="form-control" value="{$data.nama_kategori}" />
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Foto</strong>
            </div>
            <div class="col-md-10">
                <img src="{$basedir}files/albumfoto/{$data.namafile}" style="max-width: 300px; max-height: 300px;">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Judul Foto</strong>
            </div>
            <div class="col-md-10">
                <input class="form-control" name="judul" value="{$data.judul}" />
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Keterangan</strong>
            </div>
            <div class="col-md-10">
                <textarea name="keterangan" class="form-control">{$data.keterangan}</textarea>
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