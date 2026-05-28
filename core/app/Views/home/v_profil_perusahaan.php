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

    .vision-card, .mission-card {
        background: white;
        border-radius: 15px;
        padding: 2.5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        height: 100%;
        transition: transform 0.3s ease;
    }

    .vision-card:hover, .mission-card:hover {
        transform: translateY(-5px);
    }

    .vision-icon, .mission-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
    }

    .vision-icon i, .mission-icon i {
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
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
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
                        SSXpress adalah perusahaan ekspedisi yang berkomitmen untuk memberikan layanan pengiriman terbaik 
                        bagi pelanggan di seluruh Indonesia. Dengan pengalaman bertahun-tahun di industri logistik, 
                        kami memahami bahwa setiap kiriman adalah kepercayaan yang harus dijaga dengan penuh tanggung jawab.
                    </p>
                    <p class="text-muted mb-4" style="line-height: 1.8;">
                        Kami menyediakan berbagai pilihan layanan pengiriman, mulai dari pengiriman darat dan udara, 
                        hingga jasa titip barang ke luar negeri. Dengan jaringan yang luas dan armada yang terawat, 
                        kami memastikan setiap paket sampai dengan selamat dan tepat waktu.
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
                    <div class="vision-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Visi</h4>
                    <p class="text-muted mb-0" style="line-height: 1.8;">
                        Menjadi perusahaan ekspedisi terdepan yang dipercaya oleh masyarakat Indonesia 
                        untuk solusi logistik yang cepat, aman, dan terjangkau. Kami bercita-cita 
                        untuk menghubungkan setiap sudut negeri dengan layanan pengiriman yang andal 
                        dan profesional.
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
                        <li>Memberikan layanan pengiriman yang cepat dan tepat waktu</li>
                        <li>Menjaga keamanan dan keselamatan setiap kiriman</li>
                        <li>Menyediakan harga yang kompetitif dan transparan</li>
                        <li>Membangun hubungan jangka panjang dengan pelanggan</li>
                        <li>Terus berinovasi untuk meningkatkan kualitas layanan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

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

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="stat-item">
                    <div class="stat-number">10+</div>
                    <div class="stat-label">Tahun Pengalaman</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-item">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Kota Terjangkau</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-item">
                    <div class="stat-number">10K+</div>
                    <div class="stat-label">Pengiriman/Bulan</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-item">
                    <div class="stat-number">99%</div>
                    <div class="stat-label">Tingkat Kepuasan</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="about-section">
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
                            Tim customer service yang siap membantu Anda setiap saat
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

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2>Siap Mengirim Bersama Kami?</h2>
        <p class="lead mb-4" style="opacity: 0.9;">
            Hubungi kami sekarang dan dapatkan solusi pengiriman terbaik untuk kebutuhan Anda
        </p>
        <a href="<?= base_url('home/kontak_kami') ?>" class="btn btn-light btn-lg">
            <i class="fas fa-phone me-2"></i>Hubungi Kami
        </a>
    </div>
</section>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?>

<script>

</script>

<?= $this->endSection(); ?>