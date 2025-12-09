<?= $this->extend('template_admin'); ?>

<?= $this->section('main'); ?>
<main>
    <div class="container">
        <div class="card">
            <div class="card-header">Detail Product</div>
            <div class="card-body">
                <form id="form_update">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <span><b>Id Order</b></span>
                            <br>
                            <span><?= "SSIN" . $id; ?></span>
                        </div>
                        <div class="col-12 mb-3">
                            <span class="label">Ekspedisi</span>
                            <textarea name="ekspedisi" class="form-control" oninput="auto_grow(this)"><?= $ekspedisi; ?></textarea>
                        </div>
                        <div class="col-12 mb-3">
                            <span><b>Resi</b></span>
                            <input type="text" name="resi" class="form-control" value="<?= $resi; ?>">
                        </div>
                        <div class="col-12 mb-3">
                            <span><b>nama_pengirim</b></span>
                            <input type="text" name="nama_pengirim" class="form-control" value="<?= $nama_pengirim; ?>">
                        </div>
                        <div class="col-12 mb-3">
                            <span><b>no_pengirim</b></span>
                            <input type="text" name="no_pengirim" class="form-control" value="<?= $no_pengirim; ?>">
                        </div>
                        <div class="col-12 mb-3">
                            <span><b>kecamatan_pengirim</b></span>
                            <input type="text" name="kecamatan_pengirim" class="form-control" value="<?= $kecamatan_pengirim; ?>">
                        </div>
                        <div class="col-12 mb-3">
                            <span><b>kota_pengirim</b></span>
                            <input type="text" name="kota_pengirim" class="form-control" value="<?= $kota_pengirim; ?>">
                        </div>
                        <div class="col-12 mb-3">
                            <span><b>Nama Penerima</b></span>
                            <input type="text" name="nama_penerima" class="form-control" value="<?= $nama_penerima; ?>">
                        </div>
                        <div class="col-12 mb-3">
                            <span><b>No penerima</b></span>
                            <input type="text" name="no_penerima" class="form-control" value="<?= $no_penerima; ?>">
                        </div>
                        <div class="col-12 mb-3">
                            <span class="label">Alamat Penerima</span>
                            <textarea name="alamat_penerima" class="form-control" oninput="auto_grow(this)"><?= $alamat_penerima; ?></textarea>
                        </div>
                        <div class="col-12 mb-3">
                            <span><b>Negara Penerima</b></span>
                            <input type="text" name="negara_penerima" class="form-control" value="<?= $negara_penerima; ?>">
                        </div>
                        <div class="col-12 mb-3">
                            <span><b>Kode Pos</b></span>
                            <input type="text" name="kode_pos" class="form-control" value="<?= $kode_pos; ?>">
                        </div>
                        <div class="col-12 mb-3">
                            <span class="label">Berat</span>
                            <input type="number" name="berat" class="form-control" value="<?= $berat; ?>">
                        </div>
                        <div class="col-12 mb-3">
                            <span class="label">Volume</span>
                            <input type="number" name="volume" class="form-control" value="<?= $volume; ?>">
                        </div>
                        <div class="col-12 mb-3">
                            <span class="label">Harga</span>
                            <input type="numer" name="harga" class="form-control" value="<?= $harga; ?>">
                        </div>
                        <div class="col-12 mb-3">
                            <span><b>kategori</b></span>
                            <select name="kategori" class="form-control">
                                <option value="DOKUMEN" <?= $kategori == "DOKUMEN" ? "selected" : ""; ?>>DOKUMEN</option>
                                <option value="GARMENT" <?= $kategori == "GARMENT" ? "selected" : ""; ?>>GARMENT</option>
                                <option value="Non GARMENT" <?= $kategori == "Non GARMENT" ? "selected" : ""; ?>>Non GARMENT</option>
                                <option value="Sensitif item" <?= $kategori == "Sensitif item" ? "selected" : ""; ?>>Sensitif item</option>
                                <option value="Elektronik PLUS BATERAI" <?= $kategori == "Elektronik PLUS BATERAI" ? "selected" : ""; ?>>Elektronik PLUS BATERAI</option>
                                <option value="ROKOK" <?= $kategori == "ROKOK" ? "selected" : ""; ?>>ROKOK</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <span><b>keterangan</b></span>
                            <input type="text" name="keterangan" class="form-control" value="<?= $keterangan; ?>">
                        </div>
                        <div class="col-12 mb-3">
                            <span><b>service</b></span>
                            <select name="service" class="form-control">
                                <option value="EXPRESS" <?= $service == "EXPRESS" ? "selected" : "" ?>>EXPRESS</option>
                                <option value="REGULER" <?= $service == "REGULER" ? "selected" : "" ?>>REGULER</option>
                                <option value="EKONOMI" <?= $service == "EKONOMI" ? "selected" : "" ?>>EKONOMI</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <span class="label">Waktu Order Dibuat</span>
                            <input disabled type="text" class="form-control" value="<?= $created_at; ?>">
                        </div>
                        <div class="col-12 mb-3">
                            <button type="submit" class="btn btn-success w-100">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection(); ?>
<?= $this->section('js'); ?>
<script>

</script>
<?= $this->endSection(); ?>