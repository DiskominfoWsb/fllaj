
        <div class="world-news">
            <div class="main-title-head">
                <h3>AGENDA "{$arr_data.0.judul}"</h3>
                <div class="clearfix"></div>
            </div>
            <div class="world-news-grids row">
				    {if count($arr_data) != 0} {foreach $arr_data as $row}
				<div class="col-md-12">
					<img src="{$basedir}files/agenda/{$row.gambar}" width="100%">
				</div>
				<div class="col-md-12">
					<blockquote>
						<small><i class="fa fa-calendar"></i> {$row.tanggal}</small>
						<p>Lokasi : <b>{$row.lokasi}</b></p>
						{$row.deskripsi}
						<p>Status : <b>{$row.stt}</b></p> 
					</blockquote>
				</div>
				    {/foreach} {/if}
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="comments">
            <div class="grid-header">
                <h4><strong>Berita Lainnya</strong></h4>
            </div>
            <div class="singlepage">
                {foreach $berita_lain as $row}
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;margin-top: 5px;">
                        {$row.konten}
                    </div>
                {/foreach}
            </div>
                <div class="clearfix"></div>
        </div>
        <div class="comments">
            <div class="addthis_inline_share_toolbox addthis_toolbox" addthis:url="{$wasurl}" addthis:title="{$arr_data.0.judul}" addthis:description="{$arr_data.0.judul}" addthis:media="https://mmc.kalteng.go.id/files/agenda/{$row.gambar}">
                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ad95b73df13275d"></script> 
            </div>
        </div>

        <div class="comments">
            <div id="disqus_thread"></div>
            <script>
            (function() { // DON'T EDIT BELOW THIS LINE
                var d = document, s = d.createElement('script');
                s.src = 'https://mmckaltenggo.disqus.com/embed.js';
                s.setAttribute('data-timestamp', +new Date());
                (d.head || d.body).appendChild(s);
            })();
            </script>
            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>      
        </div>