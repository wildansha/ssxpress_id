<?= $this->extend('template_landingpage'); ?>

<?= $this->section('main'); ?>

<style>
    .layanan-hero {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        padding: 80px 0;
        position: relative;
        overflow: hidden;
    }

    .layanan-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .layanan-hero::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    .service-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 15px;
        overflow: hidden;
        background: white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    .service-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, #e7f1ff 0%, #d0e4ff 100%);
        transition: all 0.3s ease;
    }

    .service-card:hover .service-icon {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        transform: scale(1.1);
    }

    .service-icon i {
        font-size: 36px;
        color: #0d6efd;
        transition: color 0.3s ease;
    }

    .service-card:hover .service-icon i {
        color: white;
    }

    .service-card .card-body {
        padding: 2rem 1.5rem;
    }

    .service-card .card-title {
        font-weight: 700;
        font-size: 1.25rem;
        margin-bottom: 1rem;
        color: #2c3e50;
    }

    .service-card .card-text {
        color: #6c757d;
        line-height: 1.6;
    }

    .keunggulan-section {
        background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);
        padding: 60px 0;
    }

    .keunggulan-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 1.5rem;
        padding: 1rem;
        border-radius: 10px;
        background: white;
        transition: all 0.3s ease;
    }

    .keunggulan-item:hover {
        transform: translateX(10px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .keunggulan-icon {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #198754 0%, #157347 100%);
        margin-right: 1rem;
        flex-shrink: 0;
    }

    .keunggulan-icon i {
        color: white;
        font-size: 20px;
    }

    .keunggulan-text {
        font-size: 1rem;
        color: #2c3e50;
        line-height: 1.5;
    }

    .cta-section {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        border-radius: 20px;
        padding: 2.5rem;
        color: white;
        text-align: center;
    }

    .cta-section h5 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .cta-section .contact-info {
        font-size: 1rem;
        opacity: 0.9;
        margin-bottom: 0.5rem;
    }

    .cta-section .contact-info i {
        margin-right: 0.5rem;
    }

    .cta-section .btn-light {
        margin-top: 1.5rem;
        padding: 0.75rem 2rem;
        font-weight: 600;
        border-radius: 50px;
    }
</style>

<!-- Hero Section -->
<div class="layanan-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold text-white mb-3" style="position: relative; z-index: 1;">Layanan Kami</h1>
                <p class="lead text-white-50 mb-4" style="position: relative; z-index: 1; font-size: 1.2rem;">
                    Solusi logistik darat dan udara untuk pengiriman domestik & internasional. 
                    SSXpress hadir untuk memenuhi segala kebutuhan pengiriman Anda.
                </p>
                <a href="<?= base_url('home/kontak_kami') ?>" class="btn btn-light btn-lg rounded-pill px-4" style="position: relative; z-index: 1;">
                    <i class="fas fa-phone me-2"></i>Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Services Section -->
<section class="container py-5">
    <div class="text-center mb-5">
        <span class="badge bg-primary mb-2 px-3 py-2 rounded-pill">LAYANAN KAMI</span>
        <h2 class="h3 fw-bold mt-2">Solusi Pengiriman Lengkap</h2>
        <p class="text-muted" style="max-width: 600px; margin: 0 auto;">
            Pengiriman darat & udara, serta jasa titip barang dari Indonesia ke luar negeri.
        </p>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="service-card h-100">
                <div class="card-body text-center">
                    <div class="service-icon">
                        <i class="fas fa-truck"></i>
                    </div>
                    <h5 class="card-title">Pengiriman Darat</h5>
                    <p class="card-text text-muted">Layanan truk & kurir untuk pengiriman antar kota, antar provinsi, dan rute darat internasional dengan armada terpercaya.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="service-card h-100">
                <div class="card-body text-center">
                    <div class="service-icon">
                        <i class="fas fa-plane"></i>
                    </div>
                    <h5 class="card-title">Pengiriman Udara</h5>
                    <p class="card-text text-muted">Layanan kargo udara cepat untuk kebutuhan domestik dan pengiriman internasional dengan jaminan ketepatan waktu.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="service-card h-100">
                <div class="card-body text-center">
                    <div class="service-icon">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <h5 class="card-title">Jasa Titip Barang</h5>
                    <p class="card-text text-muted">Kami menerima titipan barang dari Indonesia ke luar negeri, dengan penanganan aman dan dokumentasi ekspor lengkap.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Keunggulan Section -->
<section class="keunggulan-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <span class="badge bg-success mb-2 px-3 py-2 rounded-pill">KEUNGGULAN</span>
                <h2 class="h3 fw-bold mt-2 mb-4">Kenapa Memilih SSXpress?</h2>
                <div class="keunggulan-item">
                    <div class="keunggulan-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="keunggulan-text">Jangkauan nasional dan internasional yang luas</div>
                </div>
                <div class="keunggulan-item">
                    <div class="keunggulan-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="keunggulan-text">Pilihan layanan darat dan udara sesuai kebutuhan</div>
                </div>
                <div class="keunggulan-item">
                    <div class="keunggulan-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="keunggulan-text">Pelacakan kiriman real-time dan opsi asuransi</div>
                </div>
                <div class="keunggulan-item">
                    <div class="keunggulan-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="keunggulan-text">Dukungan dokumentasi lengkap untuk pengiriman ekspor</div>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="cta-section shadow">
                    <h5>Butuh Bantuan?</h5>
                    <p class="contact-info"><i class="fas fa-phone"></i> 087828774850</p>
                    <p class="contact-info"><i class="fas fa-envelope"></i> info@ssxpress.id</p>
                    <a href="<?= base_url('home/kontak_kami') ?>" class="btn btn-light rounded-pill">Kontak Kami</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?>

<script>

</script>

<?= $this->endSection(); ?>