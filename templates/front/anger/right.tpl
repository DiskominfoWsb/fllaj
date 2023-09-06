<div class="widget">
	<h5 class="widget_title">Trending</h5>
    <ul class="recent_post border_bottom_dash list_none">
        {foreach $trending as $r}
        <li>
            <div class="post_footer">
                <div class="post_img">
                    <a href="{$r.link}"><img src="{$r.gambar}" style="width: 75px;" alt="letest_post1"></a>
                </div>
                <div class="post_content">
                    <h6><a href="{$r.link}">{$r.judul}</a></h6>
                    <p class="small m-0">{$r.tanggal} <br>
                    	<i class="fa fa-eye"></i> {$r.baca}</p>
                </div>
            </div>
        </li>
        {/foreach}
	</ul>
</div>
<div class="widget">
	<script type="text/javascript" src=https://widget.kominfo.go.id/gpr-widget-kominfo.min.js></script>
	<div id="gpr-kominfo-widget-container"></div>
</div>
<div class="widget">
    <h5 class="widget_title">Media Sosial</h5>
	<ul class="list_none social_icons border_social">
	    <li><a href="{$facebook}" class="sc_facebook"><i class="ion-social-facebook"></i></a></li>
	    <li><a href="https://twitter.com/{$rconf.twitter}" class="sc_twitter"><i class="ion-social-twitter"></i></a></li>
	    <li><a href="https://instagram.com/{$rconf.instagram}" class="sc_instagram"><i class="ion-social-instagram-outline"></i></a></li>
	    <li><a href="{$rconf.youtube}" class="sc_youtube"><i class="ion-social-youtube"></i></a></li>
	</ul>
</div>