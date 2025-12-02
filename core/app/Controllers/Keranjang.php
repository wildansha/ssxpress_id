<?php

namespace App\Controllers;

use App\Models\AkunModel;

class Keranjang extends BaseController
{
    public function __construct() {}

    private function cek_login_ajax()
    {
        if (session('akun_id') === null) {
            echo json_encode(["status" => "exp"]);
            exit;
        }
    }
    private function cek_login()
    {
        if (session('akun_id') === null) {
            header("Location: " . base_url("akun/login"));
            exit;
        }
    }

    public function index()
    {
        $this->cek_login();
        $akunModel = new AkunModel();
        $data["list_negara"] =  $akunModel->list_negara_ln(session("akun_id"));

        $list_alamat_dn =  $akunModel->list_alamat_dn_singkat(session("akun_id"));
        $list_alamat_ln =  $akunModel->list_alamat_ln_singkat(session("akun_id"));
        $data["alamat_dn"] = [];
        for ($i = 0; $i < count($list_alamat_dn); $i++) {
            $data["alamat_dn"][] = view('keranjang/v_item_pilih_alamat_dn',  $list_alamat_dn[$i]);
        }
        $data["alamat_ln"] = [];
        for ($i = 0; $i < count($list_alamat_ln); $i++) {
            $data["alamat_ln"][] = view('keranjang/v_item_pilih_alamat_ln',  $list_alamat_ln[$i]);
        }
        return view('keranjang/v_keranjang', $data);
    }

    public function ajax_alamat()
    {
        $this->cek_login_ajax();

        $akunModel = new AkunModel();
        $data["status"] = 1;
        $list_alamat_dn =  $akunModel->list_alamat_dn_singkat(session("akun_id"));
        $list_alamat_ln =  $akunModel->list_alamat_ln_singkat(session("akun_id"));

        $data["alamat_dn"] = [];
        for ($i = 0; $i < count($list_alamat_dn); $i++) {
            $data["alamat_dn"][] = view('keranjang/v_item_pilih_alamat_dn',  $list_alamat_dn[$i]);
        }

        $data["alamat_ln"] = [];
        for ($i = 0; $i < count($list_alamat_ln); $i++) {
            $data["alamat_ln"][] = view('keranjang/v_item_pilih_alamat_ln',  $list_alamat_ln[$i]);
        }

        echo json_encode($data);
    }

    public function ajax_ekspedisi()
    {
        $this->cek_login_ajax();

        // $volume = $_POST["panjang"] * $_POST["lebar"] * $_POST["tinggi"];
        $volume = 1;
        // $berat = $_POST["berat"];
        $berat = 1;

        if ($volume / 6000 > $berat) {
            $berat = $volume / 6000;
        }
        $berat = ceil($berat);

        $akunModel = new AkunModel();
        $arr_alamat = explode("_", $_POST["alamat"]);

        if ($arr_alamat[0] == "dn") {
            $detail_alamat =  $akunModel->detail_alamat_dn(session("akun_id"), $arr_alamat[1]);

            // 1193 = Kec.indramayu Kab. Indramayu
            $id_origin = 1193;
            $city_origin = "INDRAMAYU";
            $province_origin = "JAWA BARAT";

            $id_destination = $detail_alamat["kecamatan_id"];
            $city_destination = $detail_alamat["kabupaten"];
            $province_destination = $detail_alamat["provinsi"];



            $url = "https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost";
            $key = "951566e0f3a1c31edf61914c32c4e01a";
            $params["origin"] = $id_origin;
            $params["destination"] = $id_destination;
            $params["weight"] = $berat;
            $params["courier"] = "jne:jnt";

            $response = $this->api($url, $params, $key);

            if (isset($response["data"])) {
                $data["status"] = 1;
                $data["list_pengiriman"] = view('keranjang/v_item_list_pengiriman_dn', [
                    "list_pengiriman" => $response["data"],
                    "city_origin" => $city_origin,
                    "province_origin" => $province_origin,
                    "city_destination" => $city_destination,
                    "province_destination" => $province_destination,
                    "berat" => $berat
                ]);
            } else {
                $data["status"] = 0;
                $data["list_pengiriman"] = [];
            }

            echo json_encode($data);
        }
    }

    public function ajax_list_keranjang()
    {
        $this->cek_login_ajax();
        $akunModel = new AkunModel();

        $data["status"] = 1;
        $data["data"] =  $akunModel->list_product_keranjang(session("akun_id"));

        echo json_encode($data);
    }
}
