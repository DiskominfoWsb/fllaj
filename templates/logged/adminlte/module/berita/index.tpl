<div class="box">
    <div class="box-body">
  <div class="row">

		<div class="col-md-12 text-right">
		    {$navigasi} 
		</div>         
		<div class="col-md-12 table-responsive">
			<table class="table table-striped table-bordered">
				<thead>
					<th>ID</th>
					<th>Judul</th>
					<th>Tanggal</th>
					<th>Kategori</th>
					<th>Kontributor</th>
					<th>Status</th>
					<th>Catatan</th>
					<th class="text-center">Aksi</th>
				</thead>
				<tbody>
					{assign var=no value=1}
					{foreach from=$arr_data item=$r}
					<tr>
						<td style="width:2%">{$no++}.</td>
						<td>{$r.judul}</td>
						<td>{$r.tanggal}</td>
						<td>{$r.kategori}</td>
						<td>{$r.kontributor}</td>
						<td class="text-center" id="unpublish{$r.id}">
							{if $akses}
								{if $r.status eq '1'}
								<button class="btn btn-xs btn-success publish" data-href="{$basedir}giadmin/{$menu}/publish" data-id="{$r.id}" data-menu="{$menu}" data-status="0">publish</button>
								{else}
								<button class="btn btn-xs btn-danger publish" data-href="{$basedir}giadmin/{$menu}/publish" data-id="{$r.id}" data-menu="{$menu}" data-status="1">unpublish</button>
								{/if}
							{else}
								{if $r.status eq '1'}
								<button class="btn btn-xs btn-success">publish</button>
								{else}
								<button class="btn btn-xs btn-danger">unpublish</button>
								{/if}
							{/if}

						</td>
						<td class="text-center">
							{$r.catatan}
						</td>
						<td class="text-center">
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
			{$pagination}
		</div>
	</div>
</div>
</div>