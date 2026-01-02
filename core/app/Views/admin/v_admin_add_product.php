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
                <p class="mb-0" style="color: white;">Add Product</p>
            </div>
            <div class="card-body">
                <form id="form_input" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="nama">Nama Product</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="harga" name="harga" oninput="$(this).val('Rp '+format_angka($(this).val()))">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10">
                            <select name="kategori" class="form-control">
                                <?php foreach ($kategori_all as $k) : ?>
                                    <option value="<?= $k['kategori']; ?>">
                                        <?= $k['kategori']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea id="deskripsi" name="deskripsi" class="form-control" oninput="auto_grow(this)"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="berat" class="col-sm-2 col-form-label">Berat (Gram)</label>
                        <div class="col-sm-10">
                            <input type="number" id="berat" name="berat" class="form-control">
                        </div>
                    </div>

                    <hr class="mt-5" style="border: 1px solid black;">


                    <p class="mb-0" style="font-weight: bold;font-size: 18px;">Foto Product</p>
                    <p style="font-weight: bold; color: red;font-size: 12px;">*Foto akan otomatis di resize persegi saat diupload nanti</p>

                    <?php for ($i = 1; $i <= 5; $i++) { ?>
                        <p class="mb-0 col-form-label">Foto <?= $i ?></p>
                        <div class="row">
                            <div class="col">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="foto<?= $i ?>" name="foto<?= $i ?>" onchange="previewImg(<?= $i ?>)" accept="image/*">
                                    <label id="foto-label<?= $i ?>" class="custom-file-label" for="foto<?= $i ?>">Pilih Gambar</label>
                                </div>
                                <div class="w-100 text-center my-3">
                                    <img id="foto-preview<?= $i ?>" style="width: 100%;max-width: 350px;">
                                </div>
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-danger" onclick="hapusFotoProduct(<?= $i ?>)" style="font-size: 14px;"><i class="fas fa-fw fa-trash"></i></button>
                            </div>
                        </div>

                    <?php  } ?>

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
        function hapusFotoProduct(index) {
            // kosongkan input file
            $('#foto' + index).val('');
            $('#foto-label' + index).text('Pilih Gambar');

            // hapus preview
            $('#foto-preview' + index)
                .attr('src', '')
                .hide();
        }

        function previewImg(idx) {
            const foto = document.querySelector("#foto" + idx);
            const fotoLabel = document.querySelector("#foto-label" + idx);
            const imgPreview = document.querySelector("#foto-preview" + idx);

            const fileFoto = new FileReader();
            fileFoto.readAsDataURL(foto.files[0]);

            fileFoto.onload = function(event) {
                imgPreview.src = event.target.result;
            };

            fotoLabel.textContent = foto.files[0].name;
        }


        $("#form_input").on("submit", function(e) {
            e.preventDefault();
            $('#modal_loading').modal("show");
            var formData = new FormData($("#form_input")[0]);
            $.ajax({
                method: 'POST',
                url: '<?= base_url("admin/ajax_insert_product") ?>',
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