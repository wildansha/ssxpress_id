<?= $this->extend('template'); ?>
<?= $this->section('main'); ?>
<style>
    .judul_input {
        margin-top: 15px;
        font-weight: bold;
    }
</style>

<div class="container mt-3">
    <div class="card shadow my-2">
        <div class="card-header">
            <p class="mb-0"><?= $akun["email"] ?></p>
        </div>
        <div class="card-body">
           
        </div>
    </div>
</div>


<?= $this->endSection(); ?>

<?= $this->section('js'); ?>

<?= $this->endSection(); ?>