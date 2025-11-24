<?= $this->extend('template'); ?>
<?= $this->section('main'); ?>
<style>
    .judul_input {
        margin-top: 15px;
        font-weight: bold;
    }

    .tab-pane {
        padding-top: 20px;
    }

    #table_alamat_dn thead,
    #table_alamat_ln thead {
        display: none !important;
    }
</style>


<div class="modal" id="modal_add_alamat_dn" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_add_alamat_dnLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title mb-0" style="font-weight: bold;">Tambah Alamat Dalam Negeri</p>
                <button type="button" class="close" onclick="history.back()">
                    <span aria-hidden="true" style="font-size: 24px !important;">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-0">
                <form id="form_alamat_dn" autocomplete="off">

                    <p class="judul_input">Provinsi</p>
                    <select required name="provinsi_id" id="dn_provinsi" class="form-control w-100">
                        <?php for ($i = 0; $i < count($list_provinsi); $i++) { ?>
                            <option value="<?= $list_provinsi[$i]["id"] ?>">
                                <?= $list_provinsi[$i]["name"] ?>
                            </option>
                        <?php } ?>
                    </select>
                    <input type="hidden" name="provinsi" id="dn_provinsi_txt" value="">

                    <p class="judul_input">Kota/Kabupaten</p>
                    <select required name="kabupaten_id" id="dn_kabupaten" class="form-control w-100"></select>
                    <input type="hidden" name="kabupaten" id="dn_kabupaten_txt" value="">


                    <p class="judul_input">Kecamatan</p>
                    <select required name="kecamatan_id" id="dn_kecamatan" class="form-control w-100"></select>
                    <input type="hidden" name="kecamatan" id="dn_kecamatan_txt" value="">


                    <p class="judul_input">Penerima</p>
                    <input type="text" name="nama_penerima" class="form-control" placeholder="Andi, Budi dll">

                    <p class="judul_input">Telp / Whatsapp</p>
                    <p class="mb-0" style="font-size: 12px;color: gray;">Tanpa '0' di awal, langsung kode negara dan nomor</p>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">+</span>
                        </div>
                        <input required type="number" name="telp_penerima" class="form-control" placeholder="6281293948290">
                    </div>

                    <p class="judul_input">Detail Alamat</p>
                    <textarea required name="alamat" class="form-control" oninput="auto_grow(this)" placeholder="Nomor rumah, warna pagar, dll"></textarea>
                    <button type="submit" class="btn btn-success w-100 my-3">Simpan</button>
                </form>

            </div>
        </div>
    </div>
</div>
<div class="modal" id="modal_add_alamat_ln" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_add_alamat_lnLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title mb-0" style="font-weight: bold;">Tambah Alamat Luar Negeri</p>
                <button type="button" class="close" onclick="history.back()">
                    <span aria-hidden="true" style="font-size: 24px !important;">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-0">
                <form id="form_alamat_ln" autocomplete="off">
                    <p class="judul_input">Negara</p>
                    <select required name="id_negara" id="negara" class="form-control w-100">
                        <option value="">-- Pilih Negara --</option>
                        <?php for ($i = 0; $i < count($list_negara); $i++) { ?>
                            <option value="<?= $list_negara[$i]["id"] ?>">
                                <?= $list_negara[$i]["negara"] ?>
                            </option>
                        <?php } ?>
                    </select>
                    <p class="judul_input">Penerima</p>
                    <input type="text" name="nama_penerima" class="form-control" placeholder="Andi, Budi dll">

                    <p class="judul_input">Telp / Whatsapp</p>
                    <p class="mb-0" style="font-size: 12px;color: gray;">Tanpa '0' di awal, langsung kode negara dan nomor</p>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">+</span>
                        </div>
                        <input required type="number" name="telp_penerima" class="form-control" placeholder="6281293948290">
                    </div>

                    <p class="judul_input">Detail Alamat</p>
                    <textarea required name="alamat" class="form-control" oninput="auto_grow(this)" placeholder="Nomor rumah, warna pagar, dll"></textarea>
                    <button type="submit" class="btn btn-success w-100 my-3">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="container mt-3 shadow" >
    <ul class="nav nav-tabs nav-fill" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tab_dn">Dalam Negeri</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab_ln">Luar Negeri</a>
        </li>
    </ul>

    <div class="tab-content">
        <div id="tab_dn" class="tab-pane active">
            <button class="btn btn-success" style="font-weight: bold;" onclick="open_modal_add_alamat_dn()">+ Alamat</button>
            <table class="w-100" id="table_alamat_dn"></table>
        </div>


        <div id="tab_ln" class="tab-pane fade">
            <button class="btn btn-success" style="font-weight: bold;" onclick="open_modal_add_alamat_ln()">+ Alamat</button>
            <table class="w-100" id="table_alamat_ln"></table>
        </div>

    </div>
</div>


<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>
    function open_modal_add_alamat_dn() {
        $("#modal_add_alamat_dn").modal("show");
    }

    function open_modal_add_alamat_ln() {
        $("#modal_add_alamat_ln").modal("show");
    }
    $('#negara').select2();


    //START inisialisasi==============================================================================
    $('#dn_provinsi').prepend('<option value="">-- Pilih Provinsi --</option>');
    $('#dn_provinsi').val("").trigger('change');
    $('#dn_kabupaten').empty().append('<option value="">-- Pilih Provinsi Dahulu --</option>');
    $('#dn_kecamatan').empty().append('<option value="">-- Pilih Kota/Kabupaten Dahulu --</option>');
    //END inisialisasi==============================================================================

    $('#dn_provinsi').select2();
    $('#dn_provinsi').on('select2:select', function(e) {
        var data = e.params.data;
        $('#dn_provinsi_txt').val(data.text.trim());

        $('#dn_kabupaten').val("").trigger('change');
        $('#dn_kecamatan').empty().append('<option value="">-- Pilih Kota/Kabupaten Dahulu --</option>').val("");
        $('#dn_kecamatan').val("").trigger('change');

        load_dn_kabupaten(data.id)
    });



    function load_dn_kabupaten(provinsi_id = "") {
        if (provinsi_id != "") {
            $('#dn_kabupaten').val('').empty().append('<option value="">-- Loading --</option>');;
            $.ajax({
                url: '<?= base_url("akun/ajax_list_kabupaten") ?>',
                type: 'POST',
                data: {
                    provinsi_id: provinsi_id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'exp') {
                        location.reload();
                    }
                    $('#dn_kabupaten').val('').empty().append('<option value="">-- Pilih Kota/Kabupaten --</option>');;
                    $('#dn_kabupaten').select2({
                        data: response.map(item => ({
                            id: item.id,
                            text: item.name
                        }))
                    });
                },
                error: function(xhr, status, error) {
                    console.log('AJAX Error:', error);
                }
            });
        } else {
            $('#dn_kabupaten').empty().append('<option value="">-- Pilih Provinsi Dahulu --</option>').val('');
        }
    }
    $('#dn_kabupaten').on('select2:select', function(e) {
        var data = e.params.data;
        $('#dn_kabupaten_txt').val(data.text.trim());

        $('#dn_kecamatan').val(null).trigger('change');
        load_dn_kecamatan(data.id)
    });


    function load_dn_kecamatan(kabupaten_id = "") {
        $('#dn_kecamatan').val('').empty().append('<option value="">-- Loading --</option>');;
        $.ajax({
            url: '<?= base_url("akun/ajax_list_kecamatan") ?>',
            type: 'POST',
            data: {
                kabupaten_id: kabupaten_id
            },
            dataType: 'json',
            success: function(response) {
                if (response.status == 'exp') {
                    location.reload();
                }
                $('#dn_kecamatan').val('').empty().append('<option value="">-- Pilih Kecamatan --</option>');;
                $('#dn_kecamatan').select2({
                    data: response.map(item => ({
                        id: item.id,
                        text: item.name
                    }))
                });
            },
            error: function(xhr, status, error) {
                console.log('AJAX Error:', error);
            }
        });
    }
    $('#dn_kecamatan').on('select2:select', function(e) {
        var data = e.params.data;
        $('#dn_kecamatan_txt').val(data.text.trim());
    });


    $("#form_alamat_dn").on("submit", function(e) {
        e.preventDefault();
        history.back();
        $('#modal_loading').modal("show");
        var formData = new FormData($("#form_alamat_dn")[0]);
        $.ajax({
            method: 'POST',
            url: '<?= base_url("akun/ajax_simpan_alamat_dn") ?>',
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
                    reload_table_dn();
                    setTimeout(() => {
                        $("#modal_berhasil_autoclose").modal("hide");
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

    $("#form_alamat_ln").on("submit", function(e) {
        e.preventDefault();
        history.back();
        $('#modal_loading').modal("show");
        var formData = new FormData($("#form_alamat_ln")[0]);
        $.ajax({
            method: 'POST',
            url: '<?= base_url("akun/ajax_simpan_alamat_ln") ?>',
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
                    reload_table_ln();
                    setTimeout(() => {
                        $("#modal_berhasil_autoclose").modal("hide");
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


    var table_alamat_dn;
    $(document).ready(function() {
        table_alamat_dn = $('#table_alamat_dn').DataTable({
            ordering: false,
            serverSide: false,
            processing: false,
            searching: false,
            lengthChange: false,
            info: false,
            paging: false,
            responsive: false,
            pagingType: "numbers",
            stateSave: false,
            language: {
                searchPlaceholder: "Search / Filter",
                search: "",
                emptyTable: "-- Kosong --",
                zeroRecords: "-- Kosong --",
            },
            ajax: {
                url: '<?= base_url("akun/ajax_alamat_dn"); ?>',
                type: 'POST',
                beforeSend: function() {
                    $('#table_alamat_dn > tbody').html(
                        '<tr class="odd">' +
                        '<td valign="top" colspan="1" class="dataTables_empty">Loading&hellip;</td>' +
                        '</tr>'
                    );
                },
                data: function(d) {},
            },
            columns: [{
                data: "item",
            }],
            lengthMenu: [-1],
        });

        table_alamat_ln = $('#table_alamat_ln').DataTable({
            ordering: false,
            serverSide: false,
            processing: false,
            searching: false,
            lengthChange: false,
            info: false,
            paging: false,
            responsive: false,
            pagingType: "numbers",
            stateSave: false,
            language: {
                searchPlaceholder: "Search / Filter",
                search: "",
                emptyTable: "-- Kosong --",
                zeroRecords: "-- Kosong --",
            },
            ajax: {
                url: '<?= base_url("akun/ajax_alamat_ln"); ?>',
                type: 'POST',
                beforeSend: function() {
                    $('#table_alamat_ln > tbody').html(
                        '<tr class="odd">' +
                        '<td valign="top" colspan="1" class="dataTables_empty">Loading&hellip;</td>' +
                        '</tr>'
                    );
                },
                data: function(d) {},
            },
            columns: [{
                data: "item",
            }],
            lengthMenu: [-1],
        });
    });

    function reload_table_dn() {
        table_alamat_dn.clear();
        table_alamat_dn.ajax.reload();
    }

    function reload_table_ln() {
        table_alamat_ln.clear();
        table_alamat_ln.ajax.reload();
    }




    function delete_alamat_dn(alamat_dn_id) {
        $.ajax({
            url: '<?= base_url("akun/ajax_delete_alamat_dn") ?>',
            type: 'POST',
            data: {
                alamat_dn_id: alamat_dn_id
            },
            dataType: 'json',
            success: function(response) {
                if (response.status == 'exp') {
                    location.reload();
                } else if (response.status == 1) {
                    $("#modal_berhasil_autoclose").modal("show");
                    reload_table_dn();
                    setTimeout(() => {
                        $("#modal_berhasil_autoclose").modal("hide");
                    }, 1000);
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX Error:', error);
            }
        });
    }

    function delete_alamat_ln(alamat_ln_id) {
        $.ajax({
            url: '<?= base_url("akun/ajax_delete_alamat_ln") ?>',
            type: 'POST',
            data: {
                alamat_ln_id: alamat_ln_id
            },
            dataType: 'json',
            success: function(response) {
                if (response.status == 'exp') {
                    location.reload();
                } else if (response.status == 1) {
                    $("#modal_berhasil_autoclose").modal("show");
                    reload_table_ln();
                    setTimeout(() => {
                        $("#modal_berhasil_autoclose").modal("hide");
                    }, 1000);
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX Error:', error);
            }
        });
    }
</script>
<script>
    $('#modal_add_alamat_dn').on('show.bs.modal', function(e) {
        window.location.hash = "hash_modal_add_alamat_dn";
    });
    $(window).on('hashchange', function(event) {
        if (window.location.hash != "#hash_modal_add_alamat_dn") {
            $('#modal_add_alamat_dn').modal('hide');
        }
    });

    $('#modal_add_alamat_ln').on('show.bs.modal', function(e) {
        window.location.hash = "hash_modal_add_alamat_ln";
    });
    $(window).on('hashchange', function(event) {
        if (window.location.hash != "#hash_modal_add_alamat_ln") {
            $('#modal_add_alamat_ln').modal('hide');
        }
    });
</script>
<?= $this->endSection(); ?>