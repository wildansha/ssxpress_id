<?= $this->extend('template'); ?>

<?= $this->section('main'); ?>

<main>
    <div class="container-fluid">
        <div class="mx-auto" style="max-width: 500px;">
            <div class="row mx-auto mt-3">
                <div class="col-12 mb-3">
                    <img src="<?= base_url("assets/img/dashboard.jpeg") ?>" class="w-100 shadow" style="border-radius: 10px;">
                </div>
                <div class="col-4">
                    <button class="btn btn-secondary p-3 w-100 bg_primary" style="border-radius: 20px;">
                        <i class="fas fa-fw fa-dollar-sign"></i>
                        <p class="mb-0">Ongkir</p>
                    </button>
                </div>
                <div class="col-4">
                    <button class="btn btn-secondary p-3 w-100 bg_primary" style="border-radius: 20px;">
                        <i class="fas fa-fw fa-user"></i>
                        <p class="mb-0">Agen</p>
                    </button>
                </div>
                <div class="col-4">
                    <button class="btn btn-secondary p-3 w-100 bg_primary" onclick="location.href='<?= base_url('jastip') ?>'" style="border-radius: 20px;">
                        <i class="fas fa-fw fa-truck"></i>
                        <p class="mb-0">SS Jastip</p>
                    </button>
                </div>
                <div class="col-12 mt-3">
                    <div class="shadow p-3" style="border-radius: 10px;background-color: white;">
                        <form action="#">
                            <input required type="text" id="input_resi" name="id_order" class="form-control" placeholder="ID Order" value="<?= isset($id_order) ? $id_order : "" ?>">
                            <button class="btn btn-secondary bg_primary w-100 mt-2">Lacak Paket</button>
                        </form>
                    </div>
                </div>
                <div class="col-12 mt-3" id="wrapper_tracking">
                    <?php if (isset($order_dn)) { ?>
                        <?php if (isset($trackings)) { ?>
                            <div class="row my-3">
                                <div class="col-12">
                                    <div class="card shadow">
                                        <div class="card-header bg_primary" style="color: white;border-top-left-radius: 10px;border-top-right-radius: 10px;">
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

                    <?php } elseif (isset($id_order)) { ?>
                        <div class="row m-1">
                            <div class="card w-100">
                                <div class="card-header bg_primary" style="color: white;border-top-left-radius: 10px;border-top-right-radius: 10px;"><?= $id_order; ?></div>
                                <div class="card-body">
                                    <p style="text-align: center;font-size: 20px;font-weight: bolder;color: darkred;">
                                        ID ORDER TIDAK DITEMUKAN
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php }  ?>
                </div>
            </div>

        </div>
    </div>
</main>


</body>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?>

<script>
    <?php if (isset($id_order)) { ?>
        window.scrollTo({
            top: document.getElementById("wrapper_tracking").offsetTop - 55,
            behavior: "smooth"
        });
    <?php }  ?>
</script>

<?= $this->endSection(); ?>