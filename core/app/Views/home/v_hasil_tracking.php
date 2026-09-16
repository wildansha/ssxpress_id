<?php if (isset($tracking_error)) { ?>
    <div class="alert alert-danger text-center my-3"><?= $tracking_error ?></div>
<?php } elseif (isset($order_dn) || isset($order_ln)) { ?>
    <?php $order = isset($order_dn) ? $order_dn : $order_ln; ?>
    <div class="row my-3">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-primary" style="color: white;border-top-left-radius: 10px;border-top-right-radius: 10px;">
                    <p class="text-center" style="font-size: 25px;text-transform: uppercase;font-weight: bold;"><?= isset($order_dn) ? 'SSN' . $order["id"] : 'SSIN' . $order["id"] ?></p>
                    <?php if (isset($order_dn)) { ?>
                        <p class="text-center" style="font-weight: bold;font-size: 18px;"><?= strtoupper($order["resi"]); ?></p>
                    <?php } ?>
                    <p class="text-center mb-0"><?= $order["nama_penerima"]; ?></p>
                    <p class="text-center" style="font-size: 14px;">
                        <?php if (isset($order_dn)) { ?>
                            <?= strtoupper($order["alamat_penerima"] . ', ' . $order["kecamatan_penerima"] . ', ' . $order["kota_penerima"]) ?>
                        <?php } else { ?>
                            <?= $order["alamat_penerima"]; ?>, <?= $order["negara_penerima"]; ?>
                        <?php } ?>
                    </p>
                </div>
                <?php if (isset($trackings)) { ?>
                    <div class="card-body" style="font-size: 15px;">
                        <?php foreach ($trackings as $key => $r) { ?>
                            <div class="row px-3">
                                <div class="col-sm-2 col-4 border p-auto">
                                    <img src="<?= base_url('assets/img/icon/check.png'); ?>" style="width: 100%;height: 100%;object-fit: contain;">
                                </div>
                                <div class="col-sm-10 col-8 border p-3">
                                    <span style="text-transform: uppercase;font-weight: bold;"><?= $r["status"]; ?></span><br>
                                    <span style="text-transform: uppercase;"><?= $r["notes"]; ?></span><br>
                                    <p style="text-transform: uppercase;"><?= $r["extra"]; ?></p>
                                    <p><?= $r["date"]; ?></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="alert alert-danger text-center my-3">Tidak ditemukan atau no HP salah</div>
<?php } ?>
