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
<div class="container-fluid px-0 mt-3 ">
    <div class="mx-auto" style="max-width: 500px;">
        <select id="filter_status" class="form-control" style="font-weight: bold;">
            <?php for ($i = 0; $i < count($list_status); $i++) { ?>
                <option value="<?= $list_status[$i]["id"] ?>"><?= $list_status[$i]["status_name"] ?></option>
            <?php } ?>
        </select>

        <table class="w-100 mb-5" id="table_history"></table>
    </div>
</div>


<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>
    var table_history;
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
                    d.status_id = $('#filter_status').val();
                },
            },
            columns: [{
                data: null, // ambil semua data row
                render: function(data, type, row) {
                    if (row.jml_other > 0) {
                        var txt_lainnya = `<div class="col-12 mb-2">
                                        <hr class="my-0">
                                        <p class="mb-0 text-center" style="color:grey;font-size:12px !important;">+ ${row.jml_other} produk lainnya...</p>
                                        <hr class="my-0">
                                    </div>`;
                    } else {
                        var txt_lainnya = "";
                    }


                    return `
                       <div class="card shadow-sm mb-2" >
                            <div class="card-body pb-0">
                                <div class="row" onclick="location.href='<?= base_url('jastip/detail_jastip/') ?>/${row.jastip_id}'">
                                    <div class="col-sm-2 col-4 mb-2">
                                        <img src="<?= base_url("assets/img/product") ?>/${row.foto1}" class="w-100" style="border-radius: 10px;border:1px solid black" onclick="location.href='<?= base_url('jastip/product_detail') ?>/${row.slug}'">
                                    </div>
                                    <div class="col-sm-8 col-6 mb-2">
                                    <p class="mb-0" style="font-weight: bold;">${row.product_name}</p>
                                        <p class="mb-0" style="color: maroon;">Rp ${ format_angka(row.harga)}</p>
                                    </div>
                                    ${txt_lainnya}
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                            <button class="btn btn-success w-100" onclick="location.href='https://wa.me/6285315999960?text=Saya mau bayar ssxpress.id/konfirmasi_jastip/${row.jastip_id}'">
                                                <i class="fas fa-fw fa-user"></i> Chat Admin
                                            </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-12">
                                        <p class="mb-0" style="font-size:12px !important;color:grey">${row.waktu_pesan}</p>                                    
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

    $("#filter_status").on('change', function(e) {
        e.preventDefault(); // cegah reload halaman 
        reload_table();
    })
</script>
<?= $this->endSection(); ?>