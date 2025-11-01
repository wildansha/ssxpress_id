<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\KategoriModel;
use App\Models\AkunModel;
use App\Models\AdminModel;


class admin_jastip extends BaseController
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

        $url = "https://mitraekspedisi.com/order/api_cek_resi";
        $params["p1"] = "wildanshalahuddin@gmail.com";
        $params["p2"] = "w";
        $params["p3"] = isset($data["jastip"]["resi_ssxpress"]) ? $data["jastip"]["resi_ssxpress"] : "";
        $data["tracking"] = $this->api($url, $params);
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
    public function ajax_tolak_jastip($jastip_id)
    {
        $this->cek_login_ajax();

        $adminModel = new adminModel();
        $data["list_alasan_tolak"] =  $adminModel->alasan_tolak();
        $data["jastip"] =  $adminModel->detail_jastip($jastip_id);
        return view('admin_jastip/v_admin_detail_jastip', $data);
    }
}
