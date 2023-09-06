<div class="box">
    <div class="box-body">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 text-right">
                    {$navigasi} 
                </div>         
            </div>
            <form id="multiform_add" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="{$data.user_id}" />
                <div class="row form-group">
                    <div class="col-md-2">
                        <strong>Username</strong>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="username" value="{$data.username}" class="form-control" />
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
                        <select name="level_akses" class="form-control">
                            <option {if $data.level_akses eq '1'} selected {/if} value="1">Admin</option>
                            <option {if $data.level_akses eq '2'} selected {/if} value="2">Operator</option>
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <strong>Nama Lengkap</strong>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="nama_lengkap" value="{$data.nama_lengkap}" class="form-control" />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <strong>No. Telepon</strong>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="no_hp" value="{$data.no_hp}" class="form-control" />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <strong>Email</strong>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="email" value="{$data.email}" class="form-control" />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <strong>Foto</strong>
                    </div>
                    <div class="col-md-10">
                        <input type="file" name="foto[]" class="form-control" />
                        <img src="{$foto}" style="max-height: 175px; height: 175px; box-shadow: 2px 2px 10px;">
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