<div class="card-body">
  <div class="row">

		<div class="col-md-12 text-right">
		    {$navigasi} 
		</div>         
		<div class="col-md-12 table-responsive">
			<table class="table table-striped table-bordered base-style">
				<thead>
					<th>No</th>
					<th>Judul</th>
					<th>Video URL</th>
					<th>Keterangan</th>
					<th>Tanggal Upload</th>
					<th>Status</th>
					<th>Aksi</th>
				</thead>
				<tbody>
					{assign var=no value=1}
					{foreach from=$arr_data item=$r}
					<tr>
						<td>{$no++}</td>
						<td>{$r.judul}</td>
						<td><a href="{$r.link}" target="_blank">{$r.link}</a></td>
						<td>
							{$r.keterangan}
						</td>
						<td>{$r.tanggal}</td>
						<td class="text-center" id="unpublish{$r.id}">
							{if $r.status eq '1'}
							<button class="btn btn-xs btn-success publish" data-href="{$basedir}giadmin/{$menu}/publish" data-id="{$r.id}" data-menu="{$menu}" data-status="0">publish</button>
							{else}
							<button class="btn btn-xs btn-danger publish" data-href="{$basedir}giadmin/{$menu}/publish" data-id="{$r.id}" data-menu="{$menu}" data-status="1">unpublish</button>
							{/if}
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
		</div>
	</div>
</div>