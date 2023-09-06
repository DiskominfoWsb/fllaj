
<section class="contact-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact-map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3987.668593356116!2d113.39668791535667!3d-1.8809282370958533!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dfce21376200b97%3A0xf682f9c2fc42409c!2sKatingan%20Regent%20Office!5e0!3m2!1sen!2sid!4v1581424234583!5m2!1sen!2sid"
                        height="700" style="border:0;" allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Partner Carousel Section Begin -->
<section class="property-details-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="pd-details-text">
                    <div class="pd-details-tab" style="border: 1px solid #d7d7d7;">
                        <div class="tab-item">
                            <ul class="nav" role="tablist">
                                <li>
                                    <a class="active" data-toggle="tab" href="#tab-1" role="tab">SKPD</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-2" role="tab">E-Goverment</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-3" role="tab">Kabupaten/Kota</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-item-content">
                            <div class="tab-content">
                                <div class="tab-pane fade-in active" id="tab-1" role="tabpanel" style="padding: 20px;">
                                    <div class="row">
                                    {foreach $weblink as $r}
                                    {if $r.kategori == 1}
                                    <div class="col-lg-3 col-sm-6 text-center form-group">
                                        <a href="{$r.link}" target="_blank">
                                            <img src="{$basedir}files/weblink/{$r.gambar}" style="max-width: 100%; height: 75px; background-color: black; border-radius: 15px;" alt="">
                                        </a>
                                    </div>
                                    {/if}
                                    {/foreach}
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-2" role="tabpanel" style="padding: 20px;">
                                    <div class="row">
                                    {foreach $weblink as $r}
                                    {if $r.kategori == 2}
                                    <div class="col-lg-3 col-sm-6 text-center form-group">
                                        <a href="{$r.link}" target="_blank">
                                            <img src="{$basedir}files/weblink/{$r.gambar}" style="max-width: 100%; height: 75px; background-color: black; border-radius: 15px;" alt="">
                                        </a>
                                    </div>
                                    {/if}
                                    {/foreach}
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-3" role="tabpanel" style="padding: 20px;">
                                    <div class="row">
                                    {foreach $weblink as $r}
                                    {if $r.kategori == 3}
                                    <div class="col-lg-3 col-sm-6 text-center form-group">
                                        <a href="{$r.link}" target="_blank">
                                            <img src="{$basedir}files/weblink/{$r.gambar}" style="max-width: 100%; height: 75px; background-color: black; border-radius: 15px;" alt="">
                                        </a>
                                    </div>
                                    {/if}
                                    {/foreach}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Footer Section Begin -->
<footer class="footer-section set-bg" data-setbg="{$basedir}images/br2.png">
    <div class="container">
        <div class="footer-text">
            <div class="row">
                <div class="col-lg-7">
                    <div class="footer-logo">
                        <div class="logo">
                            <a href="{$themepath}#"><img src="{$themepath}img/logo.png" alt=""></a>
                        </div>
                        <p>Kabupaten Katingan adalah salah satu kabupaten di provinsi Kalimantan Tengah. Kabupaten yang beribu kota di Kasongan ini memiliki Semboyan kabupaten ini adalah "Penyang Hinje Simpei" (bahasa Ngaju) yang artinya adalah Hidup Rukun dan Damai untuk Kesejahteraan Bersama. Kabupaten ini terdiri dari 13 kecamatan 154 Desa dan 7 Kelurahan.</p>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="footer-widget">
                        <h4>Media Sosial</h4>
                        <ul class="social">
                            <li><i class="ti-facebook"></i> <a href="{$facebook}">Facebook</a></li>
                            <li><i class="ti-instagram"></i> <a href="https://instagram.com/{$instagram}">Instagram</a></li>
                            <li><i class="ti-twitter-alt"></i> <a href="https://twitter.com/{$twitter}">Twitter</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="footer-widget">
                        <h4>Kontak Kami</h4>
                        <ul class="contact-option">
                            <li><i class="fa fa-map-marker"></i> {$rconf.alamat}</li>
                            <li><i class="fa fa-phone"></i> {$rconf.telp}</li>
                            <li><i class="fa fa-envelope"></i> {$rconf.email}</li>
                            {foreach $wa as $r}
                            <li><i class="fa fa-whatsapp"></i>
                                <a href="https://api.whatsapp.com/send?phone=62{$r|substr:1}" target="_blank">
                                    {$r}
                                </a>
                            </li>
                            {/foreach}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-text">
            <p>
                <p>
                    © Copyright 2020 {$rconf.nama_app}.
                    All rights reserved. 
                    <div hidden>
                    | This template is made with <i class="ti-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> 
                    | Developed by <a href="https://wfdev.us" style="color: #222;" target="_blank">WF</a> 
                    </div>
                </p>
            </p>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Js Plugins -->
<script src="{$themepath}js/jquery-3.3.1.min.js"></script>
<script src="{$themepath}js/bootstrap.min.js"></script>
<script src="{$themepath}js/jquery.magnific-popup.min.js"></script>
<script src="{$themepath}js/jquery.nice-select.min.js"></script>
<script src="{$themepath}js/jquery.slicknav.js"></script>
<script src="{$themepath}js/jquery-ui.min.js"></script>
<script src="{$themepath}js/owl.carousel.min.js"></script>
<script src="{$themepath}js/main.js"></script>
<script src="{$themepath}plugins/sweetalert/sweetalert.min.js"></script>
<!-- <script src="{$themepath}plugins/select2/dist/js/select2.min.js"></script> -->
<script src="{$basedir}js/front/wf.js"></script>

<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://kabupaten-katingan.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                            
<div id="modal_img_preview" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function preview(url){
        var modal = $("#modal_img_preview");
        modal.find(".modal-body").html('<img src="'+url+'" style="width: 100%;">');
        modal.modal("show");
    }
</script>