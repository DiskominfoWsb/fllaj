<div class="box">
    <div class="box-body">
  <div class="row">

        <div class="col-md-12 text-right">
            {$navigasi} 
        </div>         
        <div class="col-md-12 table-responsive">
            <table class="table table-striped table-bordered base-style">
                <thead>
                    <th style="width: 15px">No</th>
                    <th>Foto</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    {$no=1} {foreach $arr_data as $r}
                    <tr>
                        <td>{$no++}</td>
                        <td>
                            <img src="{$basedir}files/albumfoto/{$r.namafile}" style="max-width: 300px">
                        </td>
                        <td>Judul : <b>{$r.judul}</b><br>Ket : {$r.keterangan}</td>
                        <td class="text-center" id="unpublish{$r.id}">
                            {if $r.status eq '1'}
                            <button class="btn btn-xs btn-success publish" data-href="{$basedir}giadmin/{$menu}/publish" data-id="{$r.id}" data-menu="{$menu}" data-status="0">publish</button>
                            {else}
                            <button class="btn btn-xs btn-danger publish" data-href="{$basedir}giadmin/{$menu}/publish" data-id="{$r.id}" data-menu="{$menu}" data-status="1">unpublish</button>
                            {/if}
                        </td>
                        <td class="text-center">
                            <a class="btn btn-primary btn-xs" href="{$basedir}giadmin/{$menu}/{$r.id}/edit_foto" title="Edit" >
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <a class="btn btn-danger btn-xs delete" data-href="{$basedir}giadmin/{$menu}/delete_foto" data-id="{$r.id}" data-toggle="modal" data-target="#confirm-delete" title="Hapus">
                                <i class="fa fa-times"></i> Hapus
                            </a>
                        </td>
                    </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>