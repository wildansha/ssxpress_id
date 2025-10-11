<?= $this->extend('template'); ?>

<?= $this->section('main'); ?>
<main>
    <br>
    <!-- card deck -->
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-12 mb-3">

                <button class="btn btn-kategori" data-toggle="collapse" data-target="#demo" style="
                 padding: 8px 8px 8px 40px;
                 color: white;
                 font-weight: bold;
                 background: var(--primary-color) url(<?php echo base_url('assets/img/icon/kategori.png'); ?>);
                 background-size: 25px 25px;
                 background-position: 8px 8px;
                 background-repeat: no-repeat; 
                ">
                    Kategori
                </button>
                <div id="demo" class="collapse">
                    <div class="row mt-3">
                        <?php foreach ($kategori_all as $k) : ?>
                            <div class="col-md-6 col-12">
                                <a class="btn btn-outline-dark d-block ml-auto <?= $kategori == $k['kategori'] ? 'disabled' : ''; ?>" href="<?php echo base_url('jastip/product/' . $k['kategori']); ?>">
                                    <div class="row">
                                        <div class="col-4 icon my-auto rounded">
                                            <img src="<?php echo base_url('assets/img/kategori/' . $k['foto']); ?>" class="m-auto rounded">
                                        </div>
                                        <div class="col-8  my-auto d-block  ">
                                            <p style="font-weight: bold;" class="my-auto"><?= $k['kategori']; ?></p>
                                        </div>

                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <form action="#" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="keyword" value="<?= $keyword; ?>">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Cari</button>
                        </div>
                    </div>
                </form>
            </div>


            <h1 class="col-12 my-3" style="font-weight: bold;"> <?= $kategori ?> </h1>

            <!-- product -->
            <?php foreach ($product as $p) : ?>
                <div class="col-xl-3 col-md-4 col-6 my-3">
                    <div class="card rounded shadow-lg  p-1 text-center">
                        <a href="<?php echo base_url('jastip') . '/detail/' . $p['slug']; ?>">
                            <img src="<?= $urlFoto . '/' . $p['foto1']; ?>" class="rounded ">
                            <p class="card-title mt-2"><?= $p['nama']; ?></p>
                        </a>
                        <p class="card-subtitle">Rp <?= $p['harga']; ?></p>
                        <button class="btn btn-success w-100 mt-2" onclick="add_keranjang(<?= $p['id']; ?>)" style="border-radius: 5px;">
                            + Keranjang
                        </button>
                    </div>
                </div>

            <?php endforeach; ?>
            <!-- /product -->

            <div class="col-12 ">
                <div class="col-12 mr-auto">
                    <?= $pager->links('product', 'pagination'); ?>
                </div>
            </div>

        </div>
    </div>
    <!-- /card deck -->



</main>
<?= $this->endSection(); ?>