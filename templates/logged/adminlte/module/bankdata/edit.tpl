<div class="box">
    <div class="box-body">
    <div class="row">
    <div class="col-md-12 text-right">
    {$navigasi}
</div>
<div class="col-md-12">
    <form action="?mode=admin&menu=bankdata&f=update" name="multiform_update" id="multiform_update" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="{$data.id}">
        <table class="table table-bordered">
            <tr>
                <td>Tanggal</td>
                <td>
                    <input style="width:200px" data-validation="required" data-validation-error-msg="Silahkan isi Tanggal" type="text" name="tanggal" class="form-control datetimepicker" value="{$data.tanggal}" />
                </td>
            </tr>
            <tr>
                <td>Judul</td>
                <td>
                    <input data-validation="required" data-validation-error-msg="Silahkan isi Judul" name="judul" type="text" class="form-control" id="judul" value="{$data.judul}" />
                </td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td>
                    <textarea id="isi" name="isi" class="editor">{$data.keterangan}</textarea>
                </td>
            </tr>
            <tr>
                <td>Ganti File Lampiran</td>
                <td>{if !empty($data.namafile)}
                    <a href="files/bankdata/{$data.namafile}" target="_blank">{$data.namafile}</a>
                    <br> {/if}
                    <input type="file" name="file" id="file" />
                </td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <select name="status" class="form-control" style="width:200px">
                        <option value="1" {if $data.status eq '1'} selected {/if}>Publish</option>
                        <option value="0" {if $data.status eq '0'} selected {/if}>Un Publish</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button id="btn_update" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </td>
            </tr>
        </table>
    </form>
</div>
</div>
</div>
</div>