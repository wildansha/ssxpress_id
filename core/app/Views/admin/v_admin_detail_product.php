<?= $this->extend('template_admin'); ?>

<?= $this->section('main'); ?>
<main>
    <div class="container">
        <div class="card">
            <div class="card-header" style="color: white;font-weight: bold;">Detail Product</div>
            <div class="card-body">
                <form id="form_update">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <div class="row">

                        <div class="col-12 mb-2">
                            <span><b>Nama Produk</b></span>
                            <input type="text" name="resi" class="form-control" value="<?= $nama; ?>">
                        </div>

                        <div class="col-12 mb-2">
                            <span><b>Kategori</b></span>
                            <select name="kategori" class="form-control">
                                <?php for ($i = 0; $i < count($kategori_all); $i++) {  ?>
                                    <option value="<?= $kategori_all[$i]["kategori"] ?>" <?= $kategori_all[$i]["kategori"] == $kategori ? "selected" : "" ?>>
                                        <?= $kategori_all[$i]["kategori"] ?>
                                    </option>
                                <?php }  ?>
                            </select>
                        </div>

                        <div class="col-12 mb-2">
                            <span><b>Deskripsi</b></span>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="deskripsi" name="deskripsi"><?= $deskripsi ?></textarea>
                                    <script>
                                        window.addEventListener('load', (event) => {
                                            ckeditor('#deskripsi')
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-2">
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