<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Admin extends BaseController
{
    public function __construct()
    {
        if (session('username') == null) {
            return view('admin/login');
        }
    }

    public function index()
    {
        if (session('username') == null) {
            return view('admin/login');
        } else {
            return redirect()->to(base_url() . '/admin_product')->withInput();
        }
    }

    public function login()
    {
        if ($this->exists($_POST['username'], $_POST['password']) != null) {
            $session = session();
            $session->set('username', $_POST['username']);
            return redirect()->to(base_url() . '/admin');
        } else {
            $data['msg'] = 'Username / Password Salah';
            return view('admin/login', $data);
        }
    }

    public function exists($username, $password)
    {
        $adminModel = new AdminModel();
        $admin = $adminModel->getAdmin($username);
        if ($admin != null) {
            if ($username == $admin['username'] &&  $password == $admin['password']) {
                return $admin;
            }
        }
    }

    public function logout()
    {
        $session = session();
        $session->remove('username');
        return redirect()->to(base_url() . '/admin');
    }
}
