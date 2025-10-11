<?= $this->extend('template_admin'); ?>

<?= $this->section('main'); ?>
<main>
    <div class="container-fluid px-3">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="mt-3">
                    Form Tambah promo
                </h2>
                <form action="<?= base_url(); ?>/admin_promo/save" method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <label for="judul" class="col-sm-2 col-form-label">judul</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" autofocus value="<?= old('judul'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('judul'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="isi" class="col-sm-2 col-form-label">Isi</label>
                        <div class="col-sm-10">
                            <textarea id="isi" name="isi" class="form-control <?= ($validation->hasError('isi')) ? 'is-invalid' : ''; ?>"><?= old('isi'); ?></textarea>
                            <script>
                                window.addEventListener('load', (event) => {
                                    ckeditor('#isi')
                                });
                            </script>
                            <div class="invalid-feedback">
                                <?= $validation->getError('isi'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <p style="font-weight: bold; color: red;">Foto akan otomatis ratio 20:10 saat diupload nanti</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-sm-6">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input foto-input <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto" onchange="previewImg('')">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('foto'); ?>
                                </div>
                                <label class="custom-file-label foto-label" for="foto">Pilih Gambar</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <img class="foto-preview" style="max-height: 150px;">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary">Selesai</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


</main>
</body>
<?= $this->endSection(); ?>