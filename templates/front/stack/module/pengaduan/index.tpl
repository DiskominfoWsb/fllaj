<div class="app-content container center-layout mt-2">
    <div class="content-wrapper">

      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">{$judul}</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{$basedir}">Home</a>
                </li>
                <li class="breadcrumb-item">{$judul}
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div> 

      <div class="content-body">
			<div class="row">
				<div class="col-md-8">
					<div class="card">
				        <div class="card-header">
				        	<h4 class="card-title">{$judul}</h4>
				        </div>
				        <div class="card-content">
				          	<div class="card-body">
<form id="multiform_add" method="POST" enctype="multipart/form-data" style="background-image:  url('https://www.transparenttextures.com/patterns/handmade-paper.png'); background-color: #393185; padding: 20px; color: white; border-radius: 20px; border: solid black 5px; margin-bottom: 20px;">
	<div class="row">
		<div class="col-md-4 hidden-sm hidden-xs ">
			<img src="{$basedir}images/dishub.png" style="width: 100%;">
		</div>
		<div class="col-md-8">
	        <div class="row form-group">
	            <div class="col-md-12">
	                <strong>Nama Lengkap Anda</strong>
	            </div>
	            <div class="col-md-12">
	                <input required type="nama" name="nama" class="form-control" style="border-radius: 10px;">
	            </div>
	        </div>
	        <div class="row form-group">
	        	<div class="col-md-6">
	        		<div class="row">
			            <div class="col-md-12">
			                <strong>Alamat Email Anda</strong>
			            </div>
			            <div class="col-md-12">
			                <input required type="email" name="email" class="form-control" style="border-radius: 10px;">
			            </div>
			        </div>
	            </div>
	            <div class="col-md-6">
	        		<div class="row">
			            <div class="col-md-12">
			                <strong>Nomor Telepon Anda</strong>
			            </div>
			            <div class="col-md-12">
			                <input required type="text" name="hp" class="form-control" style="border-radius: 10px;">
			            </div>
			        </div>
	            </div>
	        </div>
	        <div class="row form-group">
	        	<div class="col-md-6">
	        		<div class="row">
			            <div class="col-md-12">
			                <strong>Jenis Kelamin Anda</strong>
			            </div>
			            <div class="col-md-12">
			                <select required class="form-control select2" name="jk" style="border-radius: 10px;">
			                	<option value="L">Laki-Laki</option>
			                	<option value="P">Perempuan</option>
			                </select>
			            </div>
			        </div>
	            </div>
	            <div class="col-md-6">
	        		<div class="row">
			            <div class="col-md-12">
			                <strong>Kategori</strong>
			            </div>
			            <div class="col-md-12">
			                <select required class="form-control select2" name="kategori" style="border-radius: 10px;">
			                	{foreach $kategori as $kat}
			                	<option value="{$kat.id}">{$kat.urai}</option>
			                	{/foreach}
			                </select>
			            </div>
			        </div>
	            </div>
	        </div>
	        <div class="row form-group">
	            <div class="col-md-12">
	                <strong>Pesan Pengaduan Anda</strong>
	            </div>
	            <div class="col-md-12">
	                <textarea class="form-control" rows="5" required name="pesan" style="border-radius: 10px;"></textarea>
	            </div>
	        </div>

	        <div class="row form-group">
	            <div class="col-md-12">
	                <strong>Gambar</strong>
	            </div>
	            <div class="col-md-12">
	                <input type="file" name="gambar[]" class="form-control" />
	            </div>
	        </div>
	        <div class="row form-group">
	            <div class="col-md-12">
	                <div class="g-recaptcha" data-sitekey="6Ld_-74UAAAAAAEZeI5C0qGeJOKH7MVkz_othuYa"></div>
	            </div>
	        </div>

	        <div class="row form-group">
	            <div class="col-md-10">
	                <button class="btn btn-success" id="btn_update" style="border-radius: 10px;"><i class="fa fa-send"></i> Kirim Pengaduan</button>
	                <div id="respon_post"></div>
	            </div>
	        </div>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-12 text-center">
			Kerahasiaan identitas pelapor dijamin selama pelapor tdak mempublikasikan sendiri perihal laporan tersebut
		</div>
	</div>
</form>

				          	</div>
				        </div>
				    </div>

<div class="card">
    <div class="card-header">
    	<h4 class="card-title">Statistik {$judul}</h4>
    </div>
    <div class="card-content">
      	<div class="card-body">
      		<div class="row">
				<div class="col-md-6">
					<div id="grafik1"></div>
				</div>
				<div class="col-md-6">
					<div id="grafik2"></div>
				</div>
			</div>
      	</div>
    </div>				    
</div>
				    <div class="card">
				        <div class="card-header">
				        	<h4 class="card-title">Daftar {$judul}</h4>
				        </div>
				        <div class="card-content">
				          	<div class="card-body">
{foreach $komentar as $r}
<div class="row">
	<div class="col-md-2" style="vertical-align: top">
		<div class="user_img">
	        <img src="{$basedir}images/user.png" alt="user2" style="width: 100%;">
	    </div>
	</div>
	<div class="col-md-10" style="vertical-align: top">
	    <div class="comment_content">
	        <div class="d-flex align-items-md-center">
	            <div class="meta_data">
	                <h5 style="color: #009c9f;">{$r.nama}</h5>
	                <div class="comment-time">{$r.tgl_aduan}</div>
	            </div>
	        </div>
	        {if $r.gambar}
	        	<img src="{$basedir}files/pengaduan/{$r.gambar}" style="width: 200px; float: left; margin-right: 5px;" onclick="preview('{$basedir}files/pengaduan/{$r.gambar}')">
	        {/if}
	        <p>{$r.pesan}</p>
	    </div>
	</div>
</div>
{if $r.respon}
<div class="row">
	<div class="col-md-2" style="text-align: left;">
		<h1 style="transform: rotate(180deg);"><i class="fa fa-reply"></i></h1>
	</div>
	<div class="col-md-2" style="vertical-align: top">
		<div class="user_img div_img_user">
	        <img src="{$basedir}files/mnuser/{$r.foto}" alt="{$r.nama_lengkap}" style="max-width: 100%; border-radius: 50%;" class="img_user">
	    </div>
	</div>
	<div class="col-md-8" style="vertical-align: top">
	    <div class="comment_content">
	        <div class="d-flex align-items-md-center">
	            <div class="meta_data">
	                <h5 style="color: #009c9f;">{$r.nama_lengkap}</h5>
	                <div class="comment-time">{$r.tanggal_respon}</div>
	            </div>
	        </div>
	        <p>{$r.respon}</p>
	    </div>
	</div>
</div>
{/if}
<hr>
{/foreach}
{$pagination}			
							</div>
				        </div>
				    </div>
				</div>
				<div class="col-md-4">{$right}</div>
			</div>
		</div>
  	</div>
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
