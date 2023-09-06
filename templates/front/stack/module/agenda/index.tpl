<style type="text/css">
  table img {
    width: 100%;
    height: auto;
  }
</style>
<div class="app-content container center-layout mt-2">
    <div class="content-wrapper">

      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">Agenda</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{$basedir}">Home</a>
                </li>
                <li class="breadcrumb-item">Agenda
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>  

      	<div class="content-body">
			<div class="row">
				<div class="col-md-8">
					<!-- <div class="card">
				        <div class="card-header">
				        	<h4 class="card-title">Agenda</h4>
				        </div>
				        <div class="card-content">
				          	<div class="card-body">


							</div>
						</div>
					</div> -->
<section id="timeline" class="timeline-center timeline-wrapper">
    <ul class="timeline">
            <li class="timeline-line"></li>
            
            {assign var=i value=1}
            {foreach from=$arr_data item=r}
            <li class="timeline-item {if $i%2==0}mt-3{/if}">
              <div class="timeline-badge">
                <span class="{$r.bg} bg-lighten-1" data-toggle="tooltip" data-placement="right" title="{$r.judul}"><i class="fa fa-calendar"></i></span>
              </div>
              <div class="timeline-card card border-grey border-lighten-2">
                <div class="card-header pb-0">
                  <h4 class="card-title"><a href="#">{$r.judul}</a></h4>
                  <p class="card-subtitle text-muted mb-0 pt-1">
                    <span class="font-small-3">{$r.tanggal}</span>
                  </p>
                </div>
                <div class="card-content pt-0">
                    <div class="card-body">
                      <table style="width: 100%;">
                          <tr>
                              <!-- <th style="vertical-align: top;">Deskripsi</th> -->
                              <td style="vertical-align: top;" colspan="2"><b>Deskripsi</b> <br>
                              {$r.deskripsi}</td>
                          </tr>
                          <tr>
                              <th style="vertical-align: top;">Lokasi</th>
                              <td style="vertical-align: top;">{$r.lokasi}</td>
                          </tr>
                          <tr>
                              <th></th>
                              <td style="vertical-align: top;">
                                <label class="btn {$r.bg} btn-sm" style="color: white;">{$r.stt}</label>
                            </td>
                          </tr>
                      </table>
                    </div>
                </div>
              </div>
            </li>
            {assign var=i value=$i+1}
            {/foreach}

        </ul>
</section>                    
				</div>
        <div class="col-md-4">{$right}</div>
        
			</div>
		</div>
	</div>
</div>