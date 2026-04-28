<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>SSxpress</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="<?= base_url("landingpage") ?>/assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/sb2admin/vendor/select2/css/select2.min.css" rel="stylesheet">

    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="<?= base_url("landingpage") ?>/css/styles.css" rel="stylesheet" />



    <style>
        p {
            margin-bottom: 0;
        }

        /* ============================================================== */
    </style>
</head>

<body id="page-top">
    <div class="w-100 py-2" style="background-color: #0603ff;color: white;">
        <div class="container-fluid">
            <p id="p1" class="mb-0 px-2 text-center" style="font-size: 14px;">Jasa Pengiriman Internasional, Aman, Terpercaya, dan Terjangkau, Hubungi :
                <span style="  white-space: nowrap;">

                    <a href=""><i class="fas fa-fw fa-phone"></i>085315999960</a>
                    -
                    <a href=""><i class="fas fa-fw fa-phone"></i>087828774850</a>
                </span>
            </p>
        </div>
    </div>


    <nav class="navbar navbar-expand-lg navbar-light sticky-top" id="mainNav">
        <div class="container-fluid">
            <a class="navbar-brand" href="#page-top"><img src="<?= base_url("landingpage") ?>/assets/img/navbar-logo.png" alt="..." /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation" style="color: #0603ff;">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav  ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#profile">Profil Perusahaan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#team">Kontak Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Daftar Ongkir</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <?= $this->renderSection('main'); ?>

    <!-- Footer-->
    <!-- <footer class="footer py-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-4 text-lg-start">Copyright &copy; Your Website 2023</div>
                <div class="col-lg-4 my-3 my-lg-0">
                    <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a class="link-dark text-decoration-none me-3" href="#!">Privacy Policy</a>
                    <a class="link-dark text-decoration-none" href="#!">Terms of Use</a>
                </div>
            </div>
        </div>
    </footer> -->
    <!-- Bootstrap core JS-->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() . '/sb2admin/vendor/select2/js/select2.min.js' ?>"></script>

    <!-- Core theme JS-->
    <script src="<?= base_url("landingpage") ?>/js/scripts.js"></script>

    <script>
        window.addEventListener("scroll", function() {
            const p1 = document.getElementById("p1");

            if (window.scrollY > 50) {
                p1.classList.add("hide");
            } else {
                p1.classList.remove("hide");
            }
        });
    </script>

    <?= $this->renderSection('js'); ?>
</body>

</html>