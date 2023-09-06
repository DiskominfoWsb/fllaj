<section class="breadcrumb-section">
	<div class="container">
	    <div class="row">
	        <div class="col-lg-12">
	            <div class="breadcrumb-text">
	                <h2>{$judul}</h2>
	                <div class="breadcrumb-option">
	                    <a href="{$basedir}"><i class="fa fa-home"></i> Home</a>
	                    <span>{$judul}</span>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</section>
<section class="blog-section blog-page spad">
    <div class="container">
    	<div class="row">
		    <div class="col-lg-12">
		    	<form id="multiform_add" method="POST" enctype="multipart/form-data" style="background-image:  url('https://www.transparenttextures.com/patterns/handmade-paper.png'); background-color: #243BA5; padding: 20px; color: white; border-radius: 20px; border: solid black 5px;">
		    	<div class="row">
		    		<div class="col-md-4 hidden-sm hidden-xs ">
		    			<img src="{$basedir}files/setting/{$rconf.gambar}" style="width: 100%;">
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
						                <strong>Kategori Pengaduan</strong>
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
				                <div class="g-recaptcha" data-sitekey="6Ld_-74UAAAAAAEZeI5C0qGeJOKH7MVkz_othuYa"></div>
				            </div>
				        </div>

				        <div class="row form-group">
				            <div class="col-md-10">
				                <button class="btn btn-success" id="btn_update" style="border-radius: 10px;"><i class="fa fa-send"></i> Kirim Pengaduan</button>
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
		<hr>
		<div class="row">
		    <div class="col-lg-12">
		        <div class="comment-option">
		            <h4>{$jml} Pengaduan</h4>
		            {$komentar}
					{$pagination}
		        </div>
		    </div>
		</div>
    </div>
</section>
<!-- <div class="margin-bottom-20">
    <h2 class="title-v4">Daftar Pengaduan</h2>
	{$komentar}
	{$pagination}
</div> -->