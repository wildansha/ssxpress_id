<?php

namespace App\Controllers;


use App\Models\PromoModel;

class promo extends BaseController
{
    protected $PromoModel;

    public function __construct()
    {
        $this->promoModel = new promoModel();
    }


    public function detail($id)
    {
        $data = [
            'urlFoto' => base_url().'/assets/img/promo/',
            'promo' => $this->promoModel->get($id)
        ];
        $data += $this->sosmed;


        // jika data tidak ada
        if (empty($data['promo'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('promo ' . $id . ' tidak ada');
        }
        return view('promo/detail', $data);
    }
}
