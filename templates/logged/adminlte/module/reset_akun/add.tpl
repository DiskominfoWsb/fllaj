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
                        <strong>Daerah Asal</strong>
                    </div>
                    <div class="col-md-2">
                        <!-- <input type="text" name="daerah_asal"  class="form-control" /> -->
                        <select class="select2 form-control" name="daerah_asal" id="pilih_provinsi">
                            <option value=""> -- Pilih Daerah Asal -- </option>
                            {$provinsi}
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <strong>Nama Lengkap</strong>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="nama"  class="form-control" />
                    </div>
                </div>
                    
                <div class="row form-group">
                    <div class="col-md-2">
                        <strong>Jabatan</strong>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="jabatan"  class="form-control" />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <strong>No. Telepon</strong>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="telp"  class="form-control" />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <strong>Lampiran</strong>
                    </div>
                    <div class="col-md-5">
                        <input type="file" name="lampiran" class="form-control">
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