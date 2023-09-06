<div class="app-content container center-layout mt-2">
    <div class="content-wrapper">

      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">{$judul}</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{$basedir}">Home</a>
                </li>
                <li class="breadcrumb-item">{$judul}
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>  

      	<div class="content-body">
			<div class="row">
				<div class="col-md-8">
					<div class="card">
				        <div class="card-header">
				        	<h4 class="card-title">{$judul}</h4>
				        </div>
				        <div class="card-content">
				          	<div class="card-body">
{assign var=i value=1}
{foreach from=$arr_data item=r}
    {if $i%3==1}
      <div class="row">
    {/if}
    <div class="col-md-4">
      <figure class="card card-img-top border-grey border-lighten-2" itemprop="associatedMedia" itemscope itemtype="//schema.org/ImageObject">
        <div class="gallery-thumbnail card-img-top" itemprop="thumbnail" style="width: 100%; height: 120px;">
            <embed src="{$basedir}files/bankdata/{$r.namafile}" style="width: 100%; height: 120px;" type="application/pdf">
        </div>
        <b>{$r.judul}</b>
        {$r.keterangan}
        <a href="{$basedir}files/bankdata/{$r.namafile}" class="btn btn-sm btn-primary btn-block" download>Download</a>
      </figure>
    </div>
    {if $i%3==0 or $i==$r.end}
        </div>
    {/if}
    {assign var=i value=$i+1}
{/foreach}
          
							</div>
						</div>
					</div>
				</div>
        <div class="col-md-4">{$right}</div>
        
			</div>
		</div>
	</div>
</div>