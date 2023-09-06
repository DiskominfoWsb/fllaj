<div class="box">
    <div class="box-body">
  <div class="row">

        <div class="col-md-12 text-right">
            {$navigasi} 
        </div>         
        <div class="col-md-12 table-responsive">
            <table class="table table-striped table-bordered base-style">
                <thead>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Keterangan</th>
                    <th>Info</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    {$no=1} {foreach $arr_data as $r}
                    <tr>
                        <td>{$no++}</td>
                        <td>{$r.nama_kategori}</td>
                        <td>{$r.keterangan}</td>
                        <td>Ada {$r.jumlah} Foto</td>
                        <td class="text-center">
                            <a class="btn btn-info btn-xs" href="{$basedir}giadmin/{$menu}/{$r.id_kategori}/lihat" title="Edit" >
                                <i class="fa fa-search"></i> Lihat Foto
                            </a>
                            <a class="btn btn-primary btn-xs" href="{$basedir}giadmin/{$menu}/{$r.id}/edit" title="Edit" >
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <a class="btn btn-danger btn-xs delete" data-href="{$basedir}giadmin/{$menu}/delete" data-id="{$r.id}" data-toggle="modal" data-target="#confirm-delete" title="Hapus">
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