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
                {assign var=no value=1}
                {foreach $arr_data as $r}
                    {if $no%3==1}
                        <div class="row justify-content-center animation" data-animation="fadeInUp" data-animation-delay="0.2s">
                    {/if}
                    <div class="col-lg-4 col-sm-6 mb-4 pb-sm-2 text-center">
                        <div class="team_box light_gray_bg">
                            {if $r.foto|strstr:'http'}
                                {$foto = $r.foto}
                            {else}
                                {$foto = "`$gmb``$r.foto`"}

                            {/if}
                            <div class="team_img" onclick="preview('{$foto}');"  style="width: 100%; height: 250px; background-image: url('{$foto}'); background-size: cover; background-position: center;"></div>
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
                    {if $no%3==0 or $no==$r.end}
                        </div>
                    {/if}
                    {assign var=no value=$no+1}
                {/foreach}
                <div class="row text-center">
                    <div class="col-lg-12 text-center">
                        <div class="heading_s3 text-center">
                            {$pagination}
                        </div>
                    </div>
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