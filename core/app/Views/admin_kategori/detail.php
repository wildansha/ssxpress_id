<?= $this->extend('template_admin'); ?>

<?= $this->section('main'); ?>
<main>
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-8">
                <h2>
                    Detail kategori
                </h2>
                <form action="<?= base_url("admin_kategori/update/" . $kategori['kategori']); ?>" method="POST" class="mt-3" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="fotoLama" value="<?= $kategori['foto']; ?>">
                    <input type="hidden" name="kategoriLama" value="<?= $kategori['kategori']; ?>">

                    <div class="form-group row">
                        <label for="kategori" class="col-sm-2 col-form-label">Nama Kategori</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('kategori')) ? 'is-invalid' : ''; ?>" id="kategori" name="kategori" autofocus value="<?= (old('kategori')) ? old('kategori') : $kategori['kategori']; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('kategori'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="foto" class="col-sm-2 col-form-label">Foto</label>

                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto" onchange="previewImg()">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('foto'); ?>
                                </div>

                                <label class="custom-file-label" for="foto"><?= $kategori['foto']; ?></label>
                            </div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Selesai Edit</button>
                        </div>
                    </div>
                </form>

                <form action="<?= base_url("admin_kategori/" . $kategori['kategori']); ?>" method="POST">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="delete">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin Menghapus?');">HAPUS</button>
                </form>


            </div>
            <div class="col-sm-4">
                <img src="<?= base_url("assets/img/kategori/" . $kategori['foto']); ?>" class="img-thumbnail img-preview" onchange="previewImg()">
            </div>
        </div>
    </div>


</main>
</body>
<?= $this->endSection(); ?>