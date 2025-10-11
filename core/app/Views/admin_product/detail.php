<?= $this->extend('template_admin'); ?>

<?= $this->section('main'); ?>
<main>
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-12">
                <h2>
                    Detail product
                </h2>
                <form action="<?= base_url(); ?>/admin_product/update/<?= $product['id']; ?>" method="POST" class="mt-3" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="slug" value="<?= $product['slug']; ?>">

                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" autofocus value="<?= (old('nama')) ? old('nama') : $product['nama']; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('harga')) ? 'is-invalid' : ''; ?>" id="harga" name="harga" value="<?= (old('harga')) ? old('harga') : $product['harga']; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('harga'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10">
                            <select name="kategori" class="form-control">

                                <?php

                                use App\Controllers\Product;

                                if (old('kategori') != null) { ?>
                                    <option value="<?= old('kategori'); ?>" selected><?= old('kategori'); ?></option>

                                <?php } else { ?>
                                    <option value="<?= $product['kategori']; ?>" selected><?= $product['kategori']; ?></option>
                                <?php } ?>


                                <?php foreach ($kategori_all as $k) : ?>
                                    <?php if ($k['kategori'] != old('kategori') && $k['kategori'] != $product['kategori']) { ?>
                                        <option value="<?= $k['kategori']; ?>"> <?= $k['kategori']; ?> </option>
                                    <?php } ?>
                                <?php endforeach; ?>
                            </select>

                            <div class="invalid-feedback">
                                <?= $validation->getError('kategori'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea class="form-control <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : ''; ?>" id="deskripsi" name="deskripsi"><?= (old('deskripsi')) ? old('deskripsi') : $product['deskripsi']; ?></textarea>
                            <script>
                                window.addEventListener('load', (event) => {
                                    ckeditor('#deskripsi')
                                });
                            </script>
                            <div class="invalid-feedback">
                                <?= $validation->getError('deskripsi'); ?>
                            </div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-12">
                            <p style="font-weight: bold; color: red;">Foto akan otomatis di resize persegi saat diupload nanti</p>
                        </div>
                    </div>

                    <?php for ($i = 1; $i <= 5; $i++) { ?>
                        <input type="hidden" class="form-control" name="foto<?= $i ?>Lama" value="<?= $product['foto' . $i]; ?>">
                        <input type="hidden" class="form-control" name="hapusFoto<?= $i ?>" id="hapusFoto<?= $i ?>" value="">


                        <div class="form-group row">
                            <label for="foto<?= $i ?>" class="col-sm-2 col-form-label">Foto <?= $i ?></label>
                            <div class="col-sm-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input foto-input<?= $i ?> <?= ($validation->hasError('foto' . $i)) ? 'is-invalid' : ''; ?>" id="foto<?= $i ?>" name="foto<?= $i ?>" onchange="previewImg(<?= $i ?>)">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('foto' . $i); ?>
                                    </div>
                                    <label class="custom-file-label foto-label<?= $i ?>" for="foto<?= $i ?>"><?= $product['foto' . $i]; ?></label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <input type="hidden" name="hapusFoto<?= $i ?> id=" hapusFoto<?= $i ?>" value="">
                                <div class="btn btn-danger" onclick="hapusFotoProduct(<?= $i ?>); hapusFotoProductServer(<?= $i ?>);">Hapus</div>
                            </div>
                            <div class="col-sm-2">
                                <img src="<?= base_url(); ?>/assets/img/product/<?= $product['foto' . $i] ?>" class="foto-preview<?= $i ?>" style="max-height: 150px;">
                            </div>
                        </div>




                    <?php } ?>


                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Selesai Edit</button>
                        </div>
                    </div>
                </form>

                <form action="<?= base_url(); ?>/admin_product/<?= $product['id']; ?>" method="POST">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="delete">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin Menghapus?');">HAPUS</button>
                </form>


            </div>
        </div>
    </div>


</main>
</body>
<?= $this->endSection(); ?>