<?= $this->extend('template'); ?>

<?= $this->section('main'); ?>

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5" style="border-radius: 20px;">
                    <div class="card-body p-0">

                        <div class="row">
                            <div class="col-12">
                                <div class="px-5 py-3" style="margin-bottom: 35px;">
                                    <div class="text-center mt-3 mb-3">
                                        <h1 class="h4 text-gray-900 mb-4"><b>Silahkan Login</b></h1>
                                    </div>

                                    <form id="form_login">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" name="email" placeholder="email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password" placeholder="password">
                                        </div>
                                        <button type="submit" class="btn btn-secondary btn-user btn-block mb-3" style="background-color: var(--primary-color);">
                                            <b>Login</b>
                                        </button>

                                        <span>Belum punya akun?</span> <a href="<?= base_url("account/signup") ?>"> Buat Akun</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>


</body>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?>

<script>
    $("#form_login").on("submit", function(e) {
        e.preventDefault();
        $('#modal_loading').modal("show");
        var formData = new FormData($("#form_login")[0]);
        $.ajax({
            method: 'POST',
            url: '<?= base_url("account/ajax_login") ?>',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                response = JSON.parse(response);
                $('#modal_loading').modal("hide");
                if (response.status == 'exp') {
                    location.reload();
                } else if (response.status == 1) {
                    $("#modal_berhasil_autoclose").modal("show");
                    setTimeout(() => {
                        location.href = "<?= base_url('') ?>";
                    }, 1000);
                } else {
                    $('#modal_loading').modal("hide");
                    $('#modal_info').modal("show");
                    $('#txt_modal_info').text(response.msg);
                }
            },
            error: function(xhr, status, error) {
                $('#modal_loading').modal("hide");
                console.error(error);
            },
        });

        return false;
    });
</script>

<?= $this->endSection(); ?>