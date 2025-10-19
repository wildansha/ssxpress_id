<?= $this->extend('template'); ?>
<?= $this->section('main'); ?>
<div class="container-fluid  mt-3">
    <div class="mx-auto" style="max-width: 500px;">

        <div class="row">
            <div class="col-12 mb-2">
                <span class="rounded px-3 py-1 bg-secondary" style="color: white;">#<?= $jastip['status_name'] ?></span>
            </div>

        </div>
        <div class="card shadow-sm mb-2">
            <div class="card-body pb-0">
                <?php $total_harga = 0; ?>
                <?php for ($i = 0; $i < count($jastip["list_product"]); $i++) { ?>
                    <?php $total_harga += ($jastip['list_product'][$i]["harga"] * $jastip['list_product'][$i]["qty"]); ?>

                    <div class="row">
                        <div class="col-sm-2 col-4 mb-2 text-center">
                            <img src="<?= base_url("assets/img/product/" . $jastip['list_product'][$i]['foto1']) ?>" class="w-100" onclick="location.href='<?= base_url('jastip/product_detail/' . $jastip['list_product'][$i]['slug']) ?>'" style="border-radius: 10px;border:1px solid black;max-width: 50px;">
                        </div>
                        <div class="col-sm-10 col-8 mb-2">
                            <p class="mb-0" onclick="location.href='<?= base_url('jastip/product_detail/' . $jastip['list_product'][$i]['slug']) ?>'" style="font-weight: bold;"><?= $jastip['list_product'][$i]["product_name"] ?></p>
                            <div class="row">
                                <div class="col-6">
                                    <p class="mb-0" style="color: maroon;">Rp <?= $jastip['list_product'][$i]["harga"] . " x" . $jastip['list_product'][$i]["qty"] ?></p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-0 text-right" style="color: maroon;">Rp <?= $jastip['list_product'][$i]["harga"] * $jastip['list_product'][$i]["qty"] ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-2">
                            <hr class="my-0">
                        </div>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="col-6 mb-2">
                    </div>
                    <div class="col-6 mb-2">
                        <p class="mb-0 text-right" style="color: maroon;font-weight: bold;">Rp <?= $total_harga ?></p>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-success my-2 w-100"><i class="fas fa-fw fa-user"></i> Chat Admin</button>

    </div>
</div>


<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>

</script>
<?= $this->endSection(); ?>