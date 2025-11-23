<?php

namespace App\Controllers;

use App\Models\AkunModel;

class Akun extends BaseController
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
        if (session('akun_id') === null) {
            echo json_encode(["status" => "exp"]);
            exit;
        }
    }
    private function cek_login()
    {
        if (session('akun_id') === null) {
            header("Location: " . base_url("akun/login"));
            die;
        }
    }

    public function signup()
    {
        if (session('akun_id') !== null) {
            header("Location: " . base_url("akun/data"));
            exit;
        }
        return view('akun/v_signup');
    }
    public function ajax_signup()
    {
        if (empty($_POST["email"]) || empty($_POST["password1"])) {
            $data['status'] = 0;
            $data['msg'] = 'Email dan Passwod Wajib Diisi';
            echo json_encode($data);
            exit;
        }
        if (session('akun_id') !== null) {
            $data['status'] = 0;
            $data['msg'] = 'Anda Sudah Login';
            echo json_encode($data);
            exit;
        }

        $akunModel = new AkunModel();
        $akun = $akunModel->get_detail_akun($_POST["email"]);
        if (isset($akun["id"])) {
            $data['status'] = 0;
            $data['msg'] = 'Email telah digunakan, gunakan email lain';
            echo json_encode($data);
            exit;
        }


        $result_insert = $akunModel->insert_akun($_POST["email"], $_POST["password1"]);
        $data["status"] = $result_insert;
        $data["msg"] = "";
        echo json_encode($data);
    }
    public function login()
    {
        if (session('akun_id') !== null) {
            header("Location: " . base_url("akun/data"));
            die;
        }
        return view('akun/v_login');
    }
    public function ajax_login()
    {
        if (session("akun_id")) {
            $data['status'] = 0;
            $data['msg'] = 'Anda Sudah Login';
            echo json_encode($data);
            exit;
        }

        $akunModel = new AkunModel();
        $akun = $akunModel->get_detail_akun($_POST['email']);
        if (empty($akun)) {
            $data['status'] = 0;
            $data['msg'] = 'Email / Password Salah';
            echo json_encode($data);
            exit;
        }

        if ($_POST['email'] == $akun['email'] && $_POST['password'] == $akun['password']) {
            $session = session();
            $session->set('akun_id', $akun["id"]);
            $session->set('akun_email', $akun["email"]);
            $data['status'] = 1;
            echo json_encode($data);
            exit;
        } else {
            $data['status'] = 0;
            $data['msg'] = 'Email / Password Salah';
            echo json_encode($data);
            exit;
        }
    }

    public function logout()
    {
        $session = session();
        $session->remove('akun_id');
        return redirect()->to(base_url());
    }


    public function data()
    {
        $this->cek_login();
        $akunModel = new AkunModel();
        $data["akun"] =  $akunModel->get_detail_akun_by_id(session("akun_id"));
        dd($data);

        return view('akun/v_data_akun', $data);
    }

    public function ajax_list_kabupaten()
    {
        $this->cek_login_ajax();

        $url = "https://rajaongkir.komerce.id/api/v1/destination/city/" . $_POST["provinsi_id"];
        $key = "951566e0f3a1c31edf61914c32c4e01a";
        $data = $this->api($url, null, $key)['data'];

        echo json_encode($data);
    }
    public function ajax_list_kecamatan()
    {
        $this->cek_login_ajax();

        $url = "https://rajaongkir.komerce.id/api/v1/destination/district/" . $_POST["kabupaten_id"];
        $key = "951566e0f3a1c31edf61914c32c4e01a";
        $data = $this->api($url, null, $key)['data'];

        echo json_encode($data);
    }

    public function alamat()
    {
        $this->cek_login();

        $akunModel = new AkunModel();
        $data["list_negara"] = $akunModel->list_negara_ln();

        $url = "https://rajaongkir.komerce.id/api/v1/destination/province";
        $key = "951566e0f3a1c31edf61914c32c4e01a";
        $data["list_provinsi"] = $this->api($url, null, $key)['data'];

        return view('akun/v_alamat', $data);
    }
    public function ajax_alamat_dn()
    {
        $this->cek_login_ajax();

        $akunModel = new AkunModel();
        $result =  $akunModel->list_alamat_dn(session("akun_id"));

        $data["data"] = [];
        for ($i = 0; $i < count($result); $i++) {
            $result[$i]["index"] = $i;
            $data["data"][$i]['item']  = view("akun/v_item_alamat_dn", $result[$i]);
        }

        echo json_encode($data);
    }

    public function ajax_detail_alamat_dn()
    {
        $this->cek_login_ajax();

        $akunModel = new AkunModel();
        $result["detail"] =  $akunModel->detail_alamat_dn(session("akun_id"), $_POST["alamat_dn_id"]);
        $result["status"] = 1;

        echo json_encode($result);
    }
    public function ajax_detail_alamat_ln()
    {
        $this->cek_login_ajax();

        $akunModel = new AkunModel();
        $result["detail"] =  $akunModel->detail_alamat_ln(session("akun_id"), $_POST["alamat_ld_id"]);
        $result["status"] = 1;

        echo json_encode($result);
    }
    public function ajax_alamat_ln()
    {
        $this->cek_login_ajax();

        $akunModel = new AkunModel();
        $result =  $akunModel->list_alamat_ln(session("akun_id"));

        $data["data"] = [];
        for ($i = 0; $i < count($result); $i++) {
            $result[$i]["index"] = $i;
            $data["data"][$i]['item']  = view("akun/v_item_alamat_ln", $result[$i]);
        }

        echo json_encode($data);
    }
    public function ajax_simpan_alamat_dn()
    {
        $this->cek_login_ajax();

        $akunModel = new AkunModel();
        $params = $_POST;
        $params["akun_id"] = session("akun_id");

        $result =  $akunModel->simpan_alamat_dn($params);
        if ($result) {
            $data["status"] = 1;
        } else {
            $data["status"] = 0;
            $data["msg"] = "Gagal Insert di Database";
        }

        echo json_encode($data);
    }
    public function ajax_simpan_alamat_ln()
    {
        $this->cek_login_ajax();

        $akunModel = new AkunModel();
        $params = $_POST;
        $params["akun_id"] = session("akun_id");

        $result =  $akunModel->simpan_alamat_ln($params);
        if ($result) {
            $data["status"] = 1;
        } else {
            $data["status"] = 0;
            $data["msg"] = "Gagal Insert di Database";
        }

        echo json_encode($data);
    }

    public function ajax_delete_alamat_dn()
    {
        $this->cek_login_ajax();

        $akunModel = new AkunModel();
        $result =  $akunModel->delete_alamat_dn($_POST["alamat_dn_id"], session("akun_id"));
        if ($result) {
            $data["status"] = 1;
        } else {
            $data["status"] = 0;
            $data["msg"] = "Gagal Insert di Database";
        }

        echo json_encode($data);
    }
    public function ajax_delete_alamat_ln()
    {
        $this->cek_login_ajax();

        $akunModel = new AkunModel();
        $result =  $akunModel->delete_alamat_ln($_POST["alamat_ln_id"], session("akun_id"));
        if ($result) {
            $data["status"] = 1;
        } else {
            $data["status"] = 0;
            $data["msg"] = "Gagal Insert di Database";
        }

        echo json_encode($data);
    }
}
