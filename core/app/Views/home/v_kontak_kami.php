<?= $this->extend('template_landingpage'); ?>

<?= $this->section('main'); ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .contact-section {
        padding: 60px 0;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .contact-card {
        background: white;
        color: #333;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 20px;
    }

    .contact-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .contact-card i {
        font-size: 40px;
        color: #667eea;
        margin-bottom: 15px;
    }

    .contact-card h5 {
        font-weight: bold;
        margin-bottom: 10px;
        color: #333;
    }

    .contact-card p {
        margin: 5px 0;
        font-size: 14px;
    }

    .contact-card a {
        color: #667eea;
        text-decoration: none;
        font-weight: 500;
    }

    .contact-card a:hover {
        text-decoration: underline;
    }

    .form-section {
        background: #f8f9fa;
        padding: 60px 0;
    }

    .form-card {
        background: white;
        border-radius: 10px;
        padding: 40px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .form-card h3 {
        font-weight: bold;
        margin-bottom: 30px;
        color: #333;
    }

    .form-control {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 12px 15px;
        font-size: 14px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .btn-submit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: bold;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        color: white;
        text-decoration: none;
    }

    .map-section {
        background: white;
        padding: 60px 0;
    }

    .map-container {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        height: 400px;
    }

    .social-links {
        display: flex;
        gap: 15px;
        margin-top: 20px;
    }

    .social-links a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        background: #667eea;
        color: white;
        border-radius: 50%;
        text-decoration: none;
        transition: transform 0.3s ease, background 0.3s ease;
        font-size: 20px;
    }

    .social-links a:hover {
        background: #764ba2;
        transform: translateY(-3px);
    }

    .breadcrumb-section {
        background: #f8f9fa;
        padding: 20px 0;
    }

    .title-section h1 {
        font-weight: bold;
        color: white;
        margin-bottom: 10px;
    }

    .title-section p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 16px;
    }

    @media (max-width: 768px) {
        .contact-section {
            padding: 40px 0;
        }

        .form-card {
            padding: 20px;
        }

        .map-container {
            height: 300px;
        }
    }
</style>

<!-- Header Section -->
<div class="contact-section">
    <div class="container-fluid">
        <div class="row align-items-center py-5">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="mb-3" style="font-size: 48px; font-weight: bold;">Hubungi Kami</h1>
                <p style="font-size: 18px; opacity: 0.95;">Kami siap melayani Anda dengan sepenuh hati. Jangan ragu untuk menghubungi kami melalui berbagai channel yang tersedia.</p>
            </div>
        </div>
    </div>
</div>

<!-- Contact Information Section -->
<div class="container-fluid py-5">
    <div class="row">
        <!-- Phone -->
        <div class="col-md-4">
            <div class="contact-card text-center">
                <i class="fas fa-phone"></i>
                <h5>Telepon</h5>
                <p>Hubungi kami melalui telepon untuk layanan cepat dan responsif.</p>
                <a href="tel:085315999960" class="d-block my-2">
                    <i class="fas fa-phone"></i> 085315999960
                </a>
                <a href="tel:087828774850" class="d-block">
                    <i class="fas fa-phone"></i> 087828774850
                </a>
            </div>
        </div>

        <!-- WhatsApp -->
        <div class="col-md-4">
            <div class="contact-card text-center">
                <i class="fab fa-whatsapp"></i>
                <h5>WhatsApp</h5>
                <p>Chat langsung dengan tim kami melalui WhatsApp untuk bantuan instan.</p>
                <a href="https://wa.me/6285315999960" target="_blank" class="d-block my-2">
                    <i class="fab fa-whatsapp"></i> 085315999960
                </a>
                <a href="https://wa.me/6287828774850" target="_blank" class="d-block">
                    <i class="fab fa-whatsapp"></i> 087828774850
                </a>
            </div>
        </div>

        <!-- Email -->
        <div class="col-md-4">
            <div class="contact-card text-center">
                <i class="fas fa-envelope"></i>
                <h5>Email</h5>
                <p>Kirimkan pertanyaan atau proposal bisnis melalui email.</p>
                <a href="mailto:info@ssxpress.id" class="d-block my-2">
                    <i class="fas fa-envelope"></i> info@ssxpress.id
                </a>
                <a href="mailto:support@ssxpress.id" class="d-block">
                    <i class="fas fa-envelope"></i> support@ssxpress.id
                </a>
            </div>
        </div>
    </div>
</div>



<!-- Office Information Section -->
<div class="container-fluid py-5" style="background: white;">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h3 style="font-weight: bold; margin-bottom: 30px; text-align: center; color: #333;">
                <i class="fas fa-building"></i> Informasi Kantor
            </h3>

            <div class="row">
                <!-- Alamat -->
                <div class="col-md-6 mb-4">
                    <div class="contact-card">
                        <i class="fas fa-map-marker-alt"></i>
                        <h5>Alamat Kantor</h5>
                        <p>
                            Jl. Merdeka No. 123<br>
                            Kelurahan Kemiri<br>
                            Kecamatan Kebayoran Lama<br>
                            Jakarta Selatan 12240
                        </p>
                    </div>
                </div>

                <!-- Jam Operasional -->
                <div class="col-md-6 mb-4">
                    <div class="contact-card">
                        <i class="fas fa-clock"></i>
                        <h5>Jam Operasional</h5>
                        <p>
                            <strong>Senin - Jumat:</strong> 08:00 - 17:00<br>
                            <strong>Sabtu:</strong> 09:00 - 14:00<br>
                            <strong>Minggu & Hari Libur:</strong> Tutup
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Map Section -->
<div class="map-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <h3 style="font-weight: bold; margin-bottom: 30px; text-align: center; color: #333;">
                    <i class="fas fa-map"></i> Lokasi Kami
                </h3>
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.3567394989006!2d106.7931486!3d-6.265476!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f2d8f8f8f8f9%3A0x8f8f8f8f8f8f8f8f!2sJl.%20Merdeka%20No.%20123!5e0!3m2!1sid!2sid!4v1234567890" style="width:100%;height:100%;border:none;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Social Media Section -->
<div class="container-fluid py-5" style="background: #f8f9fa;">
    <div class="row">
        <div class="col-lg-6 mx-auto text-center">
            <h3 style="font-weight: bold; margin-bottom: 30px; color: #333;">
                <i class="fas fa-share-alt"></i> Ikuti Media Sosial Kami
            </h3>
            <p style="color: #666; margin-bottom: 30px;">Dapatkan informasi terbaru dan penawaran eksklusif dari SSxpress melalui media sosial kami.</p>
            <div class="social-links justify-content-center">
                <a href="https://www.facebook.com/ssxpress" target="_blank" title="Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://www.instagram.com/ssxpress" target="_blank" title="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://www.twitter.com/ssxpress" target="_blank" title="Twitter">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="https://www.linkedin.com/company/ssxpress" target="_blank" title="LinkedIn">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                <a href="https://www.tiktok.com/@ssxpress" target="_blank" title="TikTok">
                    <i class="fab fa-tiktok"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?>

<script>
    $(document).ready(function() {
        // Form submission handler
        $('#contactForm').on('submit', function(e) {
            e.preventDefault();

            const nama = $('#nama').val();
            const email = $('#email').val();
            const no_telp = $('#no_telp').val();
            const subjek = $('#subjek').val();
            const pesan = $('#pesan').val();

            // Basic validation
            if (!nama || !email || !no_telp || !subjek || !pesan) {
                alert('Semua field harus diisi!');
                return;
            }

            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Format email tidak valid!');
                return;
            }

            // Phone number validation (10-13 digits)
            const phoneRegex = /^(\+62|0)[0-9]{9,12}$/;
            if (!phoneRegex.test(no_telp.replace(/\s+/g, ''))) {
                alert('Nomor telepon tidak valid! (min 10 digit)');
                return;
            }

            // Show success message
            alert('Terima kasih! Pesan Anda telah terkirim. Kami akan segera menghubungi Anda.');

            // Reset form
            $(this)[0].reset();

            // Optionally, you can send the data to the server
            /*
            $.ajax({
                url: '<?= base_url('home/send_contact_message') ?>',
                type: 'POST',
                data: {
                    nama: nama,
                    email: email,
                    no_telp: no_telp,
                    subjek: subjek,
                    pesan: pesan
                },
                dataType: 'json',
                success: function(response) {
                    alert('Terima kasih! Pesan Anda telah terkirim.');
                    $('#contactForm')[0].reset();
                },
                error: function() {
                    alert('Terjadi kesalahan, silakan coba lagi!');
                }
            });
            */
        });

        // Smooth scroll for navigation
        $('a[href^="#"]').on('click', function(e) {
            e.preventDefault();
            const target = $(this.getAttribute('href'));
            if (target.length) {
                $('html, body').stop().animate({
                    scrollTop: target.offset().top - 100
                }, 1000);
            }
        });
    });
</script>

<?= $this->endSection(); ?>