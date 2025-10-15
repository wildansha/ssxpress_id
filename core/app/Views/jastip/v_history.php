<?= $this->extend('template'); ?>
<?= $this->section('main'); ?>
<style>
    #table_history thead {
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

<!-- deskripsi -->
<div class="container mt-3 p-3 shadow-lg ">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs nav-fill" role="tablist">
        <li class="nav-item">
            <span id="btn_progress" class="nav-link active" data-toggle="tab">On Progress</span>
        </li>
        <li class="nav-item">
            <span id="btn_completed" class="nav-link" data-toggle="tab">Completed</span>
        </li>
        <li class="nav-item">
            <span id="btn_canceled" class="nav-link" data-toggle="tab">Canceled</span>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div id="tab_p" class="tab-pane active">
            <table class="w-100 mb-5" id="table_history"></table>
        </div>

    </div>
</div>
<!-- /deskripsi -->


<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>
    var table_history;
    var tab_type = "btn_progress";
    $(document).ready(function() {
        table_history = $('#table_history').DataTable({
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
                emptyTable: "History Kosong",
                zeroRecords: "History Kosong",
            },
            ajax: {
                url: '<?= base_url("jastip/ajax_data_history"); ?>',
                type: 'POST',
                beforeSend: function() {
                    $('#table_history > tbody').html(
                        '<tr class="odd">' +
                        '<td valign="top" colspan="1" class="dataTables_empty">Loading&hellip;</td>' +
                        '</tr>'
                    );
                },
                data: function(d) {
                    d.tab_type = tab_type;
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
        table_history.clear();
        table_history.ajax.reload();
    }

    $(".nav-link").on("click", function(e) {
        e.preventDefault(); // cegah reload halaman
        tab_type = e.target.id;
        reload_table();
    })
</script>
<?= $this->endSection(); ?>