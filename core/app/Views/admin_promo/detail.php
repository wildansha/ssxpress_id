<?= $this->extend('template_admin'); ?>

<?= $this->section('main'); ?>
<main>
    <div class="container-fluid p-3 admin_promo">
        <div class="row">
            <div class="col-12">
                <h2>
                    Detail promo
                </h2>
                <form action="<?= base_url(); ?>/admin_promo/update/<?= $promo['id']; ?>" method="POST" class="mt-3" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="fotoLama" value="<?= $promo['foto']; ?>">

                    <div class="form-group row">
                        <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" autofocus value="<?= (old('judul')) ? old('judul') : $promo['judul']; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('judul'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="isi" class="col-sm-2 col-form-label">isi</label>
                        <div class="col-sm-10">
                            <textarea class="form-control <?= ($validation->hasError('isi')) ? 'is-invalid' : ''; ?>" id="isi" name="isi"><?= (old('isi')) ? old('isi') : $promo['isi']; ?></textarea>
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
                                <label class="custom-file-label foto-label" for="foto"><?= $promo['foto']; ?></label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <img src="<?= base_url(); ?>/assets/img/promo/<?= $promo['foto'] ?>" class="foto-preview " style="max-height: 150px;">
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Selesai Edit</button>
                        </div>
                    </div>
                </form>

                <form action="<?= base_url(); ?>/admin_promo/<?= $promo['id']; ?>" method="POST">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="delete">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin Menghapus?');">HAPUS</button>
                </form>


            </div>

        </div>
    </div>


</main>
<script>
    InlineEditor
        .create(document.querySelector('#coba'))
        .catch(error => {
            console.error(error);
        });
</script>
</body>
<?= $this->endSection(); ?>