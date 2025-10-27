<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Admin extends BaseController
{
    public function __construct() {}

    public function index()
    {
        if (empty(session('admin_id'))) {
            return view('admin/login');
        } else {
            return redirect()->to(base_url() . '/admin_product')->withInput();
        }
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
        return redirect()->to(base_url() . '/admin');
    }
}
