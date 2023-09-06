<div class="box">
    <div class="box-body">
  <div class="row">
        <div class="col-md-12 text-right">
            {$navigasi} 
        </div>         
        <div class="col-md-12 table-responsive">
            <table class="table table-hover table-bordered base-style">
				<thead>
					<th>Banner</th>
					<th>Status</th>
					<th>Aksi</th>
				</thead>
				<tbody>
					{$no=1}
					{foreach $arr_data as $r}
					<tr>
						<td class="text-center">
							<img src="{$r.gambar}" width="700px">
						</td>
						<td class="text-center" id="unpublish{$r.id}">
		                    {if $r.status eq '1'}
		                    <button class="btn btn-xs btn-success publish" data-href="{$basedir}giadmin/{$menu}/publish" data-id="{$r.id}" data-menu="{$menu}" data-status="0">publish</button>
		                    {else}
		                    <button class="btn btn-xs btn-danger publish" data-href="{$basedir}giadmin/{$menu}/publish" data-id="{$r.id}" data-menu="{$menu}" data-status="1">unpublish</button>
		                    {/if}
		                </td>
		                <td class="text-center">
		                    
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