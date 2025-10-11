<?= $this->extend('template_admin'); ?>

<?= $this->section('main'); ?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="mt-3">
                    Form Tambah kategori
                </h2>
                <form action="<?= base_url("admin_kategori/save"); ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('kategori')) ? 'is-invalid' : ''; ?>" id="kategori" name="kategori" autofocus value="<?= old('kategori'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('kategori'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-sm-10">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('foto'); ?>
                                </div>
                                <label class="custom-file-label" for="foto">Pilih Gambar</label>
                            </div>
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