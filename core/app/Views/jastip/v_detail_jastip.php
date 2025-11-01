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
                                    <p class="mb-0" style="color: maroon;">Rp <?= number_format($jastip['list_product'][$i]["harga"], 0, ',', '.') . " x" . $jastip['list_product'][$i]["qty"] ?></p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-0 text-right" style="color: maroon;">Rp <?= number_format($jastip['list_product'][$i]["harga"] * $jastip['list_product'][$i]["qty"], 0, ',', '.') ?></p>
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
                        <p class="mb-0 text-right" style="color: maroon;font-weight: bold;">Rp <?= number_format($total_harga, 0, ',', '.') ?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($jastip["status"] == 0) { ?>
            <a href="https://wa.me/6285315999960?text=Saya mau bayar ssxpress.id/konfirmasi_jastip/detail/<?= $jastip["id"] ?>'">
                <button class="btn btn-success my-2 w-100">
                    <i class="fas fa-fw fa-user"></i> Chat Admin
                </button>
            </a>
        <?php } else if ($jastip["status"] == 1) { ?>
            <div class="mx-auto" style="max-width: 500px;">
                <?php if (isset($order_dn)) { ?>
                    <?php if (isset($trackings)) { ?>
                        <div class="row my-3">
                            <div class="col-12">
                                <div class="card shadow">
                                    <div class="card-header" style="color: white;border-top-left-radius: 10px;border-top-right-radius: 10px;">
                                        <p class="text-center" style="font-size: 25px;text-transform: uppercase;font-weight: bold;"><?= 'SSN' . $order_dn["id"]; ?></p>
                                        <p class="text-center mb-0" style="font-weight: bold;font-size: 18px;"><?= strtoupper($order_dn["ekspedisi"]); ?></p>
                                        <p class="text-center" style="font-weight: bold;font-size: 18px;"><?= strtoupper($order_dn["resi"]); ?></p>
                                        <p class="text-center mb-0"><?= $order_dn["nama_penerima"]; ?></p>
                                        <p class="text-center" style="font-size: 14px;"><?= strtoupper($order_dn["alamat_penerima"] . ', ' . $order_dn["kecamatan_penerima"] . ', ' . $order_dn["kota_penerima"]) ?></p>
                                    </div>
                                    <div class="card-body" style="font-size: 15px;">
                                        <?php foreach ($trackings as $key => $r) { ?>
                                            <div class="row px-3">
                                                <div class="col-sm-2 col-4 border p-auto">
                                                    <img class="" src="<?= base_url('assets/img/icon/check.png'); ?>" style="width: 100%;height: 100%;object-fit: contain;">
                                                </div>
                                                <div class="col-sm-10 col-8 border p-3">
                                                    <span style="text-transform: uppercase;font-weight: bold;"><?= $r["status"]; ?></span>
                                                    <br>
                                                    <span style="text-transform: uppercase;"><?= $r["notes"]; ?></span>
                                                    <br>
                                                    <p style="text-transform: uppercase;"><?= $r["extra"]; ?></p>
                                                    <p>
                                                        <?= $r["date"]; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="row  my-3">
                            <div class="col-12">
                                <div class="card shadow">
                                    <div class="card-header bg_primary" style="color: white;border-top-left-radius: 10px;border-top-right-radius: 10px;">
                                        <p class="text-center" style="font-size: 25px;text-transform: uppercase;font-weight: bold;"><?= 'SSN' . $order_dn["id"]; ?></p>
                                        <p class="text-center mb-0" style="font-weight: bold;font-size: 18px;text-transform: uppercase;"><?= $order_dn["ekspedisi"]; ?></p>
                                        <p class="text-center" style="font-weight: bold;font-size: 18px;text-transform: uppercase;"><?= $order_dn["resi"]; ?></p>
                                        <p class="text-center mb-0" style="text-transform: uppercase;font-weight: bold;"><?= $order_dn["nama_penerima"]; ?></p>
                                        <p class="text-center" style="font-size: 12px;text-transform: uppercase;"><?= $order_dn["alamat_penerima"] . ', ' . $order_dn["kecamatan_penerima"] . ', ' . $order_dn["kota_penerima"] ?></p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } elseif (isset($order_ln)) { ?>
                    <?php if (isset($trackings)) { ?>
                        <div class="row  my-3">
                            <div class="col-12">
                                <div class="card shadow">
                                    <div class="card-header bg_primary" style="color: white;border-top-left-radius: 10px;border-top-right-radius: 10px;">
                                        <p class="text-center" style="font-weight: bold;font-size: 18px;"><?= $order_ln["ekspedisi"]; ?></p>
                                        <p class="text-center" style="font-size: 25px;text-transform: uppercase;font-weight: bold;"><?= 'SSIN' . $order_ln["id"]; ?></p>
                                        <p class="text-center mb-0"><?= $order_ln["nama_penerima"]; ?></p>
                                        <p class="text-center" style="font-size: 14px;"><?= $order_ln["alamat_penerima"]; ?>, <?= $order_ln["negara_penerima"]; ?></p>

                                    </div>
                                    <div class="card-body" style="font-size: 15px;">
                                        <?php foreach ($trackings as $key => $r) { ?>
                                            <div class="row px-3">
                                                <div class="col-sm-2 col-4 border p-auto">
                                                    <img class="" src="<?= base_url('assets/img/icon/check.png'); ?>" style="width: 100%;height: 100%;object-fit: contain;">
                                                </div>
                                                <div class="col-sm-10 col-8 border p-3">
                                                    <span style="text-transform: uppercase;font-weight: bold;"><?= $r["status"]; ?></span>
                                                    <br>
                                                    <span style="text-transform: uppercase;"><?= $r["notes"]; ?></span>
                                                    <br>
                                                    <p style="text-transform: uppercase;"><?= $r["extra"]; ?></p>
                                                    <p>
                                                        <?= $r["date"]; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="row  my-3">
                            <div class="col-12">
                                <div class="card shadow">
                                    <div class="card-header bg_primary" style="color: white;border-top-left-radius: 10px;border-top-right-radius: 10px;">
                                        <p class="text-center" style="font-weight: bold;font-size: 18px;text-transform: uppercase;"><?= $order_ln["ekspedisi"]; ?></p>
                                        <p class="text-center" style="font-size: 25px;text-transform: uppercase;font-weight: bold;"><?= 'SSIN' . $order_ln["id"]; ?></p>
                                        <p class="text-center mb-0" style="text-transform: uppercase;font-weight: bold;"><?= $order_ln["nama_penerima"]; ?></p>
                                        <p class="text-center" style="font-size: 12px;text-transform: uppercase;"><?= $order_ln["alamat_penerima"]; ?>, <?= $order_ln["negara_penerima"]; ?></p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php } ?>

                <?php } ?>
            </div>

        <?php } ?>
    </div>

</div>


<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>

</script>
<?= $this->endSection(); ?>