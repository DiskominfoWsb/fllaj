<section class="background_bg breadcrumb_section overlay_bg_50 page-title-light fixed_bg" data-img-src="{$basedir}images/bg.jpg">
	<div class="container">
    	<div class="row align-items-center">
        	<div class="col-sm-6">
            	<div class="page-title">
            		<h1>{$judul}</h1>
                </div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-sm-end">
                    <li class="breadcrumb-item"><a href="{$basedir}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{$judul}</li>
                  </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<section style="background-color: #ffffff; background-image: url('{$basedir}images/bg/diagonal-striped-brick.png'); padding: 0;">
	<div class="container" style="background-color: #ffffff; padding-top: 50px; padding-bottom: 50px;">
		<div class="row">
        	<div class="col-lg-9">
        		{assign var=i value=1}
		        {foreach from=$arr_data item=r}
		            {if $i%3==1}
		                <div class="row justify-content-center animation" data-animation="fadeInUp" data-animation-delay="0.2s">
		            {/if}
		            <div class="col-lg-4 col-md-6 mb-4 pb-md-2">
		                <div class="blog_post blog_style5 box_shadow4">
		                    <div class="blog_img" style="height: 160px; background-image: url('{$r.gambar}'); background-repeat: no-repeat; background-size: cover;">
		                    </div>
		                    <div class="blog_content">
		                        <div class="blog_text">
		                            <h6 class="blog_title font-weight-bold"><a href="{$r.link}">{$r.judul}</a></h6>
		                            <ul class="list_none blog_meta">
		                                <li><a href="{$r.link}"><i class="fa fa-picture"></i> {$r.jml} Foto</a></li>
		                            </ul>
		                            <p>{$r.album_ket}</p>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            {if $i%3==0 or $i==$r.end}
		                </div>
		            {/if}
		            {assign var=i value=$i+1}
		        {/foreach}
    			{$pagination}
        	</div>
        	<div class="col-lg-3">
                <div class="sidebar">
                    {$right}
                </div>
        	</div>
        </div>
    </div>
</section>