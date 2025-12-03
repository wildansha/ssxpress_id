<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\KategoriModel;
use App\Models\AkunModel;
use App\Models\AdminModel;


class Admin_jastip extends BaseController
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
        // echo json_encode($list_jastip);

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
        $data["list_alasan_tolak"] =  $adminModel->alasan_tolak();
        // dd($data);exit;

        $url = "https://mitraekspedisi.com/order/api_cek_resi";
        $params["p1"] = "wildanshalahuddin@gmail.com";
        $params["p2"] = "w";
        $params["p3"] = isset($data["jastip"]["resi_ssxpress"]) ? $data["jastip"]["resi_ssxpress"] : "";
        // $params["p3"] = "SSIN10653";
        $data_track = $this->api($url, $params);
        $data = array_merge($data, $data_track);

        return view('admin_jastip/v_admin_detail_jastip', $data);
    }

    public function ajax_proses_jastip()
    {
        $this->cek_login_ajax();
        $bukti_bayar =  $this->request->getFile('foto_bukti_bayar');
        if (!$bukti_bayar->getError() == 4) {
            $rule_img = ['rules' => 'is_image[foto_bukti_bayar]|mime_in[foto_bukti_bayar,image/jpg,image/jpeg,image/png,image/ico]',];
            if ($this->validate(['foto_bukti_bayar' => $rule_img])) {
                $bukti_bayar_name = $bukti_bayar->getRandomName();
                \Config\Services::image()
                    ->withFile($bukti_bayar)
                    ->resize(400, 400, true)
                    ->save("b_byr/$bukti_bayar_name");
            } else {
                echo json_encode(["status" => 0, "msg" => "Format Foto Salah"]);
                exit;
            }
        } else {
            $bukti_bayar_name = "";
        }

        $adminModel = new adminModel();
        $result =  $adminModel->proses_jastip($_POST["jastip_id"], $bukti_bayar_name);

        if ($result) {
            echo json_encode(["status" => 1]);
        } else {
            echo json_encode(["status" => 0, "msg" => "Gagal Memproses Data"]);
        }
    }
    public function ajax_tolak_jastip()
    {
        $this->cek_login_ajax();

        $adminModel = new adminModel();
        $result =  $adminModel->tolak_jastip($_POST["jastip_id"], $_POST["alasan_tolak"], $_POST["keterangan"]);

        echo json_encode($result);
    }

    public function ajax_input_resi_jastip()
    {
        $this->cek_login_ajax();

        $adminModel = new adminModel();
        $result =  $adminModel->input_resi($_POST["jastip_id"], $_POST["resi_ssxpress"]);

        if ($result) {
            echo json_encode(["status" => 1]);
        } else {
            echo json_encode(["status" => 0, "msg" => "Gagal Memproses Data"]);
        }
    }
}
