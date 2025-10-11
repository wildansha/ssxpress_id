<?php

namespace App\Controllers;

use App\Models\AkunModel;

class Home extends BaseController
{
    public function __construct() {}

    private function api($url, $params = null, $key = '', $want_decode = true, $want_array = true)
    {

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        if ($key != '') {
            curl_setopt($ch, CURLOPT_HTTPHEADER, ["key: $key"]);
        }

        if (isset($params)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


        if ($want_decode) {
            $data = json_decode(curl_exec($ch), $want_array);
        } else {
            $data = curl_exec($ch);
        }

        curl_close($ch);

        return $data;
    }
    private function cek_login_ajax()
    {
        if (session('email_akun') === null) {
            echo json_encode(["status" => "exp"]);
        }
    }
    private function cek_login()
    {
        if (session('email_akun') === null) {
            header("Location: " . base_url("account/login"));
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

        return view('home/v_home', $data);
    }
}
