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
    {if $i%2==1}
    	<div class="row">
    {/if}
		<div class="col-md-6">
			<figure class="card card-img-top border-grey border-lighten-2" itemprop="associatedMedia" itemscope itemtype="//schema.org/ImageObject">
				<iframe width="100%" src="{$r.link}" frameborder="0" allowfullscreen></iframe>
				<b>{$r.judul}</b>
				<p>{$r.keterangan}</p>
			</figure>
		</div>
    {if $i%2==0 or $i==$r.end}
        </div>
    {/if}
    {assign var=i value=$i+1}
{/foreach}
    			{$pagination}

							</div>
						</div>
					</div>
				</div>
        <div class="col-md-4">{$right}</div>
        
			</div>
		</div>
	</div>
</div>