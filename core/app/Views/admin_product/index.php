<?php
$this->extend('template_admin');
$this->section('main'); ?>

<main>

    <div class="container">
        <h1 class="mt-2">ADMIN product</h1>

        <div class="row">
            <div class="col">
                <a href="<?= base_url(); ?>/admin_product/create" class="btn btn-primary my-3">Tambah product</a>
            </div>
            <div class="col">
                <a href="<?= base_url(); ?>/admin_kategori" class="btn btn-primary my-3">Atur Kategori</a>
            </div>
            <div class="col-12">
                <form action="<?= base_url(); ?>/admin_product" method="GET">
                    <select name='kategori' onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>

                        <?php if ($kategori != null) { ?>
                            <option value="<?= $kategori; ?>" selected><?= $kategori; ?></option>
                        <?php } ?>


                        <?php foreach ($kategori_all as $k) : ?>
                            <?php if ($k['kategori'] != $kategori) { ?>
                                <option value="<?= $k['kategori']; ?>"> <?= $k['kategori']; ?> </option>
                            <?php } ?>

                        <?php endforeach; ?>
                    </select>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Masukkan Pencarian....." name="keyword" value="<?= $keyword; ?>">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" onclick="this.form.submit()">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 mt-3">
                <?php

                use CodeIgniter\Filters\CSRF;

                if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                    </div>
                <?php endif; ?>


                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 + ($dataPerPage * ($currentPage - 1)); ?>

                        <?php foreach ($product as $p) : ?>

                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $p['nama']; ?></td>
                                <td><?= $p['harga']; ?></td>
                                <td>
                                    <img src="<?= base_url(); ?>/assets/img/product/<?= $p['foto1']; ?>" width="100">
                                </td>
                                <td>
                                    <a href="<?= base_url(); ?>/admin_product/<?= $p['slug']; ?>" class="btn btn-primary">Detail</a>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="col-12 ">
                <?= $pager->links('product', 'pagination'); ?>
            </div>
        </div>
    </div>

</main>
</body>
<?= $this->endSection(); ?>