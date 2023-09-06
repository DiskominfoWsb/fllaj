<div class="box">
    <div class="box-body">
<div class="row">
    <div class="col-md-12 text-right">
    {$navigasi}
</div>                
<div class="col-md-12">
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
                <strong>Kategori</strong>
            </div>
            <div class="col-md-10">
                <select name="kategori" class="form-control">
                    <option>Pilih Kategori Berita</option>
                    {$kategori}
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
                <strong>Isi</strong>
            </div>
            <div class="col-md-10">
                <textarea id="isi" name="isi" class="editor"></textarea>
            </div>
        </div>
        <hr>
        {for $foor=1 to 3}
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Gambar</strong>
            </div>
            <div class="col-md-10">
                <input type="file" name="gambar_pertama[]" id="gambar_pertama">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Caption</strong>
            </div>
            <div class="col-md-10">
                <textarea name="caption[]" class="form-control" placeholder="Berikan lah catatan untuk masing-masing gambar yang anda upload ;-)"></textarea>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2"></div>
            <div class="col-md-1 col-xs-6">
                <strong>Setelah Paragraf Ke : </strong>
            </div>
            <div class="col-md-1 col-xs-6">
                <input type="number" class="form-control" name="paragraf[]" value="0">
            </div>
        </div>
        {/for}
        
        <hr>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Berita Video (Optional)</strong>
            </div>
            <div class="col-md-10">
                <input type="text" name="video" class="form-control" placeholder="https://www.youtube.com/watch?v=6HxIr0aKvcI">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2"></div>
            <div class="col-md-1 col-xs-6">
                <strong>Setelah Paragraf Ke : </strong>
            </div>
            <div class="col-md-1 col-xs-6">
                <input type="number" class="form-control" name="paragraf_video" value="0">
            </div>
        </div>
        
        <div class="row form-group">
            <div class="col-md-10 col-md-offset-2">
                <button class="btn btn-primary" id="btn_update"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
    </form>
</div>
</div></div></div>