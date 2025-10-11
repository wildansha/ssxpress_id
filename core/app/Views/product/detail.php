<?= $this->extend('template'); ?>

<?= $this->section('meta_property'); ?>

<!-- HTML Meta Tags -->
<title><?= $product['nama']; ?></title>
<meta name="description" content="">

<!-- Facebook Meta Tags -->
<meta property="og:type" content="website">
<meta property="og:title" content="<?= $product['nama']; ?>">
<meta property="og:description" content="<?= $product['kategori']; ?>">
<meta property="og:image" content="<?= $urlFoto . $product['foto1']; ?>">

<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= $product['nama']; ?>">
<meta name="twitter:description" content="<?= $product['kategori']; ?>">
<meta name="twitter:image" content="<?= $urlFoto . $product['foto1']; ?>">

<?= $this->endSection(); ?>

<?= $this->section('main'); ?>

<main>
    <br>
    <div class="container detail_product">
        <div class="card card-detilproduct shadow-lg p-3 rounded">
            <div class="row ">
                <div class="col-md-4 col-12 my-1">
                    <div class="slider-promo">
                        <div class="slider-promo-isi">
                            <?php for ($x = 1; $x <= 5; $x++) { ?>
                                <!-- Ratio harus 20:10 -->
                                <?php if ($product['foto' . $x] != "") { ?>
                                    <img src="<?= $urlFoto . $product['foto' . $x]; ?>" class="rounded px-3">
                                <?php } ?>

                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-12">
                    <div class="row">
                        <p class="col-12 card-title" style="font-size: 16px !important;"><?= $product['nama']; ?></p>
                        <p class="col-12 card-subtitle" style="font-size: 16px !important;"><?= 'Rp ' . $product['harga']; ?></p>
                        <div class="col-12 mt-3">
                            <button class="btn btn-success px-3 w-100" onclick="add_keranjang(<?= $product['id']; ?>)" style="border-radius: 5px;">
                                + Keranjang
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- deskripsi -->
        <div class="container mt-3 p-3 shadow-lg ">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-fill" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#deskripsi">Deskripsi</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#link">Link Pembelian</a>
                </li> -->

            </ul>


            <!-- Tab panes -->
            <div class="tab-content">
                <div id="deskripsi" class="tab-pane active"><br>
                    <?= $product['deskripsi']; ?>
                </div>


                <div id="link" class="container tab-pane fade"><br>
                    <div class="row">
                        <div class="col-xl-4 col-sm-6 col-12 mt-3">

                        </div>

                    </div>
                </div>

            </div>
        </div>
        <!-- /deskripsi -->

        <br><br><br>




    </div>

</main>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>
    
</script>
<?= $this->endSection(); ?>