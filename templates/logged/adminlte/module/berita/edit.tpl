<div class="box">
    <div class="box-body">
<div class="row">
    <div class="col-md-12 text-right">
    {$navigasi}
</div>                
<div class="col-md-12">
    <form id="multiform_add" method="POST" enctype="multipart/form-data">
        {$catatanadmin}
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Tanggal Kegiatan</strong>
            </div>
            <div class="col-md-10">
                <input style="width:200px" data-validation="required" data-validation-error-msg="Silahkan isi Tanggal" type="text" name="tanggal" value="{$data.tanggal}" class="form-control datetimepicker" />
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
                <input data-validation="required" data-validation-error-msg="Silahkan isi Judul" name="judul" type="text" class="form-control" id="judul" value="{$data.judul}" />
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Isi</strong>
            </div>
            <div class="col-md-10">
                <textarea id="isi" name="isi" class="editor">{$data.isi}</textarea>
            </div>
        </div>
        <hr>
        {assign var=foo value="|"|explode:$data.gambar}
        {assign var=foo2 value="|"|explode:$data.caption}
        {assign var=foo3 value="|"|explode:$data.paragraf}
        {for $foor=0 to 2}
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Gambar</strong>
            </div>
            <div class="col-md-10">
                <input type="file" class="form-control" name="gambar_pertama[{$foor}]" id="gambar_pertama">
                {if $foo|@count gt $foor}
                <img src="{$basedir}files/berita/{$foo[$foor]}" style="max-width: 100px;">
                <br>
                {/if}
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Caption</strong>
            </div>
            <div class="col-md-10">
                {if $foo2|@count gt $foor}
                        
                {else}
                    {$foo2[$foor] = ''}
                {/if}
                <textarea name="caption[{$foor}]" class="form-control">{$foo2[$foor]}</textarea>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2"></div>
            <div class="col-md-1 col-xs-6">
                <strong>Stlh Paragraf Ke : </strong>
            </div>
            <div class="col-md-1 col-xs-6">
                <input type="number" class="form-control" name="paragraf[]" value="{$foo3[$foor]}">
            </div>
        </div>
        {/for}
        <hr>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Berita Video (Optional)</strong>
            </div>
            <div class="col-md-10">
                <input type="text" name="video" class="form-control" placeholder="https://www.youtube.com/watch?v=6HxIr0aKvcI" value="{$data.video}">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2"></div>
            <div class="col-md-1 col-xs-6">
                <strong>Setelah Paragraf Ke : </strong>
            </div>
            <div class="col-md-1 col-xs-6">
                <input type="number" class="form-control" name="paragraf_video" value="{$data.paragraf_video}">
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