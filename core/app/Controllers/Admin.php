<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\ProductModel;
use App\Models\KategoriModel;

class Admin extends BaseController
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
        header("Location: " . base_url("admin/product"));
        exit;
    }

    public function product()
    {
        $this->cek_login();
        $kategoriModel = new KategoriModel();

        $data = [
            'kategori_all' => $kategoriModel->get(),
        ];
        return view('admin/v_admin_product', $data);
    }


    public function add_product()
    {
        $this->cek_login();
        $kategoriModel = new KategoriModel();
        session();
        $data = [
            'title' => 'Form Tambah product',
            'validation' => \config\Services::validation(),
            'kategori_all' => $kategoriModel->get(),
        ];
        return view('admin/v_admin_add_product', $data);
    }


    public function ajax_list_product()
    {
        $adminModel = new AdminModel();
        $data["data"] = $adminModel->list_product($_POST["kategori"]);


        echo json_encode($data);
    }


    public function detail_product()
    {
        $adminModel = new AdminModel();
        $data["data"] = $adminModel->detail_product();

        return view('admin/v_admin_product', $data);
    }


    public function login()
    {
        return view('admin/login');
    }

    public function proses_login()
    {
        if (isset($_POST["username"])) {
            $adminModel = new AdminModel();
            $admin = $adminModel->getAdmin($_POST['username']);
            if (isset($_POST['password']) && isset($admin["password"]) &&  $_POST['password'] == $admin['password']) {
                $session = session();
                $session->set('admin_id', $admin['id']);
                $session->set('admin_username', $admin['username']);
                return redirect()->to(base_url() . '/admin');
            } else {
                $data['msg'] = 'Username / Password Salah';
                return view('admin/login', $data);
            }
        }
    }

    public function logout()
    {

        $session = session();
        $session->remove('admin_id');
        $session->remove('admin_username');


        return redirect()->to(base_url("admin"));
    }
}
