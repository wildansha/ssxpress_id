<?= $this->extend('template_landingpage'); ?>

<?= $this->section('main'); ?>

<style>
    .profile-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 600px;
        height: 600px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .profile-hero::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 500px;
        height: 500px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    /* About Section */
    .about-section {
        background: #ffffff;
    }

    .about-content {
        padding: 2rem;
    }

    .about-image {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .about-image img {
        width: 100%;
        height: 400px;
        object-fit: cover;
    }

    /* Vision Mission */
    .vision-mission {
        background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);
        padding: 80px 0;
    }

    .vision-card,
    .mission-card {
        background: white;
        border-radius: 15px;
        padding: 2.5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        height: 100%;
        transition: transform 0.3s ease;
    }

    .vision-card:hover,
    .mission-card:hover {
        transform: translateY(-5px);
    }

    .vision-icon,
    .mission-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, #a2bee8 0%, #a2bee8 100%);
    }

    .vision-icon i,
    .mission-icon i {
        font-size: 30px;
        color: white;
    }

    /* Values Section */
    .values-section {
        padding: 80px 0;
    }

    .value-card {
        text-align: center;
        padding: 2rem;
        border-radius: 15px;
        background: white;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
        height: 100%;
    }

    .value-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
    }

    .value-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, #e7f1ff 0%, #d0e4ff 100%);
    }

    .value-icon i {
        font-size: 32px;
        color: #0d6efd;
    }

    /* Stats Section */
    .stats-section {
        background: linear-gradient(135deg, #0d6efd 0%, #a2bee8 100%);
        padding: 60px 0;
        color: white;
    }

    .stat-item {
        text-align: center;
        padding: 1.5rem;
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 1rem;
        opacity: 0.9;
    }

    /* Timeline */
    .timeline-section {
        padding: 80px 0;
        background: #f8f9fa;
    }

    .timeline {
        position: relative;
        max-width: 800px;
        margin: 0 auto;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 100%;
        background: #0d6efd;
    }

    .timeline-item {
        display: flex;
        margin-bottom: 2rem;
        position: relative;
    }

    .timeline-item:nth-child(odd) {
        flex-direction: row;
    }

    .timeline-item:nth-child(even) {
        flex-direction: row-reverse;
    }

    .timeline-content {
        width: 45%;
        background: white;
        padding: 1.5rem;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    }

    .timeline-dot {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #0d6efd;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        border: 4px solid white;
        box-shadow: 0 0 0 3px #0d6efd;
    }

    .timeline-year {
        font-weight: 700;
        color: #0d6efd;
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
    }

    /* CTA Section */
    .cta-section {
        background: linear-gradient(135deg, #198754 0%, #157347 100%);
        padding: 60px 0;
        text-align: center;
        color: white;
    }

    .cta-section h2 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .cta-section .btn-light {
        margin-top: 1.5rem;
        padding: 0.75rem 2.5rem;
        font-weight: 600;
        border-radius: 50px;
        font-size: 1.1rem;
    }

    @media (max-width: 768px) {
        .profile-hero {
            padding: 60px 0 40px;
        }

        .timeline::before {
            left: 20px;
        }

        .timeline-item {
            flex-direction: row !important;
            padding-left: 50px;
        }

        .timeline-content {
            width: calc(100% - 50px);
        }

        .timeline-dot {
            left: 20px;
        }
    }
</style>

<!-- About Section -->
<section class="about-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="about-image">
                    <img src="<?= base_url('landingpage/assets/img/banner1.jpg') ?>" alt="Tentang SSXpress">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-content">
                    <span class="badge bg-primary mb-2 px-3 py-2 rounded-pill">TENTANG KAMI</span>
                    <h2 class="h3 fw-bold mt-3 mb-4">Solusi Logistik Terpadu untuk Kebutuhan Pengiriman Anda</h2>
                    <p class="text-muted mb-4" style="line-height: 1.8;">
                        SS-Xpress adalah perusahaan Pengiriman Paket Nasional dan Internasional dan jasa kurir paket Dalam Negri. Selain pengiriman barang untuk bisnis, kami juga menawarkan layanan khusus dan solusi logistik berbagai keperluan Anda.
                    </p>
                    <p class="text-muted mb-4" style="line-height: 1.8;">
                        Melayani pengiriman ke Dalam Negeri dengan dukungan express courier terbaik Nasional seperti JNE, TIKI, SICEPAT, JNT, NINJA EXPRESS, ANTAR AJAH Dll
                        Dan juga Melayani pengiriman ke luar negeri dengan dukungan express courier terbaik dunia seperti DHL, Aramex, TNT, CityLink Express, Q Express, FDEX, tentunya dengan harga terbaik.
                        Kami juga melayani pengiriman Dokumen, Pakaian, Tas, Aksesoris, Hijab, Makanan, Kosmetik, Herbal, Rokok, Elektronik Ke Negara Malaysia, Taiwan, Singapura, Hongkong, Korea, Brunei, Jepang, China, UAE (Dubai), Saudi Arabia, dan negara di seluruh Dunia
                    </p>
                    <div class="row">
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span class="text-muted">Terpercaya</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span class="text-muted">Profesional</span>
                            </div>
                        </div>
                        <div class="col-6 mt-2">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span class="text-muted">Cepat</span>
                            </div>
                        </div>
                        <div class="col-6 mt-2">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span class="text-muted">Aman</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Vision Mission Section -->
<section class="vision-mission">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary mb-2 px-3 py-2 rounded-pill">VISI & MISI</span>
            <h2 class="h3 fw-bold mt-2">Komitmen Kami</h2>
        </div>
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="vision-card">
                    <div class="vision-icon bg-white">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Visi</h4>
                    <p class="text-muted mb-0" style="line-height: 1.8;">
                        Menjadi Mitra Expedisi bagi pelaku Bisnis UMKM
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mission-card">
                    <div class="mission-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Misi</h4>
                    <ul class="text-muted mb-0" style="line-height: 2;">
                        <li>Memberikan Pelayanan Jasa Logistik Yang Terintegrasi, Berkualitas, Memberikan Keuntungan Dan Manfaat Bagi Para Mitra & UMKM</li>
                        <li>Memberikan Pelayanan Prima Melalui Jaringan Logistik yang Luas, Bekerjasama Dengan Mitra Logistik Yang Kompeten untuk Menjamin Kepuasan Pelanggan</li>
                        <li>Memberikan Solusi Logistik yang efisien, cepat dan handal</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Jenis Kerja Sama Section -->
<section class="partnership-section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary mb-2 px-3 py-2 rounded-pill">KERJA SAMA</span>
            <h2 class="h3 fw-bold mt-2">Jenis Kerja Sama</h2>
            <p class="text-muted" style="max-width: 600px; margin: 0 auto;">
                Pilih jenis kemitraan yang sesuai dengan kebutuhan bisnis Anda
            </p>
        </div>
        <div class="row g-4">
            <!-- KEMITRAAN Card -->
            <div class="col-lg-6">
                <div class="partnership-card">
                    <div class="partnership-header">
                        <div class="partnership-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h3 class="partnership-title">KEMITRAAN</h3>
                    </div>
                    <div class="partnership-body">
                        <ul class="partnership-list">
                            <li>
                                <div class="partnership-list-icon">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>
                                <span>Order Lewat Aplikasi</span>
                            </li>
                            <li>
                                <div class="partnership-list-icon">
                                    <i class="fas fa-store"></i>
                                </div>
                                <span>Pakai Brand / Nama Expedisi Sendiri</span>
                            </li>
                            <li>
                                <div class="partnership-list-icon">
                                    <i class="fas fa-search-location"></i>
                                </div>
                                <span>System Tracking</span>
                            </li>
                            <li>
                                <div class="partnership-list-icon">
                                    <i class="fas fa-truck-loading"></i>
                                </div>
                                <span>Gratis Jemput Paket</span>
                            </li>
                            <li>
                                <div class="partnership-list-icon">
                                    <i class="fas fa-tag"></i>
                                </div>
                                <span>Harga Lebih Murah</span>
                            </li>
                            <li>
                                <div class="partnership-list-icon">
                                    <i class="fas fa-gift"></i>
                                </div>
                                <span>Gratis Biaya Pendaftaran (Selama Masih Promo)</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- RESELER Card -->
            <div class="col-lg-6">
                <div class="partnership-card">
                    <div class="partnership-header">
                        <div class="partnership-icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <h3 class="partnership-title">RESELER</h3>
                    </div>
                    <div class="partnership-body">
                        <ul class="partnership-list">
                            <li>
                                <div class="partnership-list-icon">
                                    <i class="fas fa-free-code-camp"></i>
                                </div>
                                <span>GRATIS Biaya Pendaftaran</span>
                            </li>
                            <li>
                                <div class="partnership-list-icon">
                                    <i class="fas fa-shipping-fast"></i>
                                </div>
                                <span>Bisa Pilih Expedisi (JNE, TIKI, SSXPRESS)</span>
                            </li>
                            <li>
                                <div class="partnership-list-icon">
                                    <i class="fas fa-percentage"></i>
                                </div>
                                <span>Keuntungan s/d 30% setiap transaksi (syarat & ketentuan berlaku)</span>
                            </li>
                            <li>
                                <div class="partnership-list-icon">
                                    <i class="fas fa-box-open"></i>
                                </div>
                                <span>Paket di pick-up gratis</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<style>
    .partnership-section {
        padding: 80px 0;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    .partnership-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .partnership-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    }

    .partnership-header {
        background: linear-gradient(135deg, #5b6c8c 0%, #98c1ff 100%);
        padding: 2.5rem;
        text-align: center;
        color: white;
    }

    .partnership-icon {
        width: 90px;
        height: 90px;
        margin: 0 auto 1.5rem;
        background: rgb(50, 88, 102);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .partnership-icon i {
        font-size: 40px;
        color: white;
    }

    .partnership-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .partnership-body {
        padding: 2rem;
        flex: 1;
    }

    .partnership-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .partnership-list li {
        display: flex;
        align-items: flex-start;
        padding: 1rem 0;
        border-bottom: 1px solid #f0f0f0;
        transition: all 0.3s ease;
    }

    .partnership-list li:last-child {
        border-bottom: none;
    }

    .partnership-list li:hover {
        transform: translateX(10px);
    }

    .partnership-list li.highlight {
        background: linear-gradient(135deg, #F58400 0%, #ff9500 100%);
        margin: 0.5rem -1rem;
        padding: 1rem;
        border-radius: 10px;
        color: white;
    }

    .partnership-list-icon {
        width: 40px;
        height: 40px;
        min-width: 40px;
        background: linear-gradient(135deg, #e7f1ff 0%, #d0e4ff 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
    }

    .partnership-list li.highlight .partnership-list-icon {
        background: rgba(255, 255, 255, 0.3);
    }

    .partnership-list-icon i {
        font-size: 16px;
        color: #0603ff;
    }

    .partnership-list li.highlight .partnership-list-icon i {
        color: white;
    }

    .partnership-list span {
        font-size: 0.95rem;
        line-height: 1.6;
        padding-top: 0.3rem;
    }

    @media (max-width: 768px) {
        .partnership-section {
            padding: 50px 0;
        }

        .partnership-header {
            padding: 2rem;
        }

        .partnership-icon {
            width: 70px;
            height: 70px;
        }

        .partnership-icon i {
            font-size: 30px;
        }

        .partnership-title {
            font-size: 1.5rem;
        }

        .partnership-body {
            padding: 1.5rem;
        }

        .partnership-list li {
            font-size: 0.9rem;
        }
    }
</style>



<!-- Values Section -->
<section class="values-section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary mb-2 px-3 py-2 rounded-pill">NILAI PERUSAHAAN</span>
            <h2 class="h3 fw-bold mt-2">Nilai-Nilai Kami</h2>
            <p class="text-muted" style="max-width: 600px; margin: 0 auto;">
                Prinsip-prinsip yang menjadi landasan dalam setiap layanan kami
            </p>
        </div>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Integritas</h5>
                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        Jujur dan transparan dalam setiap transaksi dan layanan
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Keamanan</h5>
                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        Menjaga keselamatan setiap kiriman dengan penuh tanggung jawab
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-tachometer-alt"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Kecepatan</h5>
                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        Mengirimkan tepat waktu dengan proses yang efisien
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Pelayanan</h5>
                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        Melayani dengan sepenuh hati untuk kepuasan pelanggan
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Why Choose Us -->
<section class="about-section my-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary mb-2 px-3 py-2 rounded-pill">KEUNGGULAN</span>
            <h2 class="h3 fw-bold mt-2">Mengapa Memilih SSXpress?</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="d-flex">
                    <div class="me-3">
                        <div class="value-icon" style="width: 60px; height: 60px;">
                            <i class="fas fa-globe" style="font-size: 24px;"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="fw-bold">Jangkauan Luas</h6>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            Jaringan pengiriman mencakup seluruh Indonesia dan beberapa negara tujuan internasional
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex">
                    <div class="me-3">
                        <div class="value-icon" style="width: 60px; height: 60px;">
                            <i class="fas fa-truck" style="font-size: 24px;"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="fw-bold">Armada Terawat</h6>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            Kendaraan dan fasilitas yang selalu dijaga kualitasnya untuk keamanan kiriman
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex">
                    <div class="me-3">
                        <div class="value-icon" style="width: 60px; height: 60px;">
                            <i class="fas fa-headset" style="font-size: 24px;"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="fw-bold">Layanan Pelanggan</h6>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            Tim yang siap membantu Anda setiap saat
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <div class="d-flex">
                    <div class="me-3">
                        <div class="value-icon" style="width: 60px; height: 60px;">
                            <i class="fas fa-search" style="font-size: 24px;"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="fw-bold">Tracking Real-time</h6>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            Pantau kiriman Anda secara langsung melalui sistem tracking online
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <div class="d-flex">
                    <div class="me-3">
                        <div class="value-icon" style="width: 60px; height: 60px;">
                            <i class="fas fa-file-invoice-dollar" style="font-size: 24px;"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="fw-bold">Harga Kompetitif</h6>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            Penawaran harga yang bersaing dengan kualitas layanan terbaik
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <div class="d-flex">
                    <div class="me-3">
                        <div class="value-icon" style="width: 60px; height: 60px;">
                            <i class="fas fa-award" style="font-size: 24px;"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="fw-bold">Berpengalaman</h6>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            Tim profesional dengan pengalaman bertahun-tahun di industri logistik
                        </p>
                    </div>
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