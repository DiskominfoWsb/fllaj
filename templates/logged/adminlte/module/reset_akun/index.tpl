<div class="box">
    <div class="box-body">
  		<div class="row"><!-- 
			<div class="col-md-12 text-right">
			    {$navigasi} 
			</div>          -->
			<div class="col-md-12 table-responsive">
				<table class="table table-striped table-bordered base-style">
					<thead>
						<th class="text-center">No.</th>
						<th class="text-center">Nama</th>
						<th class="text-center">Daerah Asal</th>
						<th class="text-center">Jabatan</th>
						<th class="text-center">No. Telp</th>
						<th class="text-center">Lampiran</th>
						<th class="text-center"></th>
						<th class="text-center">Aksi</th>
					</thead>
					<tbody>
						{assign var=no value=1}
						{foreach from=$arr_data item=$r}
						<tr>
							<td class="text-center" style="width:2%">{$no++}.</td>
							<td>{$r.nama}</td>
							<td>{$r.daerah_asal}</td>
							<td>{$r.jabatan}</td>
							<td class="text-center">{$r.telp}</td>>
							<td>{$r.lampiran}</td>

							<td class="text-center" id="unpublish{$r.id}">
								{if $r.status eq '0'}
									<label class="label label-default"> Menunggu </label>
								{elseif $r.status eq '1'}
									<label class="label label-warning"> Diproses </label>
								{elseif $r.status eq 'Y'}
									<label class="label label-danger"> Diterima </label>
								{elseif $r.status eq 'N'}
									<label class="label label-success"> Ditolak </label>
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
</div>