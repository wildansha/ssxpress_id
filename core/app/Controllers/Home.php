<?php

namespace App\Controllers;

use App\Models\AkunModel;

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

        return view('home/v_home', $data);
    }
}
