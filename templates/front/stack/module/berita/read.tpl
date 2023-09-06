<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.10';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="app-content container center-layout mt-2">
    <div class="content-wrapper">

      	<div class="content-header row">
        	<div class="content-header-left col-md-6 col-12 mb-2">
          		<h3 class="content-header-title mb-0">{$data.judul}</h3>
          		<div class="row breadcrumbs-top">
            		<div class="breadcrumb-wrapper col-12">
              			<ol class="breadcrumb">
			                <li class="breadcrumb-item"><a href="{$basedir}">Home</a></li>
			                <li class="breadcrumb-item"><a href="{$basedir}berita">Berita</a></li>
			                <li class="breadcrumb-item">{$data.judul}</li>
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
				        	<h4 class="card-title">{$data.judul}</h4>
				        </div>
				        <div class="card-content">
				          	<div class="card-body">
				          		<ul class="list-inline">
	                                <li class="list-inline-item"><i class="fa fa-user"></i> {$data.kontributor}</li>
	                                <li class="list-inline-item"><i class="fa fa-clock-o"></i> {$tanggal}</li>
	                                <li class="list-inline-item"><i class="fa fa-eye"></i> {$data.baca}</li>
	                            </ul>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="">
    <div class="carousel-inner" role="listbox">
    	{$not = 0}
        {foreach $gambarslider as $gm}
        	<div class="carousel-item {if $not == 0}active{/if}">
            	<img src="{$basedir}files/berita/{$gm}" style="width: 100%;">
                {if $captionslider[$not]} 
                <div class="carousel-caption">
	                <p>{$captionslider[$not]}</p>
	            </div>
                {/if}
            </div>
            {assign "not" $not+1}
        {/foreach}
    </div>
</div>
{$isi}
<div class="addthis_inline_share_toolbox addthis_toolbox" addthis:url="{$url}" addthis:title="{$data.judul}" addthis:description="{$data.judul}" addthis:media="{$basedir}files/berita/thumb_{$gambarutama}">
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ad95b73df13275d"></script> 
</div>
<hr>
<div class="row">
    {$berita_lain}
</div>
<hr>
<div id="disqus_thread"></div>  
				          	</div>
				        </div>
				    </div>
				</div>
				<div class="col-md-4">{$right}</div>
			</div>
		</div>

  	</div>
</div>