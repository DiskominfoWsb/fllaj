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
      					<a href="{$basedir}download">Selengkapnya <i class="fa fa-chevron-circle-right"></i></a>
      				</td>
      			</tr>
      		</table>
      	</div>
    </div>
</div>
<div class="card">
    <div class="card-header">
    	<h4 class="card-title">Trending News</h4>
    </div>
    <div class="card-content">
      	<div class="card-body">
      		{foreach $trending as $r}
            <div class="row">
                <div class="col-md-12">
                    <img src="{$r.gambar}" alt="{$r.judul}" style="width: 60px; float: left; margin-right: 7.5px;" />
                    <p class="small m-0">{$r.tanggal}</p>
                    <p><a href="{$r.link}">{$r.judul}</a></p>
                </div>
            </div>
            {/foreach}
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

<div class="card">
	<div class="card-header">
    	<h4 class="card-title">Video</h4>
    </div>
    <div class="card-content">
      	<div class="card-body">
      		<div class="row">
{foreach from=$video item=r}
	<div class="col-md-12">
        <div class="blog_post blog_style5 box_shadow4">
            <div class="blog_img">
            	<iframe width="100%" src="{$r.link}" frameborder="0" allowfullscreen></iframe>
            	<b>{$r.judul}</b>
				<p>{$r.keterangan}</p>
            </div>
        </div>
    </div>
{/foreach}
			</div>
      	</div>
  	</div>
</div>
