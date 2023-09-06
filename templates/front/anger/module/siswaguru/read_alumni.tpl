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
		<div class="row animation" data-animation="fadeInUp" data-animation-delay="0.2s">
        	<div class="col-lg-9">
        		<div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="team_single radius_all_10 box_shadow1">
                            <div class="team_img">
                                <img src="{$r->foto}" alt="team_img_big">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-6">
                        <div class="team_single_info">
                            <h5 class="mb-3 font-weight-bold">Profil Alumni :</h5>
                            <table class="table">
                                <tr>
                                    <td>Nama </td>
                                    <th>{$r->nama_lengkap}</th>
                                </tr>
                                <tr>
                                    <td>NIS </td>
                                    <th>{$r->nis}</th>
                                </tr>
                                <tr>
                                    <td>Kelas </td>
                                    <th>{$r->kelas}</th>
                                </tr>
                                <tr>
                                    <td>Tahun Lulus </td>
                                    <th>{$r->tahun_lulus}</th>
                                </tr>
                                <tr>
                                    <td>Email </td>
                                    <th>{$r->email}</th>
                                </tr>
                                <tr>
                                    <td>Sosial Media </td>
                                    <th>
                                        <ul class="list_none social_icons radius_social">
                                            <li><a href="{$r->fb}" class="sc_facebook"><i class="ion-social-facebook"></i></a></li>
                                            <li><a href="{$r->tw}" class="sc_twitter"><i class="ion-social-twitter"></i></a></li>
                                            <li><a href="{$r->ig}" class="sc_instagram"><i class="ion-social-instagram-outline"></i></a></li>
                                        </ul>
                                    </th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row animation" data-animation="fadeInUp" data-animation-delay="0.4s">
                    <div class="col-lg-12 col-md-12">
                        <div class="teacher_detail">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0">Prestasi</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover table-bordered">
                                            <thead>
                                                <th class="text-center">No.</th>
                                                <th style="width: 70px;" class="text-center">Kelas</th>
                                                <th style="width: 70px;" class="text-center">Tingkat</th>
                                                <th class="text-center">Keterangan</th>
                                            </thead>
                                            <tbody>
                                                {if $prestasi}
                                                {assign var=no value=1}
                                                {foreach $prestasi as $r}
                                                <tr>
                                                    <td class="text-center">{$no++}.</td>
                                                    <td style="width: 70px;" class="text-center">{$r->kelas}</td>
                                                    <td style="width: 70px;" class="text-center">{$r->tingkat}</td>
                                                    <td>{$r->urai}</td>
                                                </tr>
                                                {/foreach}
                                                {else}
                                                <tr>
                                                    <td colspan="4" class="text-center"><i>- Belum ada data. -</i></td>
                                                </tr>
                                                {/if}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
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