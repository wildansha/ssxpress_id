<?php

namespace App\Controllers;

use App\Models\AkunModel;

class Auth extends BaseController
{
    public function __construct()
    {
        if (session('email_akun') == null) {
            return view('auth/login');
        }
    }

    public function index()
    {
        if (session('email_akun') == null) {
            return view('auth/login');
        } else {
            return redirect()->to(base_url() . '/auth_product')->withInput();
        }
    }


}
