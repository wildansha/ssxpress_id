<?= $this->extend('template_admin'); ?>
<?= $this->section('main'); ?>
<div class="container-fluid  mt-3">
    <span class="rounded px-3 py-1 bg-secondary" style="color: white;">#<?= $jastip['status_name'] ?></span>

    <form id="form_validasi_jastip">
        <div class="row">
            <div class="col-md-4  mb-2">
                <div class="card shadow my-2">
                    <div class="card-body">
                        <?php $total_harga = 0; ?>
                        <?php for ($i = 0; $i < count($jastip["list_product"]); $i++) { ?>
                            <?php $total_harga += ($jastip['list_product'][$i]["harga"] * $jastip['list_product'][$i]["qty"]); ?>
                            <table class="w-100" style="table-layout: auto;">
                                <tr>
                                    <td style="text-align: center;">
                                        <img src="<?= base_url("assets/img/product/" . $jastip['list_product'][$i]['foto1']) ?>" onclick="location.href='<?= base_url('jastip/product_detail/' . $jastip['list_product'][$i]['slug']) ?>'" style="border-radius: 10px;border:1px solid black;width: 50px;">
                                    </td>
                                    <td>
                                        <p class="mb-0" onclick="location.href='<?= base_url('jastip/product_detail/' . $jastip['list_product'][$i]['slug']) ?>'" style="font-weight: bold;"><?= $jastip['list_product'][$i]["product_name"] ?></p>
                                        <div class="row">
                                            <div class="col-6">
                                                <p class="mb-0" style="color: maroon;">Rp <?= $jastip['list_product'][$i]["harga"] . " x" . $jastip['list_product'][$i]["qty"] ?></p>
                                            </div>
                                            <div class="col-6">
                                                <p class="mb-0 text-right" style="color: maroon;">Rp <?= $jastip['list_product'][$i]["harga"] * $jastip['list_product'][$i]["qty"] ?></p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                        <?php } ?>
                        <hr class="my-2">
                        <p class="mb-0 text-right" style="color: maroon;font-weight: bold;">Rp <?= $total_harga ?></p>


                    </div>
                </div>
            </div>
            <div class="col-md-8 mb-2">
                <div class="card shadow my-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <p class="mb-0" style="font-weight: bold;">Pembeli</p>
                                <input disabled type="text" class="form-control" value="<?= $jastip["email"] ?>">
                            </div>
                            <div class="col-md-6 mb-2">
                                <p class="mb-0" style="font-weight: bold;">Waktu</p>
                                <input disabled type="text" class="form-control" value="<?= $jastip["created_at"] ?>">
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </form>


</div>


<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>

</script>
<?= $this->endSection(); ?>