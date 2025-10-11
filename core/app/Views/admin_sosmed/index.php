<?= $this->extend('template_admin'); ?>

<?= $this->section('main'); ?>
<main>
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-8">
                <h2>
                    Detail sosmed
                </h2>
                <form action="<?= base_url(); ?>/admin_sosmed/update/<?= $sosmed['id']; ?>" method="POST" class="mt-3" enctype="multipart/form-data">
                    <?= csrf_field(); ?>

                    <div class="form-group row">
                        <label for="whatsapp" class="col-sm-2 col-form-label">Whatsapp</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('whatsapp')) ? 'is-invalid' : ''; ?>" id="whatsapp" name="whatsapp" value="<?= (old('whatsapp')) ? old('whatsapp') : $sosmed['whatsapp']; ?>">
                            <div class=" invalid-feedback">
                                <?= $validation->getError('whatsapp'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="telp" class="col-sm-2 col-form-label">Telp</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('telp')) ? 'is-invalid' : ''; ?>" id="telp" name="telp" value="<?= (old('telp')) ? old('telp') : $sosmed['telp']; ?>">
                            <div class=" invalid-feedback">
                                <?= $validation->getError('telp'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="blog" class="col-sm-2 col-form-label">Blog</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('blog')) ? 'is-invalid' : ''; ?>" id="blog" name="blog" value="<?= (old('blog')) ? old('blog') : $sosmed['blog']; ?>">
                            <div class=" invalid-feedback">
                                <?= $validation->getError('blog'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?= (old('email')) ? old('email') : $sosmed['email']; ?>">
                            <div class=" invalid-feedback">
                                <?= $validation->getError('email'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Selesai Edit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>


</main>
</body>
<?= $this->endSection(); ?>