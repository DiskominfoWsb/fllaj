<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.10';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<section class="blog-details-hero set-bg" data-setbg="{$themepath}img/blog/blog-details-hero.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="bd-hero-text">
                    <span>{$data.kategori}</span>
                    <h2>{$data.judul}</h2>
                    <ul>
                        <li><i class="fa fa-user"></i> {$data.kontributor}</li>
                        <li><i class="fa fa-clock-o"></i> {$tanggal}</li>
                        <li><i class="fa fa-eye"></i> {$data.baca}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="blog-details-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="hero-items owl-carousel">
                    {$not = 0}
                    {foreach $gambarslider as $gm}
                        <div class="single-hero-item set-bg" data-setbg="{$basedir}files/berita/{$gm}">
                            {if $captionslider[$not]} 
                                <div class="hero-text">
                                    <p class="room-location">
                                        {$captionslider[$not++]}
                                    </p>
                                </div>
                            {/if}
                        </div>
                    {/foreach}
                </div>
                <br>
                <div class="addthis_inline_share_toolbox addthis_toolbox" addthis:url="{$url}" addthis:title="{$data.judul}" addthis:description="{$data.judul}" addthis:media="{$basedir}files/berita/thumb_{$gambarutama}">
                    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ad95b73df13275d"></script> 
                </div>
                {$isi}
            </div>
            {$berita_lain}
        </div>
        <br>
        <div id="disqus_thread"></div>        
    </div>
</section>