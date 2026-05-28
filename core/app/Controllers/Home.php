<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\HomeModel;

class Home extends BaseController
{
    public function __construct() {}


    private function cek_login_ajax()
    {
        if (session('email_akun') === null) {
            echo json_encode(["status" => "exp"]);
        }
    }
    private function cek_login()
    {
        if (session('email_akun') === null) {
            header("Location: " . base_url("akun/login"));
            exit;
        }
    }

    public function index()
    {
        $data = [];
        if (isset($_GET["id_order"])) {
            $data["id_order"] = $_GET["id_order"];

            $url = "https://mitraekspedisi.com/order/api_cek_resi";
            $params["p1"] = "wildanshalahuddin@gmail.com";
            $params["p2"] = "w";
            $params["p3"] = $_GET["id_order"];
            $data = $this->api($url, $params);
            // dd($data);
        }
        $homeModel = new HomeModel();
        $data["list_negara_cek_ongkir_ln"] = $homeModel->list_negara_cek_ongkir_ln();

        $data["list_kabupaten_agen"] = $homeModel->list_kabupaten_agen();
        return view('home/v_home', $data);
    }

    public function ajax_list_kecamatan()
    {

        $url = "https://rajaongkir.komerce.id/api/v1/destination/domestic-destination?limit=100&search=" . rawurlencode($_POST["search"]);
        $key = "951566e0f3a1c31edf61914c32c4e01a";

        $response = $this->api($url, null, $key);


        echo json_encode($response);
    }

    public function ajax_list_agen()
    {

        $homeModel = new HomeModel();
        $list_agen = $homeModel->list_agen($_POST["kabupaten_agen"]);
        $data["data"] = [];
        for ($i = 0; $i < count($list_agen); $i++) {
            $list_agen[$i]["index"] = $i;
            $data["data"][$i]['item']  = view("home/v_item_agen", $list_agen[$i]);
        }


        echo json_encode($data);
    }

    public function ajax_list_ongkir_dn()
    {
        $volume = $_POST["panjang"] * $_POST["lebar"] * $_POST["tinggi"];
        $berat = $_POST["berat"];
        if ($volume / 6000 > $_POST["berat"]) {
            $berat = $volume / 6000;
        }
        $berat = ceil($berat);

        $origin = explode("|", $_POST["origin"]);
        $id_origin = $origin[0];
        $district_origin = $origin[1];
        $city_origin = $origin[2];
        $province_origin = $origin[3];

        $destination = explode("|", $_POST["destination"]);
        $id_destination = $destination[0];
        $district_destination = $destination[1];
        $city_destination = $destination[2];
        $province_destination = $destination[3];

        $url = "https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost";
        $key = "951566e0f3a1c31edf61914c32c4e01a";
        $params["origin"] = $id_origin;
        $params["destination"] = $id_destination;
        $params["weight"] = $berat;
        $params["courier"] = "jne:jnt";

        $response = $this->api($url, $params, $key);



        if (isset($response["data"])) {
            $data["status"] = 1;
            $data["list_ongkir_dn"] = view('home/v_item_list_ongkir_dn', [
                "list_ongkir_dn" => $response["data"],
                "city_origin" => $city_origin,
                "province_origin" => $province_origin,
                "city_destination" => $city_destination,
                "province_destination" => $province_destination,
                "berat" => $berat
            ]);
        } else {
            $data["status"] = 0;
            $data["list_ongkir_dn"] = [];
        }



        echo json_encode($data);
    }

    public function ajax_list_ongkir_ln()
    {
        $homeModel = new HomeModel();
        $result = $homeModel->detail_ongkir_ln($_POST["negara_ongkirln"])["text_ongkir"];


        echo json_encode($result);
    }


    public function kontak_kami()
    {
        $data = [];
        return view('home/v_kontak_kami', $data);
    }

    public function profil_perusahaan()
    {
        $data = [];
        return view('home/v_profil_perusahaan', $data);
    }

    public function layanan()
    {
        $data = [];
        return view('home/v_layanan', $data);
    }
}
