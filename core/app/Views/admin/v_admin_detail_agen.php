<?= $this->extend('template_admin'); ?>

<?= $this->section('main'); ?>
<style>
    .col-form-label {
        font-weight: bold !important;
    }
</style>
<div class="container-fluid">
    <div class="card">
        <div class="card-header" style="font-weight: bold;">
            <p class="mb-0" style="color: white;">Detail Agen</p>
        </div>
        <div class="card-body">
            <form id="form_input" method="POST">
                <?php
                empty($list_kabupaten) ? $list_kabupaten = [] : "";
                empty($agen) ? $agen = [] : "";
                ?>

                <input type="hidden" name="id" value="<?= $agen["id"] ?>">

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="nama">Nama Agen</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $agen["nama"] ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="kabupaten" class="col-sm-2 col-form-label">Kabupaten / Kota</label>
                    <div class="col-sm-10">
                        <select name="kabupaten_id" class="select2">
                            <?php for ($i = 0; $i < count($list_kabupaten); $i++) { ?>
                                <option value="<?= $list_kabupaten[$i]["id"] ?>" <?= $list_kabupaten[$i]["id"] == $agen["kabupaten_id"] ? "selected" : "" ?>>
                                    <?= $list_kabupaten[$i]["jenis"] . " " . ucfirst($list_kabupaten[$i]["kabupaten"]) ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <textarea name="alamat" class="form-control" oninput="auto_grow(this)"><?= $agen["alamat"] ?></textarea>
                    </div>
                </div>

                <!-- <div class="form-group row">
                    <label for="telp" class="col-sm-2 col-form-label">Telp</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="081xxxxxxxx" name="telp">
                    </div>
                </div> -->

                <div class="form-group row">
                    <label for="link_gmaps" class="col-sm-2 col-form-label">Link Gmaps</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="link_gmaps" value="<?= $agen["link_gmaps"] ?>">
                    </div>
                </div>

                <div class="form-group row mt-5">
                    <div class="col-6">
                        <button type="button" class="btn btn-secondary w-100" onclick="document.referrer?history.back():location.href='<?= base_url('admin/agen') ?>'">Kembali</button>
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-success w-100">Simpan</button>
                    </div>
                </div>


            </form>
            <form id="form_delete">
                <input type="hidden" name="agen_id" value="<?= $agen["id"] ?>">
                <button type="button" class="btn btn-danger" id="btn_show_delete_confirm"><i class="fa fa-trash"></i> Hapus Agen</button>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_confirm_delete" tabindex="-1" aria-labelledby="modal_confirm_deleteLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modal_confirm_deleteLabel">Konfirmasi Hapus Agen</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus agen ini? Tindakan ini tidak bisa dibatalkan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="btn_confirm_delete"><i class="fa fa-trash"></i> Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(".select2").select2();

    function doDeleteAgen() {
        $('#modal_loading').modal("show");
        var formData = new FormData($("#form_delete")[0]);
        $.ajax({
            method: 'POST',
            url: '<?= base_url("admin/ajax_delete_agen") ?>',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                response = JSON.parse(response);
                if (response.status == 1) {
                    history.back();
                } else {
                    $('#modal_loading').modal("hide");
                    $('#modal_info').modal("show");
                    var error_txt = "";
                    var idx_i = 0;
                    for (const field in response.msg) {
                        error_txt += (idx_i + 1) + ". " + response.msg[field] + "<br>";
                        idx_i++;
                    }
                    $('#txt_modal_info').html(error_txt);
                }
            },
            error: function(xhr, status, error) {
                $('#modal_loading').modal("hide");
                console.error(error);
            },
        });
    }

    $("#form_input").on("submit", function(e) {
        e.preventDefault();
        $('#modal_loading').modal("show");
        var formData = new FormData($("#form_input")[0]);
        $.ajax({
            method: 'POST',
            url: '<?= base_url("admin/ajax_update_agen") ?>',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                response = JSON.parse(response);
                if (response.status == 1) {
                    history.back();
                } else {
                    $('#modal_loading').modal("hide");
                    $('#modal_info').modal("show");
                    var error_txt = "";
                    var idx_i = 0;
                    for (const field in response.msg) {
                        error_txt += (idx_i + 1) + ". " + response.msg[field] + "<br>";
                        idx_i++;
                    }
                    $('#txt_modal_info').html(error_txt);
                }
            },
            error: function(xhr, status, error) {
                $('#modal_loading').modal("hide");
                console.error(error);
            },
        });
        return false;
    });

    $("#btn_show_delete_confirm").on("click", function() {
        $('#modal_confirm_delete').modal('show');
    });

    $("#btn_confirm_delete").on("click", function() {
        $('#modal_confirm_delete').modal('hide');
        doDeleteAgen();
    });
</script>
</body>
<?= $this->endSection(); ?>