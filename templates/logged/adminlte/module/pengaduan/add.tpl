<div class="box">
    <div class="box-body">

    <form id="multiform_add" method="POST" enctype="multipart/form-data">
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Kategori</strong>
            </div>
            <div class="col-md-10">
                <input value="{$data.urai}" class="form-control" disabled>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Nama</strong>
            </div>
            <div class="col-md-10">
                <input value="{$data.nama}" class="form-control" disabled>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Email</strong>
            </div>
            <div class="col-md-10">
                <input value="{$data.email}" class="form-control" disabled>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>No. Telp</strong>
            </div>
            <div class="col-md-10">
                <input value="{$data.hp}" class="form-control" disabled>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Pesan</strong>
            </div>
            <div class="col-md-10">
                <textarea class="form-control" disabled>{$data.nama}</textarea>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <strong>Respon</strong>
            </div>
            <div class="col-md-10">
                <textarea class="form-control editorhtml" name="pesan">{$respon.pesan}</textarea>
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