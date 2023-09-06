<section style="text-align:center">
    <audio autoplay="autoplay">
        <source src="{$basedir}images/Syairsua.mp3" type="audio/mpeg">
    </audio>
</section>
<!-- Hero Section Begin -->
<section class="hero-section">
    <div class="hero-items owl-carousel">
        {$banner}
    </div>
</section>
<!-- Hero Section End -->

<!-- How It Works Section Begin -->
<section class="howit-works spad" style="background-color: white;">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="single-howit-works">
                    <img src="{$basedir}files/setting/{$rconf.foto_kdh}" style="height: 375px;" alt="">
                    <!-- <h4>{$rconf.nama_kdh}</h4> -->
                </div>
            </div>
            <div class="col-lg-4">
                <div class="single-howit-works">
                    <img src="{$basedir}files/setting/{$rconf.gambar}" style="height: 200px;" alt="">
                    <h4>Kabupaten Katingan</h4>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="single-howit-works">
                    <img src="{$basedir}files/setting/{$rconf.foto_wa_kdh}" style="height: 375px;" alt="">
                    <!-- <h4>{$rconf.nama_wa_kdh}</h4> -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- How It Works Section End -->

<!-- Feature Section Begin -->
<section class="feature-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Berita Terbaru</h2>
                </div>
            </div>
        </div>
        <div class="row">
            {$berita}
            <div class="col-lg-12 text-center">
                <a class="site-btn" href="{$basedir}berita">Selengkapnya</a>
            </div>
        </div>
    </div>
</section>
<!-- Feature Section End -->

<!-- Video Section Begin -->
<div class="video-section set-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="video-text">
                    <a href="{$video.link}" class="play-btn video-popup"><i class="fa fa-play"></i></a>
                    <h2>{$video.judul}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Video Section End -->


<!-- Latest Blog Section Begin -->
<section class="blog-section latest-blog spad" style="background-color: white;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Galeri Foto</h2>
                </div>
            </div>
        </div>
        <div class="row">
            {foreach $galeri as $r}
            <div class="col-lg-4">
                <div class="single-blog-item">
                    <div class="sb-pic">
                        <img src="{$basedir}files/albumfoto/{$r.namafile}" onclick="preview('{$basedir}files/albumfoto/{$r.namafile}');" alt="">
                    </div>
                    <div class="sb-text">
                        <h4>{$r.judul}</h4>
                    </div>
                </div>
            </div>
            {/foreach}

            <div class="col-lg-12 text-center">
                <a class="site-btn" href="{$basedir}foto">Selengkapnya</a>
            </div>
        </div>
    </div>
</section>
<!-- Latest Blog Section End -->
<section class="feature-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="section-title">
                    <h2><small>Agenda</small></h2>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        {$agenda}
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="section-title">
                    <h2><small>Kalender</small></h2>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <iframe src="https://calendar.google.com/calendar/embed?wkst=1&amp;bgcolor=%23ffffff&amp;ctz=Asia%2FJakarta&amp;src=aWQuaW5kb25lc2lhbiNob2xpZGF5QGdyb3VwLnYuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&amp;src=ZW4uaW5kb25lc2lhbiNob2xpZGF5QGdyb3VwLnYuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&amp;color=%237986CB&amp;color=%230B8043" style="border:solid 1px #777; width: 100%; height: 200px;" frameborder="0" scrolling="no"></iframe>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="section-title">
                    <h2><small>Pengunjung</small></h2>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table">
                            <tr>
                                <td>Hari ini</td>
                                <td style="text-align: right;">{$pengunjung.pengunjung}</td>
                            </tr>
                            <tr>
                                <td>Minggu ini</td>
                                <td style="text-align: right;">{$pengunjung.mingguan}</td>
                            </tr>
                            <tr>
                                <td>Bulan ini</td>
                                <td style="text-align: right;">{$pengunjung.bulanan}</td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td style="text-align: right;">{$pengunjung.total}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="section-title">
                    <h2><small>Polling</small></h2>
                </div>
                <div class="row">
                    <div class="col-lg-12 text-center" style="text-align: center;">
                        <center>
                            <script type="text/javascript" src="https://www.easypolls.net/ext/scripts/emPoll.js?p=5e4cfee2e4b0bd55452d13e5"></script><a class="OPP-powered-by" href="http://www.objectplanet.com/opinio/" style="text-decoration:none;"><div style="font: 9px arial; color: gray;">panel management</div></a>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
