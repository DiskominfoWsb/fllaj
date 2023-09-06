<div class="box">
    <div class="box-body">
    <form id="multiform_add" method="POST" enctype="multipart/form-data">
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Gambar</strong>
            </div>
            <div class="col-md-10">
                <input type="file" name="gambar[]" class="form-control" id="file">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Status</strong>
            </div>
            <div class="col-md-10">
                <select name="status" class="form-control" style="width:200px">
                    <option value="1">Publish</option>
                    <option value="0">Un Publish</option>
                </select>
            </div>
        </div>
        
        <div class="row form-group">
            <div class="col-md-10 offset-md-2">
                <button class="btn btn-primary" id="btn_update"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
    </form>
</div>
</div>