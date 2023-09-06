<div class="box">
    <div class="box-body">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 text-right">
                    {$navigasi} 
                </div>         
            </div>
            <form id="multiform_add" method="POST" enctype="multipart/form-data">
                <div class="row form-group">
                    <div class="col-md-2">
                        <strong>Username</strong>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="username"  class="form-control" />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <strong>Password</strong>
                    </div>
                    <div class="col-md-10">
                        <input type="password" name="password" class="form-control" />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <strong>Level Akses</strong>
                    </div>
                    <div class="col-md-10">
                        <select name="level_akses" class="form-control level_akses">
                            <option value="1">Admin</option>
                            <option value="2">Operator</option>
                        </select>
                    </div>
                </div>
                <div id="kabupaten">
                    
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <strong>Nama Lengkap</strong>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="nama_lengkap"  class="form-control" />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <strong>No. Telepon</strong>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="no_hp"  class="form-control" />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <strong>Email</strong>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="email"  class="form-control" />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <strong>Foto</strong>
                    </div>
                    <div class="col-md-10">
                        <input type="file" name="foto[]" class="form-control" />
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