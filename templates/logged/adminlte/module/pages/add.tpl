<div class="box">
    <div class="box-body">
    <form id="multiform_add" method="POST" enctype="multipart/form-data">
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Kategori parent</strong>
            </div>
            <div class="col-md-10">
                <select name="parent" class="form-control">
                    <option value="0">Root Kategori</option>
                    {$parent}
                </select>   
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Urut</strong>
            </div>
            <div class="col-md-10">
                <input name="urut" type="text" class="form-control" id="urut" style="width:100px">    
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
                <strong>Isi</strong>
            </div>
            <div class="col-md-10">
                <textarea id="isi" name="isi" class="editor"></textarea>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Status</strong>
            </div>
            <div class="col-md-10">
                <select name="status" class="form-control" style="width:200px">
                    {$status}
                </select>  
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Module</strong>
            </div>
            <div class="col-md-10">
                <input name="module" type="text" class="form-control" id="module">    
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