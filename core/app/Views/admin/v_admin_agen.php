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
    <button class="btn btn-info mb-3" style="font-size: 14px;font-weight: bold;" onclick="location.href='<?= base_url('admin/add_agen') ?>'">+ Add Agen</button>
    <div class="card">
        <div class="card-header" style="font-weight: bold;">
            <p class="mb-0" style="color: white;">List Agen</p>
        </div>
        <div class="card-body">
            <div class="row">

            </div>
            <table class="table w-100" id="table_product" style="margin-bottom: 100px;">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Kota</th>
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
                url: '<?= base_url("admin/ajax_list_agen"); ?>',
                type: 'POST',
                beforeSend: function() {
                    $('#table_product > tbody').html(
                        '<tr class="odd">' +
                        '<td valign="top" colspan="1" class="dataTables_empty">Loading&hellip;</td>' +
                        '</tr>'
                    );
                },
                data: function(d) {
                    d.kategori = $("#filter_kategori").val();
                },
            },
            columns: [{
                data: null,
                render: function(data, type, row) {
                    return row.nama;
                }
            }, {
                data: null,
                render: function(data, type, row) {
                    return capitalizeWords(row.jenis) + " " + capitalizeWords(row.kabupaten);
                }
            }, {
                data: null,
                render: function(data, type, row) {
                    return `<button class="btn btn-info" onclick="location.href='<?= base_url("admin/detail_agen") ?>/${row.id}'">Detail</button>`;
                }
            }],
            lengthMenu: [20],
        });
    });

    function capitalizeWords(str) {
        return str
            .toLowerCase()
            .split(" ")
            .map(word => word.charAt(0).toUpperCase() + word.slice(1))
            .join(" ");
    }

    function reload_table() {
        table_product.clear();
        table_product.ajax.reload();
    }
</script>
<?= $this->endSection(); ?>