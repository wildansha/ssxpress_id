<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <title>Admin</title>

    <!-- fontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- page CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/admin.css">
    <!-- ckeditor -->
    <script src="<?= base_url(); ?>/assets/ckeditor/build/ckeditor.js" type="text/javascript"></script>




</head>

<body>
    <header class="sticky-top">
        <!-- navbar -->
        <nav class="navbar navbar-bg-putih navbar-expand-sm  navbar-light">
            <div class="container">

                <!-- Brand -->
                <a class="navbar-brand" href="<?php echo base_url('admin_gallery'); ?>">
                    <img src="<?= base_url(); ?>/assets/img/icon/logo.jpeg" alt="Logo" style="width:60px; height:40px ">
                </a>

                <!-- Toggler/collapsibe Button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar links -->
                <div class="collapse navbar-collapse  " id="collapsibleNavbar">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item mx-auto">
                            <a href="<?php echo base_url('admin_promo'); ?>" class="nav-link" style="color: black;">Promo</a>
                        </li>
                        <li class="nav-item mx-auto">
                            <a href="<?php echo base_url('admin_product'); ?>" class="nav-link" style="color: black;">Product</a>
                        </li>


                        <li cla
                        s="nav-item ml-auto mr-auto">
                            <form action="<?= base_url(); ?>/admin/keluar" method="POST">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin Logout?');">Log Out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- /navbar -->
    </header>

    <?= $this->renderSection('main'); ?>

    <footer style="color: white;">

        <!-- Vendor JS Files -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>


        <!-- Template Main JS File -->
        <script src="<?= base_url(); ?>/assets/js/admin.js" type="text/javascript"></script>
    </footer>

</body>