<?= $this->extend('template_admin'); ?>

<?= $this->section('main'); ?>
<main>
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
                <form id="form_input" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="nama">Nama Agen</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="kabupaten" class="col-sm-2 col-form-label">Kabupaten / Kota</label>
                        <div class="col-sm-10">
                            <select name="kabupaten_id" class="select2">
                                <?php for ($i = 0; $i < count($list_kabupaten); $i++) { ?>
                                    <option value="<?= $list_kabupaten[$i]["id"] ?>"><?= $list_kabupaten[$i]["jenis"] ." ".ucfirst($list_kabupaten[$i]["kabupaten"]) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea name="alamat" class="form-control" oninput="auto_grow(this)"></textarea>
                        </div>
                    </div>

                
                    <div class="form-group row mt-5">
                        <div class="col-6">
                            <button type="button" class="btn btn-secondary w-100">Batal</button>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-success w-100">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(".select2").select2();


        $("#form_input").on("submit", function(e) {
            e.preventDefault();
            $('#modal_loading').modal("show");
            var formData = new FormData($("#form_input")[0]);
            $.ajax({
                method: 'POST',
                url: '<?= base_url("admin/ajax_insert_agen") ?>',
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
    </script>
</main>
</body>
<?= $this->endSection(); ?>