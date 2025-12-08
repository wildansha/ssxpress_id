<div class="card shadow w-100 mb-3">
    <div class="card-body p-1">
        <div class="row ">
            <div class="col-2 d-flex justify-content-center align-items-center px-0">
                <input type="radio" class="form-control ml-2" name="alamat" value="ln_<?= $id ?>?>" style="width: 24px;">
            </div>
            <div class="col-10 pl-0">
                <p class="mb-0" style="font-size: 14px;font-weight: bold;"><?= $nama_penerima ?></p>
                <p class="mb-0" style="font-size: 12px !important;color: gray;"><?= "+" . $telp_penerima ?></p>
                <hr class="my-1">
                <p class="mb-0" style="font-size: 12px !important;text-align: left;"><?= $alamat . ", " . $negara ?></p>
            </div>
        </div>
    </div>
</div>