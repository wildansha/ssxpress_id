<div class="card shadow-sm mb-2">
    <div class="card-body pb-0">
        <div class="row" onclick="location.href='<?= base_url('admin_jastip/detail_jastip/' . $jastip_id) ?>'">
            <div class="col-sm-2 col-4 text-center mb-2">
                <img src="<?= base_url("assets/img/product") ?>/<?= $foto1 ?>" style="border-radius: 10px;border:1px solid black;width: 100%;max-width: 50px;">
            </div>
            <div class="col-sm-8 col-6 mb-2">
                <p class="mb-0" style="font-weight: bold;"><?= $product_name ?></p>
                <p class="mb-0" style="color: maroon;"><?= $harga ?></p>
            </div>
            <?php if ($jml_other > 0) { ?>
                <div class="col-12 mb-2">
                    <hr class="my-0">
                    <p class="mb-0 text-center" style="color:grey;font-size:12px !important;">+ <?= $jml_other ?> produk lainnya...</p>
                    <hr class="my-0">
                </div>
            <?php } else { ?>
            <?php } ?>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-12">
                <p class="mb-0" style="font-size:12px !important;color:grey"><? $waktu_pesan ?></p>
            </div>
        </div>
    </div>
</div>