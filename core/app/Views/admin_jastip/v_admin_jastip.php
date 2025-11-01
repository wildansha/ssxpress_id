<?= $this->extend('template_admin'); ?>
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

<div class="container-fluid">
    <div class="mx-auto" style="max-width: 700px;">
        <div class="btn-group btn-group-toggle w-100 my-2" data-toggle="buttons">
            <?php for ($i = 0; $i < count($list_status); $i++) {  ?>
                <button class="btn btn-info active">
                    <input type="radio" name="filter_radio" id="radio_<?= $i ?>" value="<?= $i ?>" autocomplete="off"><?= $list_status[$i]["status_name"] ?>
                </button>
            <?php }  ?>
        </div>
        <?php for ($i = 0; $i < count($list_status); $i++) {  ?>
            <div id="wrapper_table_<?= $i ?>">
                <table class="w-100 mb-5" id="table_<?= $i ?>"></table>
            </div>
        <?php }  ?>
    </div>
</div>


<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>
    var filter_radio_terpilih = 0;
    $(document).ready(function() {
        var dt_jastip = [];
        <?php for ($i = 0; $i < count($list_status); $i++) {  ?>
            dt_jastip[<?= $i ?>] = $('#table_<?= $i ?>').DataTable({
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
                    emptyTable: "-- Kosong --",
                    zeroRecords: "-- Kosong --",
                },
                ajax: {
                    url: '<?= base_url("admin_jastip/ajax_list_jastip"); ?>',
                    type: 'POST',
                    beforeSend: function() {
                        $('#table_history > tbody').html(
                            '<tr class="odd">' +
                            '<td valign="top" colspan="1" class="dataTables_empty">Loading&hellip;</td>' +
                            '</tr>'
                        );
                    },
                    data: function(d) {
                        d.status_id = <?= $list_status[$i]["id"] ?>;
                    },
                },
                columns: [{
                    data: "item",
                }],
                lengthMenu: [-1],
            });
        <?php } ?>
    });


    function reload_table(table_id) {
        dt_jastip[table_id].clear();
        dt_jastip[table_id].ajax.reload();
    }

    $('input[name="filter_radio"]').on('change', function() {
        <?php for ($i = 0; $i < count($list_status); $i++) {  ?>
            $("#wrapper_table_<?= $i ?>").hide();
        <?php } ?>

        filter_radio_terpilih = $(this).val();
        $("#wrapper_table_" + $(this).val()).show();
    });
    $("#radio_0").trigger("click");
</script>
<?= $this->endSection(); ?>