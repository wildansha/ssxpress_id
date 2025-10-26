<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Panel Mitraekspedisi</title>
    <link rel="icon">

    <!-- css select2 -->
    <link href="<?= base_url() ?>/sb2admin/vendor/select2/css/select2.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>/sb2admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- datatables CSS -->
    <link href="<?= base_url() ?>/sb2admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>/sb2admin/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/css/style-admin.css" rel="stylesheet">



    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url() . '/sb2admin/vendor/jquery/jquery.min.js' ?>"></script>
    <script src="<?= base_url() . '/sb2admin/vendor/bootstrap/js/bootstrap.bundle.min.js' ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url() . '/sb2admin/vendor/jquery-easing/jquery.easing.min.js' ?>"></script>

    <!-- datatables JavaScript -->
    <script src="<?= base_url() . '/sb2admin/vendor/datatables/jquery.dataTables.min.js' ?>"></script>
    <script src="<?= base_url() . '/sb2admin/vendor/datatables/dataTables.bootstrap4.min.js' ?>"></script>

    <!-- CKEDITOR 4 -->
    <script src="<?= base_url("ckeditor4/ckeditor.js") ?>"></script>
    <style>
        body {
            font-size: 14px;
        }

        .form-control {
            font-size: 14px !important;
        }

        /* START datatable */
        .dataTables_filter {
            float: right !important;
            color: white !important;
            width: 100% !important;
        }

        .dataTables_filter label {
            width: 100% !important;
        }

        .dataTables_filter input {
            width: 100% !important;
            margin-left: 0px !important;
        }

        .dataTables_filter input::placeholder {
            color: black;
            opacity: 0.8;
        }

        .paginate_button {
            text-align: center !important;
        }

        .dataTables_empty {
            color: black !important;
        }

        .ck {
            margin-bottom: 8px;
        }

        /* END datatable */
    </style>

</head>

<!-- modal loading -->
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
                <p class="modal-title mb-0" style="font-size: 16px;">Perhatian !</p>
                <button type="button" class="close" onclick="history.back()">
                    <span aria-hidden="true" style="font-size: 24px;">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align: center;">
                <p id="txt_modal_info" style="font-size: 20px;"></p>
            </div>

            <div class="modal-footer" style="text-align: center;">
                <button class="btn btn-secondary w-100" onclick="history.back()" style="font-weight: bold;">Tutup</button>
            </div>
        </div>
    </div>
</div>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-text mx-3"><?= session('username_akun') ?></div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url("admin_product") ?>">
                    <i class="fas fa-fw fa-file"></i>
                    <span style="font-size: 13px;">Produk</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url("admin_jastip") ?>">
                    <i class="fas fa-fw fa-file"></i>
                    <span style="font-size: 13px;">Jastip</span>
                </a>
            </li>
            <?php if (session('tipe_akun') === '1') { ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url("admin_mitra") ?>">
                        <i class="fas fa-fw fa-file"></i>
                        <span style="font-size: 13px;">Mitra</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url("admin_order") ?>">
                        <i class="fas fa-fw fa-car"></i>
                        <span style="font-size: 13px;">Order Dalam Negeri</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url("admin_order_ln") ?>">
                        <i class="fas fa-fw fa-plane"></i>
                        <span style="font-size: 13px;">Order Luar Negeri</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url("admin_ongkir_ln") ?>">
                        <i class="fas fa-fw fa-dollar-sign"></i>
                        <span style="font-size: 13px;">Ongkir LN</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url("admin_ongkir_ln_mitra") ?>">
                        <i class="fas fa-fw fa-dollar-sign"></i>
                        <span style="font-size: 13px;">Ongkir LN (Mitra)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url("admin_kpi") ?>">
                        <i class="fas fa-fw fa-check"></i>
                        <span style="font-size: 13px;">KPI</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url("admin_absensi") ?>">
                        <i class="fas fa-fw fa-clock"></i>
                        <span style="font-size: 13px;">Absensi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url("admin_laporan") ?>">
                        <i class="fas fa-fw fa-file"></i>
                        <span style="font-size: 13px;">Laporan</span>
                    </a>
                </li>
            <?php } else if (session('tipe_akun') === '2') { ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url("admin_tracking_ssn") ?>">
                        <i class="fas fa-fw fa-car"></i>
                        <span style="font-size: 13px;">Update Tracking SSN</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url("absensi") ?>">
                        <i class="fas fa-fw fa-clock"></i>
                        <span style="font-size: 13px;">Absensi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url("admin_tracking_ssn/kpi") ?>">
                        <i class="fas fa-fw fa-file"></i>
                        <span style="font-size: 13px;">KPI</span>
                    </a>
                </li>
            <?php } ?>

            <br>
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Content Topbar -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav mr-auto">
                        <h2 style="color: orange;font-weight: bolder;"><?= strtoupper(session('username_akun')) ?></h2>
                    </ul>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 medium"><b><?= session('username_akun') ?></b></span>
                                <img class="img-profile rounded-circle" src="<?= base_url() ?>/sb2admin/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                <?= $this->renderSection('main'); ?>

            </div>
            <!-- End of Content Topbar-->


            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Mitraekspedisi</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->


    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apa Anda Yakin?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Tekan tombol logout di bawah ini jika anda yakin ingin logout</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-danger" href="<?= base_url("admin/logout") ?>"><b>Logout</b></a>
                </div>
            </div>
        </div>
    </div>


    <!-- Custom scripts for all pages-->
    <script src="<?= base_url() . '/sb2admin/js/sb-admin-2.min.js' ?>"></script>
    <!-- select2 JavaScript -->
    <script src="<?= base_url() . '/sb2admin/vendor/select2/js/select2.min.js' ?>"></script>
    <script>
        function auto_grow(element) {
            element.style.height = "5px";
            element.style.height = (element.scrollHeight + 5) + "px";
            element.style.oveflow = "none";
            element.style.resize = "none";
        }

        $("textarea").each(function() {
            this.style.height = "5px";
            this.style.height = (this.scrollHeight + 5) + "px";
            this.style.oveflow = "none";
            this.style.resize = "none";
        });

        //============================================================================================================
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

</html>