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
					<th>Tanggal</th>
					<th>Kegiatan</th>
					<th>Anggaran (Rp)</th>
					<th>Realisasi (Rp)</th>
					<th>Aksi</th>
				</thead>
				<tbody>
					{assign var=no value=1}
					{foreach from=$arr_data item=$r}
					<tr>
						<td>{$no++}</td>
						<td>{$r.tanggal}</td>
						<td>{$r.kegiatan}</td>
						<td class="text-right">{$r.anggaran}</td>
						<td class="text-right">{$r.realisasi}</td>
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