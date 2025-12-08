<?= $this->extend('template_admin'); ?>

<?= $this->section('main'); ?>

<style>
    .select2-container .select2-selection--single,
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 35px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 35px;
    }

    .select2-container--default .select2-selection--single {
        border-color: #d1d3e2;
    }
</style>
<div class="container">
    <button class="btn btn-info mb-3" style="font-size: 14px;font-weight: bold;" onclick="location.href='<?= base_url('admin/add_product') ?>'">+ Add Product</button>
    <div class="card">
        <div class="card-header" style="font-weight: bold;">
            <p class="mb-0" style="color: white;">List Product</p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 col-12 mb-3">
                    <span><b>Kategori</b></span>
                    <select id="filter_kategori" class="select2 w-100">
                        <option value="">--Semua--</option>
                        <?php for ($i = 0; $i < count($kategori_all); $i++) {    ?>
                            <option value="<?= $kategori_all[$i]["id"] ?>"><?= $kategori_all[$i]["kategori"] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <table class="table w-100" id="table_product" style="margin-bottom: 100px;">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Product</th>
                        <th>Tombol</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>
    var table_product;
    $(document).ready(function() {
        table_product = $('#table_product').DataTable({
            ordering: false,
            serverSide: false,
            processing: false,
            searching: false,
            lengthChange: false,
            info: false,
            paging: true,
            responsive: false,
            pagingType: "numbers",
            stateSave: false,
            language: {
                searchPlaceholder: "Search / Filter",
                search: "",
            },
            ajax: {
                url: '<?= base_url("admin/ajax_list_product"); ?>',
                type: 'POST',
                beforeSend: function() {
                    $('#table_product > tbody').html(
                        '<tr class="odd">' +
                        '<td valign="top" colspan="1" class="dataTables_empty">Loading&hellip;</td>' +
                        '</tr>'
                    );
                },
                data: function(d) {
                    d.kategori_id = $("#filter_kategori").val();
                },
            },
            columns: [{
                data: null,
                render: function(data, type, row) {
                    return `<img src="<?= base_url('') ?>/assets/img/product/${row.foto1}" class="mx-auto" style="width: 100%;max-width: 50px;text-align: center; ">`;
                }
            }, {
                data: null,
                render: function(data, type, row) {
                    return `<p class="mb-0" style="font-size: 12px;color: gray;">${row.kategori}</p>
                            <p class="mb-0" style="font-size: 16px;font-weight: bold;">${row.nama}</p>`;
                }
            }, {
                data: null,
                render: function(data, type, row) {
                    return `<button class="btn btn-info" onclick="location.href='<?= base_url("admin/detail_product") ?>/${row.id}'">Detail</button>`;
                }
            }],
            lengthMenu: [20],
        });
    });

    function reload_table() {
        table_product.clear();
        table_product.ajax.reload();
    }

    $("#filter_kategori").select2();
    $('#filter_kategori').on('select2:select', function(e) {
        reload_table();
    });
    $('#start_date,#end_date').change(function(e) {
        reload_table();
    });

    function export_excel() {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '<?= base_url("admin_product/export_excel") ?>';
        const data = {
            start_date: $("#start_date").val(),
            end_date: $("#end_date").val(),
            id_akun: $("#filter_kategori").val()
        }
        for (const key in data) {
            if (data.hasOwnProperty(key)) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = key;
                input.value = data[key];
                form.appendChild(input);
            }
        }
        document.body.appendChild(form);
        form.submit();
    }
</script>
<?= $this->endSection(); ?>