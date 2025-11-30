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
        return view('keranjang/v_keranjang', $data);
    }

    public function ajax_alamat()
    {
        $this->cek_login_ajax();

        $akunModel = new AkunModel();
        $data["status"] = 1;
        $list_alamat_dn =  $akunModel->list_alamat_dn_singkat(session("akun_id"));
        $list_alamat_ln =  $akunModel->list_alamat_ln_singkat(session("akun_id"));

        // $data["alamat_dn"] = [];
        // for ($i = 0; $i < count($list_alamat_dn); $i++) {
        //     $data["alamat_dn"] = view('keranjang/v_item_pilih_alamat_dn',  $list_alamat_dn);
        // }

        $data["alamat_ln"] = [];
        for ($i = 0; $i < count($list_alamat_ln); $i++) {
            $data["alamat_ln"][] = view('keranjang/v_item_pilih_alamat_ln',  $list_alamat_ln[$i]);
        }

        echo json_encode($data);
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
