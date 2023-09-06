<!-- START FOOTER SECTION --> 
<footer class="footer_dark">
	<div class="top_footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0 animation" data-animation="fadeInUp" data-animation-delay="0.2s">
                	<div class="footer_logo">
                    	<a href="index-23.html"><img alt="logo" src="{$basedir}images/header-2-300x117.png"></a>
                    </div>
                    <!-- <p>Phasellus blandit massa enim. elit id varius nunc. Lorem ipsum dolor sit amet, consectetur industry.</p> -->
                    <ul class="contact_info contact_info_light list_none">
                        <li>
                            <span class="ti-location-pin"></span>
                            <address>{$rconf.alamat}</address>
                        </li>
                        <li>
                            <span class="ti-email"></span>
                            <a href="mailto:{$rconf.email}">{$rconf.email}</a>
                        </li>
                        <li>
                            <span class="ti-mobile"></span>
                            <p>{$rconf.telp}</p>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0 animation" data-animation="fadeInUp" data-animation-delay="0.4s">
                	<h6 class="widget_title">Link Tautan</h6>
                    <ul class="list_none widget_links_style2">
                        {foreach $weblink as $r}
                    	<li><a href="{$r.link}" title="{$r.judul}" target="_blank">{$r.judul}</a></li>
                        {/foreach}
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0 animation" data-animation="fadeInUp" data-animation-delay="0.6s">
                	<h6 class="widget_title">Berita Trending</h6>
                    <ul class="recent_post border_bottom_dash list_none">
                    	{foreach $trending as $r}
                        <li>
                        	<div class="post_footer">
                            	<div class="post_img">
                                	<a href="{$r.link}"><img src="{$r.gambar}" alt="{$r.judul}" style="width: 60px;" /></a>
                                </div>
                                <div class="post_content">
                                	<h6><a href="{$r.link}">{$r.judul}</a></h6>
                                    <p class="small m-0">{$r.tanggal}</p>
                                </div>
                            </div>
                        </li>
                        {/foreach}
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 animation" data-animation="fadeInUp" data-animation-delay="0.8s">
                    <h6 class="widget_title">Lokasi</h6>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15805.557477361059!2d110.592895!3d-7.9586524!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x557ead0baaada682!2sSMKN%202%20Wonosari!5e0!3m2!1sen!2sid!4v1605684245296!5m2!1sen!2sid" width="100%" height="225" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    <br>                    
                </div>
            </div>
        </div>
    </div>
    <div class="bottom_footer border_top_tran">
    	<div class="container">
        	<div class="row align-items-center">
            	<div class="col-md-6">
                	<p class="copyright m-md-0 text-center text-md-left">&copy; Copyright 2020 {$rconf.nama_app}.
                    All rights reserved. </p>
                </div>
                <div class="col-md-6">
                	<ul class="list_none footer_link text-center text-md-right">
                    	<!-- <li><a href="#">Privacy Policy</a></li> -->
                        <li><a href="https://wfdev.us">Developed by WF</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- END FOOTER SECTION -->  

<div class="modal fade bd-example-modal-md" id="preview_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <!-- <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5> -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          </div>
          <!-- <div class="modal-footer">
            <button type="button" class="btn btn-black" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-default">Save changes</button>
          </div> -->
        </div>
      </div>
    </div>

<a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a> 

<!-- Latest jQuery --> 
<script src="{$themepath}assets/js/jquery-1.12.4.min.js"></script> 
<!-- jquery-ui --> 
<script src="{$themepath}assets/js/jquery-ui.js"></script>
<!-- popper min js --> 
<script src="{$themepath}assets/js/popper.min.js"></script>
<!-- Latest compiled and minified Bootstrap --> 
<script src="{$themepath}assets/bootstrap/js/bootstrap.min.js"></script> 
<!-- owl-carousel min js  --> 
<script src="{$themepath}assets/owlcarousel/js/owl.carousel.min.js"></script> 
<!-- magnific-popup min js  --> 
<script src="{$themepath}assets/js/magnific-popup.min.js"></script> 
<!-- waypoints min js  --> 
<script src="{$themepath}assets/js/waypoints.min.js"></script> 
<!-- parallax js  --> 
<script src="{$themepath}assets/js/parallax.js"></script> 
<!-- countdown js  --> 
<script src="{$themepath}assets/js/jquery.countdown.min.js"></script>
<!-- fit video  -->
<script src="{$themepath}assets/js/jquery.fitvids.js"></script> 
<!-- jquery.counterup.min js --> 
<script src="{$themepath}assets/js/jquery.counterup.min.js"></script>
<!-- isotope min js --> 
<script src="{$themepath}assets/js/isotope.min.js"></script>
<!-- elevatezoom js -->
<script src='{$themepath}assets/js/jquery.elevatezoom.js'></script>
<!-- elevatezoom js -->
<script src='{$themepath}assets/js/jquery.dd.min.js'></script> 
<!-- Demo js -->
<script src='{$themepath}demo-education/js/demo-education.js'></script> 
<!-- scripts js --> 
<script src="{$themepath}assets/js/scripts.js"></script>

<script src="{$basedir}js/front/wf.js"></script>
<script>
    /**
    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
    /*
    var disqus_config = function () {
    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    */
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://smk-negeri-2-wonosari.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

<script type="text/javascript">
    function preview(img) {
        $('#preview_modal').find('.modal-body').html('<img style="width: 100%;" src="'+img+'">');
        $('#preview_modal').modal('show');
    }
</script>