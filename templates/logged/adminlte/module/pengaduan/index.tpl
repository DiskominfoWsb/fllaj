<div class="box">
    <div class="box-body">
  <div class="row">
		<div class="col-md-12 table-responsive">
			<table class="table table-striped table-bordered base-style">
				<thead>
					<th>ID</th>
					<th>Pengaduan</th>
					<th>Status</th>
					<th class="text-center">Aksi</th>
				</thead>
				<tbody>
					{assign var=no value=1}
					{foreach from=$arr_data item=$r}
					<tr>
						<td style="width:2%">{$no++}.</td>
						<td>
							<p><strong>Kategori : </strong> {$r.urai}</p>
							<p><strong>Tanggal : </strong> {$r.tanggal}</p>
							<p><strong>Nama : </strong> {$r.nama}</p>
							<p><strong>Email : </strong> {$r.email}</p>
							<p><strong>No. Telp : </strong> {$r.hp}</p>
							<p><strong>Pesan : </strong></p> 
							<p>{$r.pesan}</p>
						</td>
                        <td class="text-center" id="unpublish{$r.id}">
                            {if $r.status eq '1'}
                            <button class="btn btn-xs btn-success publish" data-href="{$basedir}giadmin/{$menu}/publish" data-id="{$r.id}" data-menu="{$menu}" data-status="0">publish</button>
                            {else}
                            <button class="btn btn-xs btn-danger publish" data-href="{$basedir}giadmin/{$menu}/publish" data-id="{$r.id}" data-menu="{$menu}" data-status="1">unpublish</button>
                            {/if}
                        </td>
						<td class="text-center">
							{if $r.jumlah == 0}
			                <a class="btn btn-warning btn-xs" href="{$basedir}giadmin/{$menu}/{$r.id}/add" title="Edit" >
			                    <i class="fa fa-edit"></i> Belum Ada Respon
			                </a>
			                {else}
			                <a class="btn btn-success btn-xs" href="{$basedir}giadmin/{$menu}/{$r.id}/edit" title="Edit" >
			                    <i class="fa fa-edit"></i> Sudah Direspon
			                </a>
			                {/if}
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