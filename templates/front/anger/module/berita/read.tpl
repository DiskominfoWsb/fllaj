<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.10';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<section class="background_bg breadcrumb_section overlay_bg_50 page-title-light fixed_bg" data-img-src="{$basedir}images/bg.jpg">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-sm-12">
                <div class="page-title">
                    <h1>{$data.judul}</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section style="background-color: #ffffff; background-image: url('{$basedir}images/bg/diagonal-striped-brick.png'); padding: 0;">
    <div class="container" style="background-color: #ffffff; padding-top: 50px; padding-bottom: 50px;">
        <div class="row">
            <div class="col-lg-9">
                <div class="single_post">
                    <div id="carouselExampleControls" class="banner_content_wrap carousel slide light_arrow3" data-ride="carousel">
                        <div class="carousel-inner">
                            {$not = 0}
                            {foreach $gambarslider as $gm}
                            <div class="carousel-item {if $not==0}active{/if} background_bg" data-img-src="{$basedir}files/berita/{$gm}" style="padding: 400px 0 0 0 !important;">
                                {if $captionslider[$not]} 
                                <div class="banner_slide_content">
                                    <div class="container"><!-- STRART CONTAINER -->
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="banner_content4 text_white">
                                                    <p class="animation my-4" data-animation="fadeInLeft" data-animation-delay="1.5s">{$captionslider[$not]}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- END CONTAINER-->
                                </div>
                                {/if}
                            </div>
                            {assign "not" $not+1}
                            {/foreach}
                        </div>
                    </div>
                    <div class="blog_content bg-white">
                        <div class="blog_text">
                            <ul class="list_none blog_meta">
                                <li><a href="#"><i class="fa fa-user"></i> {$data.kontributor}</a></li>
                                <li><a href="#"><i class="fa fa-clock-o"></i> {$tanggal}</a></li>
                                <li><a href="#"><i class="fa fa-eye"></i> {$data.baca}</a></li>
                            </ul>
                            <h2>{$data.judul}</h2>
                            {$isi}
                            <div class="addthis_inline_share_toolbox addthis_toolbox" addthis:url="{$url}" addthis:title="{$data.judul}" addthis:description="{$data.judul}" addthis:media="{$basedir}files/berita/thumb_{$gambarutama}">
                                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ad95b73df13275d"></script> 
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        {$berita_lain}
                    </div>
                    <hr>
                    <div id="disqus_thread"></div>        
                </div>
            </div>
            <div class="col-lg-3">
                <div class="sidebar">
                    {$right}
                </div>
            </div>
        </div>
    </div>
</section>