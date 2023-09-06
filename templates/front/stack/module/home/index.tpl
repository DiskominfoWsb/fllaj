<section id="basic-carousel">
    <div class="row">
 	    <div class="col-md-12">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					{assign var=i value=0}
					{foreach from=$banner item=r}
					<li data-target="#carousel-example-generic" data-slide-to="{$i}" class="{if $i == 0}active{/if}"></li>
				    {assign var=i value=$i+1}
					{/foreach}
				</ol>
                <div class="carousel-inner" role="listbox">
                	{assign var=i value=0}
					{foreach from=$banner item=r}
                    <div class="carousel-item {if $i == 0}active{/if}">
                      	<img src="{$basedir}files/rotator/{$r.gambar}" style="width: 100%;">
                    </div>
				    {assign var=i value=$i+1}
					{/foreach}
                </div>
				<a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
				</a>
            </div>
        </div>
    </div>
</section>

<div class="app-content container center-layout mt-2">
    <div class="content-wrapper">      
      	<div class="content-body">
      		<div class="row">
      			<div class="col-md-12">
      				<div class="card">
		                <div class="card-content">
		                  	<div class="card-body">
		                  		
		                  	</div>
		                </div>
		            </div>
      			</div>
      		</div>
      		<div class="row">
      			<div class="col-md-8">
      				<div class="card">
		                <div class="card-header">
		                	<h4 class="card-title">Berita</h4>
		                </div>
		                <div class="card-content">
		                  	<div class="card-body">
{assign var=i value=1}
{foreach from=$berita item=r}
    {if $i%3==1}
    	<div class="row">
    {/if}
		<div class="col-md-4">
			<figure class="card card-img-top border-grey border-lighten-2" itemprop="associatedMedia" itemscope itemtype="//schema.org/ImageObject">
				<a href="{$r.link}" itemprop="contentUrl">
					<div class="gallery-thumbnail card-img-top" itemprop="thumbnail" style="width: 100%; height: 120px; background-image: url('{$r.gambar}'); background-size: cover; background-position: center;"></div>
				</a>
				<b><a href="{$r.link}">{$r.judul}</a></b>
				<p>
					<small>
						<i class="fa fa-calendar"></i> {$r.tanggal} | <i class="fa fa-eye"></i> {$r.baca} 
					</small>
				</p>
				<p class="card-text">{$r.isi} ...</p>
			</figure>
		</div>
    {if $i%3==0 or $i==$r.end}
        </div>
    {/if}
    {assign var=i value=$i+1}
{/foreach}
								<div class="row">    
									<div class="col-md-12 text-right">
										<a href="{$basedir}berita">Berita lainnya <i class="fa fa-chevron-circle-right"></i></a>
									</div>
								</div>
		                  	</div>
		                </div>
		            </div>
		            <div class="card">
		                <div class="card-header">
		                	<h4 class="card-title">Video</h4>
		                </div>
		                <div class="card-content">
		                  	<div class="card-body text-center">
		                  		<div class="row text-center">
{foreach from=$video item=r}
	<div class="col-md-4">
        <div class="blog_post blog_style5 box_shadow4">
            <div class="blog_img">
            	<iframe width="100%" src="{$r.link}" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
{/foreach}
								</div>
		                  	</div>
		                </div>
		            </div>
      			</div>
      			<div class="col-md-4">
      				<div class="card">
		                <div class="card-header">
		                	<h4 class="card-title">Agenda</h4>
		                </div>
		                <div class="card-content">
		                  	<div class="card-body">
		                  		<table style="width: 100%;">
									{assign var=i value=1}
		                  			{foreach $agenda as $r}
		                  			<tr>
		                  				<td style="vertical-align: top;">{$i}.</td>
		                  				<td style="vertical-align: top;">
		                  					{$r.judul} <br>
		                  					<small><i class="fa fa-calendar"></i> {$r.tanggal}</small>

		                  				</td>
		                  			</tr>
    								{assign var=i value=$i+1}
		                  			{/foreach}
		                  			<tr>
		                  				<td colspan="2" class="text-right">
		                  					<a href="{$basedir}agenda">Agenda Lainnya <i class="fa fa-chevron-circle-right"></i></a>
		                  				</td>
		                  			</tr>
		                  		</table>
		                  	</div>
		                </div>
		            </div>
      				<div class="card">
		                <div class="card-header">
		                	<h4 class="card-title">Bank Data</h4>
		                </div>
		                <div class="card-content">
		                  	<div class="card-body">
		                  		<table style="width: 100%;">
									{assign var=i value=1}
		                  			{foreach $bankdata as $r}
		                  			<tr>
		                  				<td style="vertical-align: top;">{$i}.</td>
		                  				<td style="vertical-align: top;">{$r.judul}</td>
		                  				<td style="vertical-align: top;" class="text-right">
		                  					<a href="{$basedir}files/bankdata/{$r.namafile}"><i class="fa fa-download"></i></a>
		                  				</td>
		                  			</tr>
    								{assign var=i value=$i+1}
		                  			{/foreach}
		                  			<tr>
		                  				<td colspan="3" class="text-right">
		                  					<a href="{$basedir}bankdata">Selengkapnya <i class="fa fa-chevron-circle-right"></i></a>
		                  				</td>
		                  			</tr>
		                  		</table>
		                  	</div>
		                </div>
		            </div>
		            <div class="card">
		                <div class="card-content">
		                  	<div class="card-body">
		                  		<ul class="list-inline">
								{foreach $tag as $r}
									<li class="list-inline-item">
										<a href="{$basedir}kategori/{$r.id_kategori}/{$r.seo}" style="border: 1px solid #009c9f; padding: 5px; border-radius: 50px;">{$r.nama_kategori} ({$r.jml})</a>
									</li>
			                    {/foreach}
			                    </ul>
		                  	</div>
	                  	</div>
	              	</div>
		            <!-- <script type="text/javascript" src=https://widget.kominfo.go.id/gpr-widget-kominfo.min.js></script>
					<div id="gpr-kominfo-widget-container"></div> -->
      			</div>
      		</div>
      		<div class="row">
      			<div class="col-md-12">
      				<div class="card">
		                <div class="card-header">
		                	<h4 class="card-title">Link Tautan</h4>
		                </div>
		                <div class="card-content">
		                  	<div class="card-body">
{assign var=i value=1}
{foreach from=$weblink item=r}
    {if $i%6==1}
    	<div class="row">
    {/if}
		<div class="col-md-2 text-center">
			<div style="width: 100%; height: 100px; vertical-align: middle; padding: auto;">
				<img src="{$basedir}files/weblink/{$r.gambar}" style="max-width: 100%; max-height: 100px; margin: auto;">
			</div>
			<b><a href="{$r.link}">{$r.judul}</a></b>
		</div>
    {if $i%6==0 or $i==$weblink|@count}
        </div>
    {/if}
    {assign var=i value=$i+1}
{/foreach}
		                  	</div>
		                </div>
		            </div>
      			</div>
      		</div>
	    </div>
	</div>
</div>