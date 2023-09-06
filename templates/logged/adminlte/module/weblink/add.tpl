<div class="box">
    <div class="box-body">
    <div class="row">
        
        <div class="col-md-12 text-right">
            {$navigasi} 
        </div>     
        <div class="col-md-12">

            <form id="multiform_add" method="POST" enctype="multipart/form-data">
                <div class="row form-group" hidden>
                    <div class="col-md-2">
                        <strong>Kategori</strong>
                    </div>
                    <div class="col-md-10">
                        <select name="kategori" class="form-control">
                            <option value="1"></option>
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <strong>Judul</strong>
                    </div>
                    <div class="col-md-10">
                        <input data-validation="required" data-validation-error-msg="Silahkan isi Judul" name="judul" type="text" class="form-control" id="judul" />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <strong>Link</strong>
                    </div>
                    <div class="col-md-10">
                        <input data-validation="required" data-validation-error-msg="Silahkan isi Judul" name="link" type="text" class="form-control" id="link" />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <strong>Gambar</strong>
                    </div>
                    <div class="col-md-4">
                        <input type="file" name="gambar" id="gambar" class="form-control">
                    </div>
                </div>
                
                <div class="row form-group">
                    <div class="col-md-10 col-md-offset-2">
                        <button class="btn btn-primary" id="btn_update"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>