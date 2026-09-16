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
        <div class="col-md-6">
            <div class="contact-card text-center">
                <i class="fas fa-phone" style="font-size: 25px;"></i>
                <h5>Telepon</h5>
                <p>Hubungi kami melalui telepon untuk layanan cepat dan responsif.</p>
                <a href="tel:+6287863225599" class="d-block my-2">
                    <i class="fas fa-phone"></i> 0878 6322 5599
                </a>
            </div>
        </div>

        <!-- WhatsApp -->
        <div class="col-md-6">
            <div class="contact-card text-center">
                <i class="fab fa-whatsapp" style="font-size: 35px;"></i>
                <h5>WhatsApp</h5>
                <p>Chat langsung dengan tim kami melalui WhatsApp untuk bantuan instan.</p>
                <a href="https://wa.me/6287863225599" target="_blank" class="d-block my-2">
                    <i class="fab fa-whatsapp"></i> 0878 6322 5599
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
            const no_telp = $('#no_telp').val();
            const subjek = $('#subjek').val();
            const pesan = $('#pesan').val();

            // Basic validation
            if (!nama || !email || !no_telp || !subjek || !pesan) {
                alert('Semua field harus diisi!');
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