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
                                        <h1 class="h4 text-gray-900 mb-4"><b>Form Buat Akun</b></h1>
                                    </div>

                                    <form id="form_signup">
                                        <p class="mb-0">Email</p>
                                        <div class="form-group">
                                            <input required type="email" class="form-control form-control-user" name="email">
                                        </div>
                                        <div class="form-group">
                                            <p class="mb-0">Password</p>
                                            <input required type="password" class="form-control form-control-user" id="password1" name="password1">
                                        </div>
                                        <p class="mb-0">Konfirmasi Password</p>
                                        <div class="form-group">
                                            <input required type="password" class="form-control form-control-user" id="password2" name="password2">
                                        </div>
                                        <button type="submit" class="btn btn-secondary btn-user btn-block mb-3" style="background-color: var(--primary-color);">
                                            <b>Submit</b>
                                        </button>
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
    $("#form_signup").on("submit", function(e) {
        e.preventDefault();
        if ($("#password1").val() !== $("#password2").val()) {
            $('#modal_info').modal("show");
            $('#txt_modal_info').text("Password Konfirmasi Tidak Sama, Pastikan Kedua Kolom Password Sama");
        } else {
            $('#modal_loading').modal("show");
            var formData = new FormData($("#form_signup")[0]);
            $.ajax({
                method: 'POST',
                url: '<?= base_url("account/ajax_signup") ?>',
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
                            location.href = "<?= base_url('account/login') ?>";
                        }, 1000);
                    } else {
                        $('#modal_loading').modal("hide");
                        $('#modal_info').modal("show");
                        $('#txt_modal_info').text("Insert Data Gagal, Hubungi Team Terkait");
                    }
                },
                error: function(xhr, status, error) {
                    $('#modal_loading').modal("hide");
                    console.error(error);
                },
            });

        }



        return false;
    });
</script>

<?= $this->endSection(); ?>