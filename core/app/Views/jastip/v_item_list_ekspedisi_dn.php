<div class="container-fluid">
    <div class="row">
        <?php if ($city_origin == "INDRAMAYU" && $province_origin == "JAWA BARAT" && $city_destination == "INDRAMAYU" && $province_destination == "JAWA BARAT") { ?>
            <div class="col-xl-3 col-md-4 col-sm-6">
                <div class="shadow rounded p-0" style="background-color: lightslategrey;color: white;">
                    <p class="mb-0 px-2 pt-1" style="font-size: 14px !important;font-weight: bold;">SSXPRESS</p>
                    <div class="shadow rounded p-2 mb-3" style="background-color: #464f46;color: white;">
                        <div class="row ">
                            <div class="col-10">
                                <p class="mb-0" style="font-size: 14px !important;">Dalam Kota Indramayu</p>
                                <p class="mb-0" style="font-size: 11px !important;"></p>
                                <p class="mb-0" style="font-size: 11px !important;color: yellow;">Rp <?= number_format($berat * 7000, 0) ?></p>
                            </div>
                            <div class="col-2 d-flex justify-content-center align-items-center px-0">
                                <input type="radio" class="form-control m-auto" name="ekspedisi" value="<?= "SSXPRESS Dalam Kota Indramayu" . ";" . ($berat * 7000) ?>" style="width: 25px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php for ($i = 0; $i < count($list_ekspedisi); $i++) { ?>
            <div class="col-xl-3 col-md-4 col-sm-6">
                <div class="shadow rounded p-0" style="background-color: lightslategrey;color: white;">
                    <p class="mb-0 px-2 pt-1" style="font-size: 14px !important;font-weight: bold;"><?= strtoupper($list_ekspedisi[$i]["code"]) ?></p>
                    <div class="shadow rounded p-2 mb-3" style="background-color: #464f46;color: white;">
                        <div class="row ">
                            <div class="col-10">
                                <p class="mb-0" style="font-size: 14px !important;">
                                    <?= $list_ekspedisi[$i]["service"] ?>
                                    <?php if ($list_ekspedisi[$i]["etd"] != '') { ?>
                                        <span style="font-size: 11px !important;"><?= " (" . $list_ekspedisi[$i]["etd"] . " Hari)" ?></span>
                                    <?php } ?>
                                </p>
                                <p class="mb-0" style="font-size: 11px !important;"><?= $list_ekspedisi[$i]["description"] ?></p>
                                <p class="mb-0" style="font-size: 11px !important;color: yellow;">Rp <?= number_format($berat * $list_ekspedisi[$i]["cost"], 0) ?></p>
                            </div>
                            <div class="col-2 d-flex justify-content-center align-items-center px-0">
                                <input type="radio" class="form-control m-auto" name="ekspedisi" value="<?= strtoupper($list_ekspedisi[$i]["code"]) . '~' . $list_ekspedisi[$i]["service"] ?>" style="width: 25px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>