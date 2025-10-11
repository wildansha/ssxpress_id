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
            header("Location: " . base_url("account/login"));
            exit;
        }
    }

    public function index()
    {
        $this->cek_login();

        return view('keranjang/v_keranjang');
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
