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
        		<div class="card form-group">
                    <div class="card-body">
                        <form id="pencarian" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4">
                                <select class="form-control" id="tahun" name="tahun">
                                    <option value="">Kelas</option>
                                    <option value="0">X</option>
                                    <option value="1">XI</option>
                                    <option value="2">XII</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" id="jurusan" name="jurusan">
                                    <option value="">Jurusan</option>
                                    {foreach $jurusan as $r}
                                    <option value="{$r.kelas}">{$r.kelas}</option>
                                    {/foreach}
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" id="btn_update" class="btn btn-sm btn-success"><i class="fa fa-search"></i> Pencarian</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="container">
                    <div id="result"></div>
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