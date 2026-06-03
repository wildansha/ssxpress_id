<?= $this->extend('template_landingpage'); ?>

<?= $this->section('main'); ?>

<style>
    .layanan-section {
        padding: 80px 0;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    .section-title {
        text-align: center;
        margin-bottom: 50px;
    }

    .section-title h2 {
        font-size: 36px;
        font-weight: 700;
        color: #0603ff;
        margin-bottom: 15px;
        text-transform: uppercase;
        position: relative;
        display: inline-block;
    }

    .section-title h2::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background: #F58400;
    }

    .section-title p {
        font-size: 16px;
        color: #666;
        max-width: 700px;
        margin: 0 auto;
    }

    .layanan-card {
        background: white;
        border-radius: 15px;
        padding: 40px 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .layanan-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #0603ff 0%, #F58400 100%);
    }

    .layanan-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .layanan-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 25px;
        background: linear-gradient(135deg, #9f9eff 0%, #96b5e4 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .layanan-icon i {
        font-size: 36px;
        color: white;
    }

    .layanan-card h3 {
        font-size: 22px;
        font-weight: 700;
        color: #0603ff;
        margin-bottom: 20px;
        text-align: center;
    }

    .layanan-card p {
        font-size: 14px;
        color: #555;
        line-height: 1.8;
        text-align: center;
    }

    .courier-badges {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }

    .courier-badge {
        background: #f8f9fa;
        border: 2px solid #e9ecef;
        border-radius: 20px;
        padding: 8px 16px;
        font-size: 12px;
        font-weight: 600;
        color: #495057;
        transition: all 0.3s ease;
    }

    .courier-badge:hover {
        background: #0603ff;
        color: white;
        border-color: #0603ff;
        transform: scale(1.05);
    }

    .country-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 15px;
        margin-top: 20px;
    }

    .country-item {
        background: linear-gradient(135deg, #0603ff 0%, #0a58ca 100%);
        color: white;
        padding: 12px 15px;
        border-radius: 10px;
        text-align: center;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 45px;
    }

    .country-item:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(6, 3, 255, 0.3);
    }

    .product-tags {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }

    .product-tag {
        background: linear-gradient(135deg, #F58400 0%, #ff9500 100%);
        color: white;
        padding: 10px 20px;
        border-radius: 25px;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .product-tag:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(245, 132, 0, 0.4);
    }

    .features-section {
        padding: 60px 0;
        background: white;
    }

    .feature-box {
        text-align: center;
        padding: 30px 20px;
    }

    .feature-box i {
        font-size: 48px;
        color: #F58400;
        margin-bottom: 20px;
    }

    .feature-box h4 {
        font-size: 18px;
        font-weight: 700;
        color: #333;
        margin-bottom: 15px;
    }

    .feature-box p {
        font-size: 14px;
        color: #666;
        line-height: 1.6;
    }

    @media (max-width: 768px) {
        .layanan-section {
            padding: 50px 0;
        }

        .section-title h2 {
            font-size: 28px;
        }

        .layanan-card {
            padding: 30px 20px;
            margin-bottom: 20px;
        }

        .country-grid {
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 10px;
        }
    }
</style>

<div class="layanan-section">
    <div class="container">
        <div class="section-title">
            <h2>Layanan Kami</h2>
            <p>Kami menyediakan solusi pengiriman terbaik untuk kebutuhan domestik dan internasional Anda</p>
        </div>

        <div class="row">
            <!-- Layanan Dalam Negeri -->
            <div class="col-lg-6 mb-4">
                <div class="layanan-card">
                    <div class="layanan-icon">
                        <i class="fas fa-truck"></i>
                    </div>
                    <h3>Pengiriman Dalam Negeri</h3>
                    <p>Melayani pengiriman ke seluruh Indonesia dengan dukungan express courier terbaik Nasional</p>
                    <div class="courier-badges">
                        <span class="courier-badge">JNE</span>
                        <span class="courier-badge">TIKI</span>
                        <span class="courier-badge">SICEPAT</span>
                        <span class="courier-badge">JNT</span>
                        <span class="courier-badge">NINJA EXPRESS</span>
                        <span class="courier-badge">ANTAR AJAH</span>
                        <span class="courier-badge">DAN LAINNYA</span>
                    </div>
                </div>
            </div>

            <!-- Layanan Luar Negeri -->
            <div class="col-lg-6 mb-4">
                <div class="layanan-card">
                    <div class="layanan-icon">
                        <i class="fas fa-plane"></i>
                    </div>
                    <h3>Pengiriman Luar Negeri</h3>
                    <p>Melayani pengiriman internasional dengan dukungan express courier terbaik dunia dengan harga terbaik</p>
                    <div class="courier-badges">
                        <span class="courier-badge">DHL</span>
                        <span class="courier-badge">Aramex</span>
                        <span class="courier-badge">TNT</span>
                        <span class="courier-badge">CityLink Express</span>
                        <span class="courier-badge">Q Express</span>
                        <span class="courier-badge">FDEX</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Produk yang Dilayani -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="layanan-card">
                    <div class="layanan-icon">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <h3>Produk yang Kami Layani</h3>
                    <p>Kami melayani pengiriman berbagai jenis produk ke negara-negara tujuan</p>
                    <div class="product-tags">
                        <span class="product-tag">Dokumen</span>
                        <span class="product-tag">Pakaian</span>
                        <span class="product-tag">Tas</span>
                        <span class="product-tag">Aksesoris</span>
                        <span class="product-tag">Hijab</span>
                        <span class="product-tag">Makanan</span>
                        <span class="product-tag">Kosmetik</span>
                        <span class="product-tag">Herbal</span>
                        <span class="product-tag">Rokok</span>
                        <span class="product-tag">Elektronik</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Negara Tujuan -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="layanan-card">
                    <div class="layanan-icon">
                        <i class="fas fa-globe-asia"></i>
                    </div>
                    <h3>Negara Tujuan</h3>
                    <p>Kami mengirim ke berbagai negara di seluruh dunia</p>
                    <div class="country-grid">
                        <div class="country-item">Malaysia</div>
                        <div class="country-item">Taiwan</div>
                        <div class="country-item">Singapura</div>
                        <div class="country-item">Hongkong</div>
                        <div class="country-item">Korea</div>
                        <div class="country-item">Brunei</div>
                        <div class="country-item">Jepang</div>
                        <div class="country-item">China</div>
                        <div class="country-item">UAE (Dubai)</div>
                        <div class="country-item">Saudi Arabia</div>
                        <div class="country-item">Dan Negara Lainnya</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="features-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="feature-box">
                    <i class="fas fa-shield-alt"></i>
                    <h4>Aman & Terpercaya</h4>
                    <p>Paket Anda diasuransikan dan dilacak secara real-time</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box">
                    <i class="fas fa-shipping-fast"></i>
                    <h4>Pengiriman Cepat</h4>
                    <p>Layanan express untuk pengiriman tepat waktu</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box">
                    <i class="fas fa-tags"></i>
                    <h4>Harga Terjangkau</h4>
                    <p>Harga kompetitif dengan layanan terbaik</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>