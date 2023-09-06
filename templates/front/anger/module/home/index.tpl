<section class="banner_section p-0 full_screen">
    <div id="carouselExampleControls" class="banner_content_wrap carousel slide light_arrow3" data-ride="carousel">
        <div class="carousel-inner">
            {foreach from=$banner item=r}
            <div class="carousel-item {if $r.no == 1}active{/if} background_bg overlay_bg_60" data-img-src="{$r.gambar}">
                <div class="banner_slide_content">
                    <div class="container"><!-- STRART CONTAINER -->
                    <div class="row">
                        <div class="col-xl-7 col-md-9">
                            <div class="banner_content4 text_white">
                                <h2 class="animation font-weight-bold" data-animation="fadeInLeft" data-animation-delay="1s"> {$r.judul} </h2>
                                <p class="animation my-4" data-animation="fadeInLeft" data-animation-delay="1.5s">{$r.isi}</p>
                                <a class="btn btn-default rounded-0 animation" href="{$r.link}" data-animation="fadeInLeft" data-animation-delay="1.8s">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div><!-- END CONTAINER-->
                </div>
            </div>
            {/foreach}
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"><i class="ion-chevron-left"></i></a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"><i class="ion-chevron-right"></i></a>
    </div>
</section>
<!-- END SECTION BANNER -->

<!-- START SECTION FEATURE -->
<section class="pb_70">
    <div class="container">
        <div class="row">
            {foreach $aplikasi as $r}
            <div class="col-lg-4 col-md-6">
                <div class="icon_box icon_box_style_14 {$r.bg} text_white animation" data-animation="fadeInUp" data-animation-delay="0.2s">
                	<div class="box_icon mb-3">
                		<i class="fa fa-desktop"></i>
                    </div>
                    <div class="icon_box_content">
                        <h5>{$r.judul}</h5>
                        <a href="{$r.link}">Selengkapnya</a>
                    </div>
                </div>
            </div>
            {/foreach}
        </div>
    </div>
</section>

<!-- START SECTION ABOUT US -->
<section class="bg_linen">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-sm-12">
            	<div class="animation" data-animation="fadeInUp" data-animation-delay="0.2s">
                    <div class="heading_s3"> 
                      <h2>{$rconf.nama_app}</h2>
                    </div>
                    <p>
                        {$rconf.alamat}<br>
                        {$rconf.telp}<br>
                        {$rconf.email}<br>
                        <ul class="list_none social_icons border_social">
                            <li><a href="{$rconf.facebook}" class="sc_facebook"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="https://twitter.com/{$rconf.twitter}" class="sc_twitter"><i class="ion-social-twitter"></i></a></li>
                            <li><a href="https://instagram.com/{$rconf.instagram}" class="sc_instagram"><i class="ion-social-instagram-outline"></i></a></li>
                            <li><a href="{$rconf.youtube}" class="sc_youtube"><i class="ion-social-youtube"></i></a></li>
                        </ul>
                    </p>
                    <p>Kepala Sekolah<br>{$rconf.nama_kdh}</p>
                    <!-- <a href="#" class="btn btn-outline-black rounded-0 mt-md-2">Read More</a> -->
                  </div>
            </div>
            <div class="col-lg-6">
            	<div class="animation mt-4 mt-lg-0" data-animation="fadeInUp" data-animation-delay="0.2s">
                	<img class="w-100" src="{$basedir}images/bg.jpg" alt="about_img"/>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION ABOUT US -->  

<!-- START SECTION BLOG -->
<section class="pb_70">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-9 animation text-center" data-animation="fadeInUp" data-animation-delay="0.2s">
                <div class="heading_s3 text-center">
                    <h2>Berita Terbaru</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="clearfix small_divider"></div>
            </div>
        </div>
        {assign var=i value=1}
        {foreach from=$berita item=r}
            {if $i%3==1}
                <div class="row justify-content-center animation" data-animation="fadeInUp" data-animation-delay="0.2s">
            {/if}
            <div class="col-lg-4 col-md-6 mb-4 pb-md-2">
                <div class="blog_post blog_style5 box_shadow4">
                    <div class="blog_img" onclick="preview('{$r.gambar}');" style="height: 240px; background-image: url('{$r.gambar}'); background-repeat: no-repeat; background-size: cover;">
                    </div>
                    <div class="blog_content">
                        <div class="blog_text">
                            <h6 class="blog_title font-weight-bold"><a href="{$r.link}">{$r.judul}</a></h6>
                            <ul class="list_none blog_meta">
                                <li><a href="{$r.link}"><i class="ion-calendar"></i> {$r.tanggal}</a></li>
                                <li><a href="{$r.link}"><i class="fa fa-eye"></i> {$r.baca} </a></li>
                            </ul>
                            <p>{$r.isi} ...</p>
                            <a href="{$r.link}" class="text-capitalize">Selanjutnya ...</a>
                        </div>
                    </div>
                </div>
            </div>
            {if $i%3==0 or $i==$r.end}
                </div>
            {/if}
            {assign var=i value=$i+1}
        {/foreach}
    </div>
</section>
<!-- END SECTION BLOG -->

<!-- START SECTION CALL TO ACTION -->
<section class="parallax_bg overlay_bg_60 fixed_bg" data-parallax-bg-image="{$basedir}images/bg.jpg">
    	<div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-3 col-6 animation" data-animation="fadeInUp" data-animation-delay="0.1s">
                    <div class="box_counter counter_style5 text-center">
                        <img src="{$themepath}demo-education/images/icon1.png" alt="icon"/>
                        <h3 class="counter_text"><span class="counter">{$jumlah->siswa}</span></h3>
                        <p>Siswa</p>
                    </div>
                </div>
                <!-- <div class="col-lg-4 col-md-3 col-6 animation" data-animation="fadeInUp" data-animation-delay="0.2s">
                    <div class="box_counter counter_style5 text-center">
                        <img src="{$themepath}demo-education/images/icon2.png" alt="icon"/>
                        <h3 class="counter_text"><span class="counter">1700</span></h3>
                        <p>Courses</p>
                    </div>
                </div> -->
                <div class="col-lg-4 col-md-3 col-6 animation" data-animation="fadeInUp" data-animation-delay="0.3s">
                    <div class="box_counter counter_style5 text-center">
                        <img src="{$themepath}demo-education/images/icon3.png" alt="icon"/>
                        <h3 class="counter_text"><span class="counter">{$jumlah->guru}</span></h3>
                        <p>Guru/Karyawan</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-3 col-6 animation" data-animation="fadeInUp" data-animation-delay="0.4s">
                    <div class="box_counter counter_style5 text-center">
                        <img src="{$themepath}demo-education/images/icon4.png" alt="icon"/>
                        <h3 class="counter_text"><span class="counter">{$jumlah->prestasi}</span>+</h3>
                        <p>Prestasi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION CALL TO ACTION -->

<!-- START SECTION TEAM -->
<section class="pb_70">
	<div class="container">
    	<div class="row justify-content-center">
        	<div class="col-lg-6 col-md-9 text-center animation" data-animation="fadeInUp" data-animation-delay="0.2s">
            	<div class="heading_s3 mb-md-3 text-center">
                	<h2>Guru/Karyawan</h2>
                </div>
                <p>Guru dan Karyawan {$rconf.client}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="cleafix small_divider"></div>
            </div>
        </div>
        <div class="row animation" data-animation="fadeInUp" data-animation-delay="0.2s">
            {foreach from=$empat_guru_acak item=r}
        	<div class="col-lg-3 col-sm-6 mb-4 pb-sm-2 text-center">
            	<div class="team_box light_gray_bg">
                	<div class="team_img" onclick="preview('{$r.foto}');"  style="width: 100%; height: 250px; background-image: url('{$r.foto}'); background-size: cover; background-position: center;"></div>
                    <div class="team_title">
                        <h6><small><b>{$r.nama_lengkap}</b></small></h6>
                        <span><small>{$r.nip}</small></span>
                    </div>
                    <ul class="list_none social_icons border_social">
                        <li><a href="{$r.fb}"><i class="ion-social-facebook"></i></a></li>
                        <li><a href="{$r.tw}"><i class="ion-social-twitter"></i></a></li>
                        <li><a href="{$r.ig}"><i class="ion-social-instagram-outline"></i></a></li>
                    </ul>
                </div>
            </div>
            {/foreach}
        </div>
    </div>
</section>
<!-- END SECTION TEAM -->

<!-- START SECTION TESTIMONIAL -->
<section class="bg_linen">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-9 animation text-center" data-animation="fadeInUp" data-animation-delay="0.2s">
                <div class="heading_s3 text-center">	
                    <h2>Video</h2>
                </div>
                <p class="m-0">Galeri video {$rconf.client}</p>
                <div class="clearfix small_divider"></div>
            </div>
        </div>
        <div class="row">
        	<div class="col-12 animation" data-animation="fadeInUp" data-animation-delay="0.2s">
                <div class="testimonial_slider testimonial_style4 carousel_slider owl-carousel owl-theme" data-margin="10" data-loop="true" data-autoplay="false" >
                    {foreach $video as $r}
                    <div class="item">
                        <div class="testimonial_box box_shadow3 bg-white">
                            <div class="testi_meta" style="margin-top: 0;">
                                <iframe width="100%" src="{$r.link}?ecver=1" frameborder="0" allowfullscreen></iframe>
                                <hr>
                                <span>{$r.judul}</span>
                            </div>
                        </div>
                    </div>
                    {/foreach}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION TESTIMONIAL -->

<!-- START SECTION CLIENT LOGO -->
<section class="bg_linen small_pt small_pb">
	<div class="container">
    	<div class="row">
        	<div class="col-md-12 animation" data-animation="fadeInUp" data-animation-delay="0.2s">
            	<div class="cl_logo_slider owl-carousel owl-theme" data-margin="30" data-loop="true" data-autoplay="true" data-dots="false" data-autoplay-timeout="2000">
                    {foreach $weblink as $r}
                	<div class="item">
                    	<a href="{$r.link}" title="{$r.judul}" target="_blank"><img style="height: 51px;" src="{$basedir}files/weblink/{$r.gambar}" alt="{$r.judul}"/></a>
                    </div>
                    {/foreach}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- START SECTION CLIENT LOGO