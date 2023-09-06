<footer class="footer footer-dark">
    <div class="clearfix mb-0 px-2 container center-layout">
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-3">
                <h5>Hubungi Kami</h5>
                <table border="0" style="max-width: 100%;">
                    <tr>
                        <th style="vertical-align: top; padding: 5px;"><i class="fa fa-map-marker"></i></th>
                        <td style="vertical-align: top; padding: 5px;">{$rconf.alamat}</td>
                    </tr>
                    <tr>
                        <th style="vertical-align: top; padding: 5px;"><i class="fa fa-envelope"></i></th>
                        <td style="vertical-align: top; padding: 5px;">{$rconf.email}</td>
                    </tr>
                    <tr>
                        <th style="vertical-align: top; padding: 5px;"><i class="fa fa-phone"></i></th>
                        <td style="vertical-align: top; padding: 5px;">{$rconf.telp}</td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            
                            <a href="{$facebook}" target="_blank"><i class="fa fa-facebook btn btn-sm" style="background-color: #3b5998; color: white;"></i></a>
                            <a href="https://twitter.com/{$twitter}" target="_blank"><i class="fa fa-twitter btn btn-sm" style="background-color: #08a0e9; color: white;"></i></a>
                            <a href="https://instagram.com/{$instagram}" target="_blank"><i class="fa fa-instagram btn btn-sm" style="background: linear-gradient(225deg, rgba(81,91,212,1) 0%, rgba(129,52,175,1) 10%, rgba(221,42,123,1) 30%, rgba(245,133,41,1)70%, rgba(254,218,119,1) 90%); color: white;"></i></a>
                            <a href="{$youtube}" target="_blank"><i class="fa fa-youtube btn btn-sm" style="background-color: #e62117; color: white;"></i></a>

                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-3">
                <h5>Link Tautan</h5>
                <ul class="list-unstyled">
                    {foreach $weblink as $r}
                    <li>
                        <a href="{$r.link}" title="{$r.judul}" target="_blank">{$r.judul}</a>
                    </li>
                    {/foreach}
                </ul>
            </div>
            <div class="col-md-3">
                <h5>Trending</h5>
                {foreach $trending as $r}
                <div class="row">
                    <div class="col-md-12">
                        <img src="{$r.gambar}" alt="{$r.judul}" style="width: 60px; float: left; margin-right: 7.5px;" />
                        <p class="small m-0">{$r.tanggal}</p>
                        <p><a href="{$r.link}">{$r.judul}</a></p>
                    </div>
                </div>
                {/foreach}
            </div>
            <div class="col-md-3">
                <h5>Statistik</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>Hari ini</th>
                        <td class="text-right">
                            {$pengunjung.pengunjung}
                        </td>
                    </tr>
                    <tr>
                        <th>Minggu ini</th>
                        <td class="text-right">
                            {$pengunjung.mingguan}
                        </td>
                    </tr>
                    <tr>
                        <th>Bulan ini</th>
                        <td class="text-right">
                            {$pengunjung.bulanan}
                        </td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td class="text-right">
                            {$pengunjung.total}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        
    </div>
</footer>
<footer class="footer footer-static footer-dark navbar-shadow" style="background-color: rgb(31,41,51);">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2 container center-layout text-center">
        <span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2021 {$rconf.nama_app}. All rights reserved. </span>
    </p>
</footer>

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

  <!-- BEGIN VENDOR JS-->
  <script src="{$themepath}app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <script type="text/javascript" src="{$themepath}app-assets/vendors/js/ui/jquery.sticky.js"></script>
  <script type="text/javascript" src="{$themepath}app-assets/vendors/js/charts/jquery.sparkline.min.js"></script>
  <script src="{$themepath}app-assets/vendors/js/extensions/jquery.knob.min.js" type="text/javascript"></script>
  <script src="{$themepath}app-assets/js/scripts/extensions/knob.js" type="text/javascript"></script>
  <script src="{$themepath}app-assets/vendors/js/charts/raphael-min.js" type="text/javascript"></script>
  <script src="{$themepath}app-assets/vendors/js/charts/morris.min.js" type="text/javascript"></script>
  <script src="{$themepath}app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js"
  type="text/javascript"></script>
  <script src="{$themepath}app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js"
  type="text/javascript"></script>
  <script src="{$themepath}app-assets/data/jvector/visitor-data.js" type="text/javascript"></script>
  <script src="{$themepath}app-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script>
  <script src="{$themepath}app-assets/vendors/js/charts/jquery.sparkline.min.js" type="text/javascript"></script>
  <script src="{$themepath}app-assets/vendors/js/extensions/unslider-min.js" type="text/javascript"></script>
  <link rel="stylesheet" type="text/css" href="{$themepath}app-assets/css/core/colors/palette-climacon.css">
  <link rel="stylesheet" type="text/css" href="{$themepath}app-assets/fonts/simple-line-icons/style.min.css">
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN STACK JS-->
  <script src="{$themepath}app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="{$themepath}app-assets/js/core/app.js" type="text/javascript"></script>
  <script src="{$themepath}app-assets/js/scripts/customizer.js" type="text/javascript"></script>
  <!-- END STACK JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  <script type="text/javascript" src="{$themepath}app-assets/js/scripts/ui/breadcrumbs-with-stats.js"></script>
  <script src="{$themepath}app-assets/js/scripts/pages/dashboard-analytics.js" type="text/javascript"></script>
  <!-- END PAGE LEVEL JS-->
  <script src="{$basedir}js/front/wf.js"></script>
  <script src="{$basedir}js/front/grafik.js"></script>

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
      s.src = 'https://llaj-kab-wonosobo.disqus.com/embed.js';
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

  <script type="text/javascript">
  $(document).ready(function() {
    var els = document.querySelectorAll('.img_user');
    for (var i=0; i < els.length; i++) {
        els[i].setAttribute("style", "max-width: 100%; border-radius: 50%; max-height: "+els[i].offsetWidth+"px;");
    }

    var els = document.querySelectorAll('.div_img_user');
    for (var i=0; i < els.length; i++) {
        els[i].setAttribute("style", "width: 100%; border-radius: 50%; height: "+els[i].offsetWidth+"px; text-align: center;");
    }
  });
</script>