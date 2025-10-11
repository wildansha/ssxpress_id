<?php

namespace App\Controllers;

use App\Models\AkunModel;

class Account extends BaseController
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

    public function signup()
    {
        if (session('akun_id') !== null) {
            header("Location: " . base_url("account/profile"));
            exit;
        }
        return view('account/v_signup');
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
        $account = $akunModel->get_detail_akun($_POST["email"]);
        if (isset($account["id"])) {
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
            header("Location: " . base_url("account/profile"));
            exit;
        }
        return view('account/v_login');
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
        $account = $akunModel->get_detail_akun($_POST['email']);
        if (empty($account)) {
            $data['status'] = 0;
            $data['msg'] = 'Email / Password Salah';
            echo json_encode($data);
            exit;
        }

        if ($_POST['email'] == $account['email'] && $_POST['password'] == $account['password']) {
            $session = session();
            $session->set('akun_id', $account["id"]);
            $session->set('akun_email', $account["email"]);
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


    public function profile()
    {
        $this->cek_login();
    }
}
