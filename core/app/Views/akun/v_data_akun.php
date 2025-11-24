<?= $this->extend('template'); ?>
<?= $this->section('main'); ?>
<style>
    .judul_input {
        font-weight: bold;
    }
</style>

<div class="container mt-3">
    <div class="w-100 text-right mb-2">
        <a href="<?= base_url("akun/alamat") ?>">
            <button class="btn btn-info"><i class="fas fa-fw fa-pen"></i> Kelola Alamat</button>
        </a>
    </div>

    <div class="card shadow my-2">
        <div class="card-header" style="background-color: #55854dff;color: white;">
            <p class="mb-0 judul_input">Data Diri</p>
        </div>
        <div class="card-body">

            <form id="form_data_user">
                <div class="row">
                    <div class="col-12 mb-2">
                        <p class="judul_input mb-0">Email</p>
                        <input disabled type="text" class="form-control" value="<?= $akun["email"] ?>">
                    </div>
                    <div class="col-md-6 mb-2">
                        <p class="judul_input mb-0">Nama</p>
                        <input type="text" class="form-control" value="<?= $akun["nama"] ?>">
                    </div>
                    <div class="col-md-6 mb-2">
                        <p class="judul_input mb-0">Telp (Whatsapp)</p>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">+</span>
                            </div>
                            <input required type="number" name="telp" class="form-control" placeholder="6281293948290" value="<?= $akun["telp"] ?>">
                        </div>
                    </div>
                </div>
                <div class="w-100 text-right">
                    <button class="btn btn-success" style="font-weight: bold;background-color: #55854dff;border-color: #55854dff;">Simpan Data Diri</button>
                </div>
            </form>

        </div>
    </div>

    <div class="card shadow my-3">
        <div class="card-header" style="background-color: #603800ff;color: white;">
            <p class="mb-0 judul_input">Ubah Password</p>
        </div>
        <div class="card-body">
            <form id="form_password">
                <div class="row">
                    <div class="col-12 mb-2">
                        <p class="judul_input mb-0">Password Lama</p>
                        <input required type="password" name="password_lama" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <p class="judul_input mb-0">Password Baru</p>
                        <input required type="password" name="password1" class="form-control">
                    </div>
                    <div class="col-md-6 mb-2">
                        <p class="judul_input mb-0">Ulangi Password Baru</p>
                        <input required type="password" name="password2" class="form-control">
                    </div>
                </div>
                <div class="w-100 text-right">
                    <button class="btn btn-success my-3" style="font-weight: bold;background-color: #603800ff;border-color: #603800ff;">Simpan Perubahan Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>



<?= $this->endSection(); ?>

<?= $this->section('js'); ?>

<?= $this->endSection(); ?>