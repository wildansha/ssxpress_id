<?= $this->extend('template'); ?>

<?= $this->section('main'); ?>
<main>
    <br>
    <div class="container profile">
        <div class="row">
            <div class="col-md-6 col-12">
                <img src="<?= base_url(); ?>/assets/img/profile/<?= $profile['foto']; ?>" class="rounded">
            </div>
            <div class="col-md-6 col-12">
                <br>
                <?= $profile['deskripsi']; ?>
            </div>
        </div>
    </div>

</main>
</body>
<?= $this->endSection(); ?>