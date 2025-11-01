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
                data: "item",
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