<?= $this->extend('template_admin'); ?>

<?= $this->section('main'); ?>
<main>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="mt-2">Kategori Product</h1>
                <a href="<?= base_url('admin_kategori/create'); ?>" class="btn btn-primary my-3">Tambah kategori</a>

            </div>
            <div class="col-12">
                <form action="/admin_kategori" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Masukkan Pencarian....." name="keyword">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
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
                            <th scope="col">kategori</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 + ($dataPerPage * ($currentPage - 1)); ?>

                        <?php foreach ($kategori as $p) : ?>

                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $p['kategori']; ?></td>
                                <td>
                                    <img src="<?= base_url("assets/img/kategori/".$p['foto']); ?>" width="100">
                                </td>
                                <td>
                                    <a href="<?= base_url("admin_kategori/" . $p['kategori']); ?>" class="btn btn-primary">Detail</a>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="col-12 ">
                <?= $pager->links('kategori', 'pagination'); ?>
            </div>
        </div>
    </div>

</main>
</body>
<?= $this->endSection(); ?>