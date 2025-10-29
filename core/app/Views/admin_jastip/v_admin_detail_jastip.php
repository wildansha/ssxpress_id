<?= $this->extend('template_admin'); ?>
<?= $this->section('main'); ?>
<div class="container-fluid  mt-3">
    <span class="rounded px-3 py-1 bg-secondary" style="color: white;">#<?= $jastip['status_name'] ?></span>
    <form id="form_terima">
        <div class="modal" id="modal_terima" data-keyboard="false" tabindex="-1" aria-labelledby="modal_terimaLabel" aria-hidden="true" data-backdrop="static">
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
                        <input required type="file" class="py-2">
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
                                    <a href="https://wa.me/62<?= $nomor_pemesan ?>">
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

    <div class="row">
        <div class="col-6">
            <button class="btn btn-danger w-100" style="font-weight: bold;" onclick="$('#modal_tolak').modal('show')">Tolak</button>
        </div>
        <div class="col-6">
            <button class="btn btn-success w-100" style="font-weight: bold;" onclick="$('#modal_terima').modal('show')">Terima</button>
        </div>
    </div>


</div>


<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>
    $("#form_terima").on("submit", function(e) {
        e.preventDefault();
        $('#modal_loading').modal("show");
        var formData = new FormData($("#form_terima")[0]);
        $.ajax({
            method: 'POST',
            url: '<?= base_url("admin/ajax_terima_jastip") ?>',
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
                    $('#txt_modal_info').text("Gagal, Hubungi Tim Terkait");
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
        $('#modal_loading').modal("show");
        var formData = new FormData($("#form_tolak")[0]);
        $.ajax({
            method: 'POST',
            url: '<?= base_url("admin/ajax_tolak_jastip") ?>',
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
                    $('#txt_modal_info').text("Gagal, Hubungi Tim Terkait");
                }
            },
            error: function(xhr, status, error) {
                $('#modal_loading').modal("hide");
                console.error(error);
            },
        });





        return false;
    });
    $('#modal_terima').on('show.bs.modal', function(e) {
        window.location.hash = "hash_modal_terima";
    });
    $(window).on('hashchange', function(event) {
        if (window.location.hash != "#hash_modal_terima") {
            $('#modal_terima').modal('hide');
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