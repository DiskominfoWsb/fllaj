<div class="app-content container center-layout mt-2">
    <div class="content-wrapper">

      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">{$arr_data.judul}</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{$basedir}">Home</a>
                </li>
                <li class="breadcrumb-item">{$arr_data.judul}
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
				        	<h4 class="card-title">{$arr_data.judul}</h4>
				        </div>
				        <div class="card-content">
				          	<div class="card-body">
				          		{$arr_data.isi|replace:'../../../':{$basedir}}
							</div>
						</div>
					</div>
				</div>
        <div class="col-md-4">{$right}</div>
        
			</div>
		</div>
	</div>
</div>