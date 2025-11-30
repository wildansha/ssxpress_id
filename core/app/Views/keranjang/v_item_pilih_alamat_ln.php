<div class="card shadow w-100 mb-3">
    <div class="card-body p-1">
        <div class="row ">
            <div class="col-10">
                <p class="mb-0" style="font-size: 16px;font-weight: bold;"><?= $nama_penerima ?></p>
                <p class="mb-0" style="font-size: 12px;color: gray;"><?= "+" . $telp_penerima ?></p>
                <p class="mb-0 p-1 rounded" style="font-size: 12px;text-align: left;background-color: grey;color: white;"><?= $alamat . ", " . $negara ?></p>
            </div>
            <div class="col-2 d-flex justify-content-center align-items-center">
                <input type="radio" class="form-control m-auto" name="ekspedisi" value="" style="width: 25px;">
            </div>
        </div>
    </div>
</div>