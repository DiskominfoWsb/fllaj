<section class="background_bg breadcrumb_section overlay_bg_50 page-title-light fixed_bg" data-img-src="{$basedir}images/bg.jpg">
	<div class="container">
    	<div class="row align-items-center">
        	<div class="col-sm-6">
            	<div class="page-title">
            		<h1>{$arr_data.judul}</h1>
                </div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-sm-end">
                    <li class="breadcrumb-item"><a href="{$basedir}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{$arr_data.judul}</li>
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
        		{$arr_data.isi|replace:'../../../':{$basedir}}
        	</div>
        	<div class="col-lg-3">
                <div class="sidebar">
                    {$right}
                </div>
        	</div>
        </div>
    </div>
</section>