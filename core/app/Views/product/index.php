<?= $this->extend('template'); ?>

<?= $this->section('main'); ?>
<main>

    <br>
    <!-- first slider -->
    <section id="promo" class="mb-3 px-3">
        <div class="container slider-promo">
            <div class="slider-promo-isi">

                <?php foreach ($promo as $p) : ?>
                    <!-- Ratio harus 20:10 -->
                    <div>
                        <a href="<?php echo base_url('promo/detail/' . $p["id"]); ?>">
                            <img src="<?= base_url("assets/img/promo/") . $p['foto'] ?>" class="rounded">
                        </a>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </section>
    <!-- /first slider -->






</main>
<?= $this->endSection(); ?>