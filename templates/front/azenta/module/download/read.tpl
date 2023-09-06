<div class="row">
    <div class="col-lg-12">
        <h3 class="section-heading"><legend>PENGUMUMAN</legend></h3>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        {foreach $arr_data as $r}
        <h5>{$r.judul}</h5>
        <small><strong>Tanggal Upload : </strong>{$r.tanggal}</small>
        <div class="col-md-12 col-sm-12 col-xs-12" style="margin:0px;padding:0px">{$r.isi}</div><br>
        {if $r.cek}
        <a href="{$basedir}files/pengumuman/{$r.namafile}" class="btn btn-primary"><i class="fa fa-download"></i> Download File</a> {/if} {/foreach}
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <hr>
        <h4 style="color:#990000">BACA PENGUMUMAN LAINNYA:</h4> {foreach $berita_lain as $d} {$d.konten} {/foreach}
    </div>
</div>