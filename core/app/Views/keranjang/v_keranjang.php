<?= $this->extend('template'); ?>
<?= $this->section('main'); ?>
<style>
    #table_keranjang thead {
        display: none !important;
    }

    #dt-search {
        margin-bottom: 0 !important;
        padding-bottom: 0 !important;
    }

    div.dt-container.dt-empty-footer tbody>tr:last-child>* {
        border: none;
    }
</style>
<style>
    .fixedContainer {
        /* background-color: #ddd; */
        position: fixed;
        left: 50%;
        bottom: 0%;
        padding-top: 10px;
        padding-bottom: 10px;
        padding-left: 10px;
        padding-right: 10px;
        width: 100%;
        transform: translateX(-50%);
        z-index: 300;
    }
</style>
<form id="form_checkout">

    <div class="container-fluid px-0">
        <div class="mx-auto" style="max-width: 500px;">
            <table class="w-100 mb-5" id="table_keranjang"></table>
        </div>
    </div>
    <div class="fixedContainer bg-white shadow">
        <div class="mx-auto" style="max-width: 500px;">
            <div class="row">
                <div class="col-6">
                    <div class="d-flex align-items-center justify-content-between h-100">
                        <div class="d-flex align-items-center">
                            <input type="checkbox" id="cb_checkAll" class="mr-2" style="transform: scale(1.3);">
                            <label for="cb_checkAll" class="mb-0 font-weight-bold">Pilih Semua</label>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <button type="submit" class="btn btn-success w-100">
                        Checkout <i class='fas fa-fw fa-arrow-alt-circle-right'></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>



<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>
    var table_keranjang;
    $(document).ready(function() {
        table_keranjang = $('#table_keranjang').DataTable({
            ordering: false,
            serverSide: false,
            processing: false,
            searching: true,
            lengthChange: false,
            info: false,
            paging: false,
            responsive: false,
            pagingType: "numbers",
            stateSave: false,
            language: {
                searchPlaceholder: "Search / Filter",
                search: "",
                emptyTable: "Keranjang Anda Kosong",
                zeroRecords: "Keranjang Anda Kosong",
            },
            ajax: {
                url: '<?= base_url("keranjang/ajax_list_keranjang"); ?>',
                type: 'POST',
                beforeSend: function() {
                    $('#table_keranjang > tbody').html(
                        '<tr class="odd">' +
                        '<td valign="top" colspan="1" class="dataTables_empty">Loading&hellip;</td>' +
                        '</tr>'
                    );
                },
                data: function(d) {
                    // d.start_date = $("#start_date").val();
                },
            },
            columns: [{
                data: null, // ambil semua data row
                render: function(data, type, row) {
                    return `
                       <div class="card shadow-sm mb-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2 d-flex align-items-center justify-content-center">
                                        <input type="checkbox" name="cb[]" class="cb_product" value="${row.id}" style=" transform: scale(1.3);">
                                    </div>
                                    <div class="col-sm-2 col-4">
                                        <img src="<?= base_url("assets/img/product") ?>/${row.foto1}" class="w-100" style="border-radius: 10px;border:1px solid black" onclick="location.href='<?= base_url('jastip/detail') ?>/${row.slug}'">
                                    </div>
                                    <div class="col-sm-8 col-6">
                                        <p class="mb-0" style="font-weight: bold;" onclick="location.href='<?= base_url('jastip/detail') ?>/${row.slug}'">${row.nama}</p>
                                        <p class="mb-0" style="color: maroon;">Rp ${row.harga}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-4">
                                        <button class="btn btn-danger w-100" onclick="delete_keranjang(${row.id})"><i class='fas fa-fw fa-trash'></i></button>
                                    </div>
                                    <div class="col-4">
                                    </div>
                                    <div class="col-4">
                                        <input required type="number" name="qty_${row.id}" class="form-control text-center w-100" min="0" max="1000" placeholder="Quantity" value="${row.qty}">
                                    </div>
                                </div>
                            </div>
                        </div>
                `;
                }
            }],
            lengthMenu: [-1],
        });
    });

    function reload_table() {
        table_keranjang.clear();
        table_keranjang.ajax.reload();
    }

    function delete_keranjang(product_id) {
        $('#modal_loading').modal("show");
        $.ajax({
            url: '<?= base_url("jastip/ajax_delete_keranjang") ?>',
            type: "POST",
            data: {
                product_id: product_id
            },
            success: function(response) {
                response = JSON.parse(response);
                $('#modal_loading').modal("hide");
                if (response.status == 'exp') {
                    location.href = "<?= base_url("account/login") ?>";
                } else if (response.status == 1) {
                    reload_table();
                } else {
                    $('#modal_loading').modal("hide");
                    $('#modal_info').modal("show");
                    $('#txt_modal_info').text(response.msg);
                }
            },
            error: function(xhr, status, error) {
                $('#modal_loading').modal("hide");
                console.error(error);
            }
        });
    }

    $('#cb_checkAll').on('change', function() {
        $('.cb_product').prop('checked', $(this).prop('checked'));
    });

    function updateState() {
        const total = $('.cb_product').length;
        const checked = $('.cb_product').filter(':checked').length;
        const el = $('#cb_checkAll')[0];

        if (checked === 0) {
            el.checked = false;
            el.indeterminate = false;
        } else if (checked === total) {
            el.checked = true;
            el.indeterminate = false;
        } else {
            el.checked = false;
            el.indeterminate = true; // inilah yang membuat tampilan "setengah"
        }
    }

    // Saat check all diklik
    $('#cb_checkAll').on('change', function() {
        $('.cb_product').prop('checked', this.checked);
        this.indeterminate = false;
    });

    $(document).on('change', '.cb_product', function() {
        console.log(this.indeterminate);
        updateState();
    });

    // Inisialisasi saat halaman pertama kali dimuat
    updateState();


    $("#form_checkout").on("submit", function(e) {
        e.preventDefault();
        $('#modal_loading').modal("show");
        var formData = new FormData($("#form_checkout")[0]);
        $.ajax({
            method: 'POST',
            url: '<?= base_url("jastip/checkout") ?>',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                response = JSON.parse(response);
                $('#modal_loading').modal("hide");
                if (response.status == 'exp') {
                    location.href = "<?= base_url("account/login") ?>";
                } else if (response.status == 1) {
                    location.href = "<?= base_url("jastip/history") ?>";
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
</script>
<?= $this->endSection(); ?>