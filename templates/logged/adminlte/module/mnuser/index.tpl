<div class="box">
    <div class="box-body">
  		<div class="row">
			<div class="col-md-12 text-right">
			    {$navigasi} 
			</div>         
			<div class="col-md-12 table-responsive">
				<table class="table table-striped table-bordered base-style">
					<thead>
						<th class="text-center">ID</th>
						<th class="text-center">Nama</th>
						<th class="text-center">Status</th>
						<th class="text-center">No. Telp</th>
						<th class="text-center">Email</th>
						<th class="text-center"></th>
						<th class="text-center">Aksi</th>
					</thead>
					<tbody>
						{assign var=no value=1}
						{foreach from=$arr_data item=$r}
						<tr>
							<td style="width:2%">{$no++}.</td>
							<td>{$r.nama_lengkap}</td>
							<td class="text-center">{$r.level_akses}</td>
							<td>{$r.no_hp}</td>
							<td>{$r.email}</td>
							<td class="text-center" id="unpublish{$r.id}">
									{if $r.status eq '1'}
									<button class="btn btn-xs btn-success publish" data-href="{$basedir}giadmin/{$menu}/publish" data-id="{$r.id}" data-menu="{$menu}" data-status="0">publish</button>
									{else}
									<button class="btn btn-xs btn-danger publish" data-href="{$basedir}giadmin/{$menu}/publish" data-id="{$r.id}" data-menu="{$menu}" data-status="1">unpublish</button>
									{/if}

							</td>
							<td class="text-center">
				                {if $r.id eq '1'}

				                {else} 
					                <a class="btn btn-primary btn-xs" href="{$basedir}giadmin/{$menu}/{$r.id}/edit" title="Edit" >
					                    <i class="fa fa-edit"></i> Edit
					                </a>
				                	<a class="btn btn-danger btn-xs delete" data-href="{$basedir}giadmin/{$menu}/delete" data-id="{$r.id}" data-toggle="modal" data-target="#confirm-delete" title="Hapus">
				                    	<i class="fa fa-times"></i> Hapus
				               		</a>
				                {/if}
			              	</td>
						</tr>
						{/foreach}
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>