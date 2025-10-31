<!DOCTYPE html>
<html>

<head>
    <meta name="google-site-verification" content="xKBdAEM9Hs8mEBvS6gYaFWGIHamKncPciZiQ0XF3ouQ" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?= $this->renderSection('meta_property'); ?>



    <link rel="icon" href="<?= base_url('assets/img/icon/logo-motor.jpeg'); ?>" sizes="16x14">
    <title>SSxpress</title>

    <!-- fontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="<?= base_url() ?>/sb2admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">

    <!-- slick slider -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/slick/slick.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/slick/slick-theme.css">

    <!-- venobox -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/venobox/venobox.css" type="text/css" media="screen" />

    <!-- page CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/koperasi.css">

    <style>
        body,
        p,
        span,
        button,
        .form-control {
            font-size: 14px !important;
        }

        body {
            background-color: #f7f7f7ff;
        }

        .bg_primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        #dt-search-0 {
            width: 100%;
            /* biar container search full */
        }

        table.dataTable>tbody>tr>th,
        table.dataTable>tbody>tr>td {
            padding: 0;
        }

        .dataTables_empty {
            color: black !important;
        }
    </style>
</head>

<div id="modal_loading" class="modal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="text-align: center;">
                <h4 class="modal-title">Loading...</h4>
                <hr>
                <p>Mohon Tunggu, Sedang Memproses Data</p>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="modal_berhasil" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_berhasilLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="text-align: center;">
                <p>Proses Berhasil</p>
                <button type="button" class="btn btn-primary" onclick="location.reload()">Oke</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="modal_berhasil_autoclose" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_berhasil_autocloseLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="text-align: center;">
                <p class="mb-0" style="font-size: 16px;font-weight: bold;">Proses Berhasil</p>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="modal_info" data-keyboard="false" tabindex="-1" aria-labelledby="modal_infoLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title mb-0" style="font-size: 16px !important;">Perhatian !</p>
                <button type="button" class="close" onclick="history.back()">
                    <span aria-hidden="true" style="font-size: 24px !important;">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align: center;">
                <p id="txt_modal_info" class="mb-0" style="font-size: 16px !important;"></p>
            </div>

            <div class="modal-footer" style="text-align: center;">
                <button class="btn btn-secondary w-100" onclick="history.back()" style="font-weight: bold;">Tutup</button>
            </div>
        </div>
    </div>
</div>

<body>
    <!-- untuk modal img -->
    <div class="modal fade" id="myModal""tabindex=" -1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="ModalLabel"></h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <img class="showimage img-responsive mb-3" src="" />
                    <h3 class="modal-harga" id="ModalLabel" style="font-weight: bold; color: var(--color-harga);"></h3>
                    <h5 class="modal-deskripsi" id="ModalLabel"></h5>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- untuk modal img -->


    <header class="sticky-top shadow-sm">
        <!-- navbar -->
        <nav class="navbar navbar-bg-putih navbar-light navbar-expand ">
            <div class="container">

                <!-- Brand -->
                <a class="navbar-brand" href="<?php echo base_url('home'); ?>">
                    <img src="<?= base_url(); ?>/assets/img/icon/logo-motor.jpeg" alt="Logo" style="width:50px; height:40px ">
                </a>

                <!-- Toggler/collapsibe Button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar links -->
                <div class="collapse navbar-collapse " id="collapsibleNavbar">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item mx-auto">
                            <!-- <a href="<?php echo base_url('home'); ?>" class="nav-link" style="color: black; font-weight: bolder; font-size: x-large;">SSxpress.id</a> -->
                        </li>
                    </ul>



                    <!-- <ul class="navbar-nav">
                        <li class="nav-item mx-auto">
                            <a href="<?php echo base_url('account/profile'); ?>" class="nav-link" style="color: black;font-weight: bold;">
                                <img src="https://localhost/serverssxpress/sb2admin/img/undraw_profile.svg" style="width: 30px;">
                            </a>
                        </li>
                    </ul> -->
                    <?php if (session("akun_id") !== null) { ?>
                        <ul class="navbar-nav">
                            <li class="nav-item mx-auto">
                                <a href="<?php echo base_url('jastip/history'); ?>" class="nav-link" style="font-weight: bold;">
                                    <p style="height:20px; line-height:40px; text-align:center;">
                                        <i class="fas fa-fw fa-file-alt" style="color: black;font-size: 20px;"></i>
                                    </p>
                                </a>
                            </li>
                        </ul>
                        <ul class="navbar-nav">
                            <li class="nav-item mx-auto">
                                <a href="<?php echo base_url('keranjang'); ?>" class="nav-link" style="color: black;font-weight: bold;">
                                    <img src="<?= base_url("assets/img/icon/ic_chart.png") ?>" style=" width: 30px;">
                                </a>
                            </li>
                        </ul>
                        <ul class="navbar-nav">
                            <li class="nav-item mx-auto">
                                <a href="<?php echo base_url('account/logout'); ?>" class="nav-link" style="color: black;font-weight: bold;">
                                    <button class="btn btn-danger">Logout</button>
                                </a>
                            </li>
                        </ul>
                    <?php } else { ?>
                        <ul class="navbar-nav">
                            <li class="nav-item mx-auto">
                                <a href="<?php echo base_url('account/login'); ?>" class="nav-link" style="color: black;font-weight: bold;">
                                    <button class="btn btn-success">Login</button>
                                </a>
                            </li>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </nav>
        <!-- /navbar -->
    </header>

    <?= $this->renderSection('main'); ?>



    <!-- Vendor JS Files -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

    <!-- slick slider JS -->
    <script type="text/javascript" src="<?= base_url(); ?>/assets/slick/slick.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>

    <!-- venobox -->
    <script type="text/javascript" src="<?= base_url(); ?>/assets/venobox/venobox.min.js"></script>

    <!-- Template Main JS File -->
    <script type="text/javascript" src="<?= base_url(); ?>/assets/js/main.js"></script>



    <script>
        function add_keranjang(product_id) {
            $('#modal_loading').modal("show");
            $.ajax({
                url: '<?= base_url("jastip/ajax_add_keranjang") ?>',
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
                        $("#modal_berhasil_autoclose").modal("show");
                        setTimeout(() => {
                            $('#modal_berhasil_autoclose').modal("hide");
                        }, 500);
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


        // ========================================================================================
        $('#modal_info').on('show.bs.modal', function(e) {
            window.location.hash = "hash_modal_info";
        });
        $(window).on('hashchange', function(event) {
            if (window.location.hash != "#hash_modal_info") {
                $('#modal_info').modal('hide');
            }
        });
    </script>

    <?= $this->renderSection('js'); ?>

</body>