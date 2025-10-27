<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\KategoriModel;
use App\Models\AkunModel;
use App\Models\AdminModel;


class admin_jastip extends BaseController
{
    public function __construct() {}

    private function cek_login()
    {
        if (session('admin_id') === null) {
            header("Location: " . base_url("admin/login"));
            exit;
        }
    }

    private function cek_login_ajax()
    {
        if (session('admin_id') === null) {
            echo json_encode(["status" => "exp"]);
            exit;
        }
    }

    public function index()
    {
        $this->cek_login();

        $akunModel = new AkunModel();
        $data["list_status"] =  $akunModel->jastip_status();

        return view('admin_jastip/v_admin_jastip', $data);
    }

    public function ajax_list_jastip()
    {

        $this->cek_login_ajax();
        $adminModel = new adminModel();

        $list_jastip =  $adminModel->list_jastip($_POST["status_id"]);

        $data["data"] = [];
        for ($i = 0; $i < count($list_jastip); $i++) {
            $list_jastip[$i]["index"] = $i;
            $data["data"][$i]['item']  = view("admin_jastip/v_item_list_jastip", $list_jastip[$i]);
        }
        echo json_encode($data);
    }
    public function detail_jastip($jastip_id)
    {
        $this->cek_login();

        $adminModel = new adminModel();
        $data["jastip"] =  $adminModel->detail_jastip($jastip_id);
        return view('admin_jastip/v_admin_detail_jastip', $data);
    }
}
