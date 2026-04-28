<?= $this->extend('template_landingpage'); ?>

<?= $this->section('main'); ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<style>
    .form-control {
        color: black;
    }

    .form-control:focus {
        border-color: black;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, .25);
    }

    .form-control,
    select,
    p {
        font-size: 14px !important;
    }

    .bi {
        color: #083739;
        /* atau warna lain */
    }


    .nav-tabs {
        display: flex;
        flex-wrap: nowrap;
        /* penting: biar gak turun */
        width: 100%;
    }

    .nav-tabs .nav-item {
        flex: 1;
        /* bagi rata 3 */
    }

    .nav-tabs .nav-link {
        width: 100%;
        text-align: center;
        /* cegah teks turun */
    }

    .nav-tabs .nav-link {
        font-size: clamp(12px, 1.2vw, 14px) !important;
    }
</style>
<div class="modal" id="modal_ongkir" data-keyboard="false" tabindex="-1" aria-labelledby="modal_ongkirLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" style="max-width: 100%;">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title mb-0" style="font-size: 16px;font-weight: bold;">List Ongkir Dalam Negeri</p>
                <button type="button" class="close" onclick="history.back()">
                    <span aria-hidden="true" style="font-size: 24px;">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-white px-0">
                <div id="result_ongkir_dn" style="margin-bottom: 100px;"></div>
            </div>
            <div class="modal-footer bg-white w-100 shadow" style="position: fixed;bottom: 0;">
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">


    <div class="row mx-auto mt-3">
        <!-- <div class="col-6">
                <button class="btn btn-secondary px-3 py-1 w-100 bg-primary" style="border-radius: 20px;">
                    <p class="mb-0" style="font-size: 14px;"><i class="fas fa-fw fa-dollar-sign"></i> Ongkir</p>
                </button>
            </div>
            <div class="col-6">
                <button class="btn btn-secondary px-3 py-1 w-100 bg-primary" onclick="location.href='<?= base_url('jastip') ?>'" style="border-radius: 20px;">
                    <p class="mb-0" style="font-size: 14px;"><i class="fas fa-fw fa-truck"></i> Jastip</p>
                </button>
            </div> -->
        <div class="col-xl-8 mb-3">
            <img src="<?= base_url("landingpage/assets/img/banner1.jpg") ?>" class="w-100" style="pointer-events: none;border-radius: 10px;">
        </div>
        <div class="col-xl-4 mb-3">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link w-100 active"
                        id="lacak-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#tab_lacak"
                        type="button"
                        role="tab">
                        <i class="bi bi-box-seam"></i><br>
                        Lacak Paket
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link w-100"
                        id="ongkir-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#tab_ongkir"
                        type="button"
                        role="tab">
                        <i class="bi bi-currency-dollar"></i><br>
                        Cek Ongkir
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link w-100"
                        id="agen-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#tab_agen"
                        type="button"
                        role="tab">
                        <i class="bi bi-person"></i><br>
                        Info Agen</button>
                </li>
            </ul>
            <div class="tab-content">
                <div id="tab_lacak" class="tab-pane active py-2">
                    <div id="wrapper_lacak" class="p-2 shadow" style="background-color: #e4e4e4;border-radius: 10px;">
                        <form action="<?= base_url("home/index") ?>" method="GET">
                            <input type="text" name="id_order" class="form-control text-center" placeholder="SSINXXXX" value="<?= isset($id_order) ? $id_order : "" ?>">

                            <div class="text-end my-1">
                                <button class="btn btn-info" style="background-color: #1a4e74;border-color: #1a4e74;">Lacak</button>
                            </div>
                        </form>
                    </div>
                    <div id="wrapper_hasil_lacak" class="mt-2">
                        <?php if (isset($order_dn)) { ?>
                            <?php if (isset($trackings)) { ?>
                                <div class="row my-3">
                                    <div class="col-12">
                                        <div class="card shadow">
                                            <div class="card-header bg-primary" style="color: white;border-top-left-radius: 10px;border-top-right-radius: 10px;">
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
                                            <div class="card-header bg-primary" style="color: white;border-top-left-radius: 10px;border-top-right-radius: 10px;">
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
                                            <div class="card-header bg-primary" style="color: white;border-top-left-radius: 10px;border-top-right-radius: 10px;">
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
                                            <div class="card-header bg-primary" style="color: white;border-top-left-radius: 10px;border-top-right-radius: 10px;">
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
                                    <div class="card-header bg-primary" style="color: white;border-top-left-radius: 10px;border-top-right-radius: 10px;"><?= $id_order; ?></div>
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
                <div id="tab_ongkir" class="tab-pane py-2">
                    <div class="row mb-3">
                        <div class="col-6">
                            <button id="btn_order_dn" class="btn btn-secondary w-100 btn_page" style="font-size: 14px;" onclick="refresh_list('dn')">Dalam Negeri</button>
                        </div>
                        <div class="col-6">
                            <button id="btn_order_ln" class="btn btn-secondary w-100 btn_page" style="font-size: 14px;" onclick="refresh_list('ln')">Luar Negeri</button>
                        </div>
                    </div>
                    <div id="wrapper_ongkir_dn">
                        <form id="form_ongkir_dn">
                            <div class="shadow rounded p-2 mb-3" style="background-color: lightslategrey;color: white;">
                                <p style="font-size: 16px;margin-bottom: 0;font-weight: bold;text-align: center;">Cek Ongkir Dalam Negeri</p>
                                <hr class="my-2" style="border-bottom: 1px solid white;">
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <p>Kecamatan Pengirim</p>
                                        <select required name="origin" id="origin">
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <p>Kecamatan penerima</p>
                                        <select required name="destination" id="destination">
                                        </select>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <p>Berat (kg)</p>
                                        <input required type="number" min="1" name="berat" class="form-control" placeholder="0" value="<?= isset($detail["berat"]) ? $detail["berat"] : "1"; ?>">
                                    </div>
                                    <div class="col-4 mb-2">
                                        <p>Panjang (cm)</p>
                                        <input required type="number" min="1" name="panjang" class="form-control" placeholder="0" value="<?= isset($detail["panjang"]) ? $detail["panjang"] : "1"; ?>">
                                    </div>
                                    <div class="col-4 mb-2">
                                        <p>Lebar (cm)</p>
                                        <input required type="number" min="1" name="lebar" class="form-control" placeholder="0" value="<?= isset($detail["lebar"]) ? $detail["lebar"] : "1"; ?>">
                                    </div>
                                    <div class="col-4 mb-2">
                                        <p>Tinggi (cm)</p>
                                        <input required type="number" min="1" name="tinggi" class="form-control" placeholder="0" value="<?= isset($detail["tinggi"]) ? $detail["tinggi"] : "1"; ?>">
                                    </div>
                                    <div class="col-12 text-end">
                                        <button class="btn btn-success my-3 px-5 " style="font-weight: bold;text-align: right;">Cek Ongkir <i class="fa fa-arrow-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="wrapper_ongkir_ln">
                        <form id="form_ongkir_ln">
                            <div class="shadow rounded p-2 mb-3" style="background-color: lightslategrey;color: white;">
                                <p style="font-size: 16px;margin-bottom: 0;font-weight: bold;text-align: center;">Cek Ongkir Luar Negeri</p>
                                <hr class="my-2" style="border-bottom: 1px solid white;">
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <p>Pilih Negara</p>
                                        <div id="wrapper_negara_ongkirln" class="w-100" style="color: black;">
                                            <select required name="negara_ongkirln" id="negara_ongkirln" class="select2">
                                                <?php for ($i = 0; $i < count($list_negara_cek_ongkir_ln); $i++) {   ?>
                                                    <option value="<?= $list_negara_cek_ongkir_ln[$i]["id"]  ?>">
                                                        <?= $list_negara_cek_ongkir_ln[$i]["negara"] ?>
                                                    </option>
                                                <?php  } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div id="result_ongkir_ln" class="px-1 py-2 rounded w-100" style="background-color: white;color: black;overflow: scroll;max-height: 80vh;"></div>
                                        <img id="loading_cek_ongkir_ln" src="<?= base_url("assets/img/loading.gif") ?>" style="width: 50px;display: none;">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="tab_agen" class="tab-pane py-2">
                    
                </div>
            </div>
        </div>
    </div>
</div>


</body>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?>

<script>
    <?php if (isset($id_order)) { ?>
        window.scrollTo({
            top: document.getElementById("wrapper_hasil_lacak").offsetTop - 55,
            behavior: "smooth"
        });
    <?php }  ?>
</script>

<script>
    $('#negara_ongkirln').select2({
        width: '100%',
    });
    $('#origin,#destination').select2({
        width: '100%',
        placeholder: 'Cari Kecamatan...',
        ajax: {
            url: '<?= base_url("home/ajax_list_kecamatan") ?>',
            dataType: 'json',
            method: "POST",
            delay: 250,
            data: function(params) {
                return {
                    search: params.term
                };
            },
            processResults: function(response) {
                return {
                    results: response.data.map(item => ({
                        id: item.id + "|" + item.district_name + "|" + item.city_name + "|" + item.province_name,
                        text: item.label
                    }))
                };
            },
            cache: true
        },
        minimumInputLength: 3
    });

    var btn_terpilih = "dn";

    function refresh_list(page) {
        sessionStorage.setItem('btn_order_terpilih', page);

        $(".btn_page").css({
            backgroundColor: '#6C757D',
            borderColor: '#6C757D'
        });

        $("#btn_order_" + page).css({
            backgroundColor: '#F58400',
            borderColor: '#F58400'
        });

        btn_terpilih = page;

        if (page == "dn") {
            $("#wrapper_ongkir_dn").show();
            $("#wrapper_ongkir_ln").hide();
        } else {
            $("#wrapper_ongkir_dn").hide();
            $("#wrapper_ongkir_ln").show();
        }
    }

    window.onload = function() {
        $(document).ready(function() {
            if (sessionStorage.getItem('btn_order_terpilih') != null && sessionStorage.getItem('btn_order_terpilih') != "null" && sessionStorage.getItem('btn_order_terpilih') != "") {
                $("#btn_order_" + sessionStorage.getItem('btn_order_terpilih')).click();
            } else {
                $("#btn_order_dn").click();
            }
        })
    }

    $("#form_ongkir_dn").on("submit", function(e) {
        e.preventDefault();
        $('#modal_loading').modal("show");
        var formData = new FormData($("#form_ongkir_dn")[0]);
        $.ajax({
            method: 'POST',
            url: '<?= base_url("home/ajax_list_ongkir_dn") ?>',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                response = JSON.parse(response);
                if (response.status) {
                    $('#modal_loading').modal("hide");
                    $('#modal_ongkir').modal("show");
                    $('#result_ongkir_dn').html(response.list_ongkir_dn);
                } else {
                    $('#modal_loading').modal("hide");
                    $('#modal_info').modal("show");
                    $('#txt_modal_info').text(response.message);
                }
            },
            error: function(xhr, status, error) {
                $('#modal_loading').modal("hide");
                console.error(error);
            },
        });
        return false;
    });

    $("#form_ongkir_ln").on("submit", function(e) {
        e.preventDefault();
        $('#loading_cek_ongkir_ln').show();
        var formData = new FormData($("#form_ongkir_ln")[0]);
        $.ajax({
            method: 'POST',
            url: '<?= base_url("home/ajax_list_ongkir_ln") ?>',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                response = JSON.parse(response);
                $('#loading_cek_ongkir_ln').hide();
                if (response) {
                    $('#result_ongkir_ln').html(response);
                } else {
                    $('#result_ongkir_ln').html("Gagal Memuat Ongkir");
                }
            },
            error: function(xhr, status, error) {
                $('#loading_cek_ongkir_ln').hide();
                console.error(error);
            },
        });
        return false;
    });

    $("#form_ongkir_ln").submit();
    $("#negara_ongkirln").on("change", function() {
        $("#form_ongkir_ln").submit();
    });


    //============================================================================================================

    $('#modal_ongkir').on('show.bs.modal', function(e) {
        window.location.hash = "hash_modal_ongkir";
    });
    $(window).on('hashchange', function(event) {
        if (window.location.hash != "#hash_modal_ongkir") {
            $('#modal_ongkir').modal('hide');
        }
    });
</script>

<?= $this->endSection(); ?>