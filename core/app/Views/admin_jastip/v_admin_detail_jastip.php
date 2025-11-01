<?= $this->extend('template_admin'); ?>
<?= $this->section('main'); ?>
<div class="container-fluid  mt-3">
    <span class="rounded px-3 py-1 bg-secondary" style="color: white;">#<?= $jastip['status_name'] ?></span>


    <form id="form_proses">
        <input type="hidden" name="jastip_id" value="<?= $jastip["id"] ?>">
        <div class="modal" id="modal_proses" data-keyboard="false" tabindex="-1" aria-labelledby="modal_prosesLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title mb-0" style="font-size: 16px !important;"></p>
                        <button type="button" class="close" onclick="history.back()">
                            <span aria-hidden="true" style="font-size: 24px !important;">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-0" style="font-weight: bold;">Bukti Transfer</p>
                        <input required type="file" name="foto_bukti_bayar" class="py-2" accept="image/*">
                    </div>

                    <div class="modal-footer" style="text-align: center;">
                        <div class="w-100">
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" class="btn btn-secondary w-100" onclick="history.back()" style="font-weight: bold;">Batal</button>
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-success w-100" style="font-weight: bold;">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form id="form_tolak">
        <input type="hidden" name="jastip_id" value="<?= $jastip["id"] ?>">
        <div class="modal" id="modal_tolak" data-keyboard="false" tabindex="-1" aria-labelledby="modal_tolakLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title mb-0" style="font-size: 16px !important;"></p>
                        <button type="button" class="close" onclick="history.back()">
                            <span aria-hidden="true" style="font-size: 24px !important;">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-0" style="font-weight: bold;">Alasan Penolakan</p>
                        <select required name="alasan_tolak" class="form-control mb-2">
                            <option value="">-- Pilih Alasan --</option>
                            <?php for ($i = 0; $i < count($list_alasan_tolak); $i++) { ?>
                                <option value="<?= $list_alasan_tolak[$i]["id"] ?>"><?= $list_alasan_tolak[$i]["alasan"] ?></option>
                            <?php }  ?>
                        </select>
                        <p class="mb-0" style="font-weight: bold;">Keterangan Tambahan</p>
                        <textarea name="keterangan" class="form-control" oninput="auto_grow(this)" placeholder="-- Tidak Wajib --"></textarea>
                    </div>

                    <div class="modal-footer" style="text-align: center;">
                        <div class="w-100">
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" class="btn btn-secondary w-100" onclick="history.back()" style="font-weight: bold;">Batal</button>
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-danger w-100" style="font-weight: bold;">Tolak</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form id="form_input_resi">
        <input type="hidden" name="jastip_id" value="<?= $jastip["id"] ?>">
        <div class="modal" id="modal_input_resi" data-keyboard="false" tabindex="-1" aria-labelledby="modal_input_resiLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title mb-0" style="font-size: 16px !important;"></p>
                        <button type="button" class="close" onclick="history.back()">
                            <span aria-hidden="true" style="font-size: 24px !important;">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-0" style="font-weight: bold;">Alasan Penolakan</p>

                        <p class="mb-0" style="font-weight: bold;">Keterangan Tambahan</p>
                        <textarea name="keterangan" class="form-control" oninput="auto_grow(this)" placeholder="-- Tidak Wajib --"></textarea>
                    </div>

                    <div class="modal-footer" style="text-align: center;">
                        <div class="w-100">
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" class="btn btn-secondary w-100" onclick="history.back()" style="font-weight: bold;">Batal</button>
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-danger w-100" style="font-weight: bold;">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-xl-4  mb-2">
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
                                            <p class="mb-0" style="color: maroon;">Rp <?= number_format($jastip['list_product'][$i]["harga"]) . " x" . $jastip['list_product'][$i]["qty"] ?></p>
                                        </div>
                                        <div class="col-6">
                                            <p class="mb-0 text-right" style="color: maroon;">Rp <?= number_format($jastip['list_product'][$i]["harga"] * $jastip['list_product'][$i]["qty"]) ?></p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>

                    <?php } ?>
                    <hr class="my-2">
                    <p class="mb-0 text-right" style="color: maroon;font-weight: bold;"> <?= "Rp " . number_format($total_harga) ?></p>
                </div>
            </div>
        </div>
        <div class="col-xl-8 mb-2">
            <div class="card shadow my-2">
                <div class="card-body">
                    <p style="text-align: right;"><?= date("d-m-Y H:i:s", strtotime($jastip["created_at"])) ?></p>
                    <div class="row">
                        <div class="col-12 mb-2">
                            <p class="mb-0" style="font-weight: bold;">Pembeli</p>
                            <div class="row">
                                <div class="col">
                                    <input disabled type="text" class="form-control" value="<?= $jastip["email"] ?>">
                                </div>
                                <div class="col-auto text-right">
                                    <a href="https://wa.me/62<?= $jastip["nomor"] ?>" target="_blank">
                                        <button type="button" class="btn btn-success" style="font-size: 14px;">
                                            <i class="fas fa-fw fa-inbox"></i> Whatsapp
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if ($jastip["status"] == 0) { ?>
        <div class="row">
            <div class="col-6">
                <button class="btn btn-danger w-100" style="font-weight: bold;" onclick="$('#modal_tolak').modal('show')">Tolak</button>
            </div>
            <div class="col-6">
                <button class="btn btn-success w-100" style="font-weight: bold;" onclick="$('#modal_proses').modal('show')">Proses</button>
            </div>
        </div>
    <?php } else if ($jastip["status"] == 1) { ?>
        <button class="btn btn-success " style="font-weight: bold;" onclick="$('#modal_input_resi').modal('show')">
            <i class="fas fa-fw fa-truck"></i>
            Input Resi</button>
        <div class="row">
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

            <?php } ?>
        </div>

    <?php } ?>



</div>


<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>
    $("#form_proses").on("submit", function(e) {
        e.preventDefault();
        history.back();
        $('#modal_loading').modal("show");
        var formData = new FormData($("#form_proses")[0]);
        $.ajax({
            method: 'POST',
            url: '<?= base_url("admin_jastip/ajax_proses_jastip") ?>',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                response = JSON.parse(response);
                $('#modal_loading').modal("hide");
                if (response.status == 'exp') {
                    location.reload();
                } else if (response.status == 1) {
                    $("#modal_berhasil_autoclose").modal("show");
                    setTimeout(() => {
                        history.back();
                    }, 1000);
                } else {
                    $('#modal_loading').modal("hide");
                    $('#modal_info').modal("show");
                    $('#txt_modal_info').text(response.msg);
                }
            },
            error: function(xhr, status, error) {
                $('#modal_loading').modal("hide");
                console.error(error);
            },
        });





        return false;
    });

    $("#form_tolak").on("submit", function(e) {
        e.preventDefault();
        history.back();
        $('#modal_loading').modal("show");
        var formData = new FormData($("#form_tolak")[0]);
        $.ajax({
            method: 'POST',
            url: '<?= base_url("admin_jastip/ajax_tolak_jastip") ?>',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                response = JSON.parse(response);
                $('#modal_loading').modal("hide");
                if (response.status == 'exp') {
                    location.reload();
                } else if (response.status == 1) {
                    $("#modal_berhasil_autoclose").modal("show");
                    setTimeout(() => {
                        location.href = "<?= base_url('admin/login') ?>";
                    }, 1000);
                } else {
                    $('#modal_loading').modal("hide");
                    $('#modal_info').modal("show");
                    $('#txt_modal_info').text(response.msg);
                }
            },
            error: function(xhr, status, error) {
                $('#modal_loading').modal("hide");
                console.error(error);
            },
        });





        return false;
    });
    $('#modal_proses').on('show.bs.modal', function(e) {
        window.location.hash = "hash_modal_proses";
    });
    $(window).on('hashchange', function(event) {
        if (window.location.hash != "#hash_modal_proses") {
            $('#modal_proses').modal('hide');
        }
    });

    $('#modal_tolak').on('show.bs.modal', function(e) {
        window.location.hash = "hash_modal_tolak";
    });
    $(window).on('hashchange', function(event) {
        if (window.location.hash != "#hash_modal_tolak") {
            $('#modal_tolak').modal('hide');
        }
    });
</script>
<?= $this->endSection(); ?>