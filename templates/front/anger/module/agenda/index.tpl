<section class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Agenda</h2>
                    <div class="breadcrumb-option">
                        <a href="{$basedir}"><i class="fa fa-home"></i> Home</a>
                        <span>Agenda</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="blog-section blog-page spad">
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th style="text-align: center;" rowspan="2">No.</th>
                    <th style="text-align: center;" colspan="2">Waktu</th>
                    <th style="text-align: center;" rowspan="2">Judul</th>
                    <th style="text-align: center;" rowspan="2">Deskripsi</th>
                    <th style="text-align: center;" rowspan="2">Lokasi</th>
                </tr>
                <tr>
                    <th style="text-align: center;">Mulai</th>
                    <th style="text-align: center;">Selesai</th>
                </tr>
            </thead>
            <tbody>
                {$arr_data}
            </tbody>
        </table>
    </div>
</section>