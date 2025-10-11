<?= $this->extend('template'); ?>

<?= $this->section('main'); ?>

<main>
    <div class="container detail_promo my-3">

        <div class="card shadow-lg p-3 rounded">
            <div class="row ">
                <div class="col-12 my-1 d-flex" style="max-height: 600px;">
                    <img src="<?= $urlFoto . $promo['foto']; ?>" class="rounded">
                </div>

                <div class="col-12">
                    <div class="row">
                        <p class="col-12 card-title"><?= $promo['judul']; ?></p>
                        <div class="col-12 card-text"><?= $promo['isi']; ?></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</main>


</body>

<?= $this->endSection(); ?>