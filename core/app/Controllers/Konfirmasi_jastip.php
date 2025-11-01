<?php

namespace App\Controllers;


use App\Models\AdminModel;

class Konfirmasi_jastip extends BaseController
{
    public function __construct() {}


    public function detail($jastip_id)
    {
        $adminModel = new adminModel();
        $jastip =  $adminModel->detail_jastip($jastip_id);

        if (session('admin_id') !== null) {
            header("Location: " . base_url("admin_jastip/detail_jastip/$jastip_id"));
            exit;
        } else {
            header("Location: " . base_url("jastip/detail_jastip/$jastip_id"));
            exit;
        }
    }
}
