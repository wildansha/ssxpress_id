<div class="container-fluid">
    <div class="row">
        <?php if ($city_origin == "INDRAMAYU" && $province_origin == "JAWA BARAT" && $city_destination == "INDRAMAYU" && $province_destination == "JAWA BARAT") { ?>
            <div class="col-12">
                <div class="shadow rounded p-2 mb-3" style="background-color: #464f46;color: white;">
                    <div class="row ">
                        <div class="col-12">
                            <p class="text-center mb-0">SSXPRESS</p>
                            <p class="mb-0" style="font-size: 14px !important;">Dalam Kota Indramayu</p>
                            <p class="mb-0" style="font-size: 11px !important;"></p>
                            <p class="mb-0" style="font-size: 11px !important;color: yellow;">Rp <?= number_format($berat * 7000, 0) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php for ($i = 0; $i < count($list_ongkir_dn); $i++) { ?>
            <div class="col-xl-2 col-md-3 col-sm-4 col-6">
                <div class="shadow rounded p-2 mb-3" style="background-color: #464f46;color: white;">
                    <div class="row ">
                        <div class="col-12">
                            <p class="text-center mb-0"><?= strtoupper($list_ongkir_dn[$i]["code"]) ?></p>
                            <p class="mb-0" style="font-size: 14px !important;">
                                <?= $list_ongkir_dn[$i]["service"] ?>
                                <?php if ($list_ongkir_dn[$i]["etd"] != '') { ?>
                                    <span style="font-size: 11px !important;"><?= " (" . $list_ongkir_dn[$i]["etd"] . " Hari)" ?></span>
                                <?php } ?>
                            </p>
                            <p class="mb-0" style="font-size: 11px !important;"><?= $list_ongkir_dn[$i]["description"] ?></p>
                            <p class="mb-0" style="font-size: 11px !important;color: yellow;">Rp <?= number_format($berat * $list_ongkir_dn[$i]["cost"], 0) ?></p>
                        </div>
                    </div>
                </div>
            </div>
            
        <?php } ?>
    </div>
</div>