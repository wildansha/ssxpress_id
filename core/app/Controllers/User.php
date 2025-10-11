<?php

namespace App\Controllers;


use App\Models\UserModel;
use App\Models\KategoriModel;
use App\Models\PromoModel;



class User extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UserModel();

        $kategoriModel = new KategoriModel();
        $this->kategori_all =  $kategoriModel->get();

        $promoModel = new PromoModel();
        $this->promo =  $promoModel->get();
    }
    public function index()
    {

        $dataPerPage = 12;
        $currentPage = $this->request->getVar('page_user') ? $this->request->getVar('page_user') : 1;

        $keyword = $this->request->getVar('keyword');
        $kategori = $this->request->getVar('kategori');

        if ($keyword) {
            $user = $this->userModel->search($keyword, $kategori);
        } else {
            $user = $this->userModel->get();
        }


        $data = [
            'keyword' => $keyword,
            'kategori' => $kategori,
            'promo' => $this->promo,
            'kategori_all' => $this->kategori_all,
            'dataPerPage' => $dataPerPage,
            'user' => $user->paginate($dataPerPage, 'user'),
            'pager' => $user->pager,
            'currentPage' => $currentPage,
            'urlFoto' => base_url() . '/assets/img/user/'
        ];
        $data += $this->sosmed;


        return view('user/index', $data);
    }

    public function keranjang()
    {

        

     


        return view('user/keranjang', $data);
    }

    public function detail($slug)
    {
        $data = [
            'urlFoto' => base_url() . '/assets/img/user/',
            'user' => $this->userModel->get($slug)
        ];
        $data += $this->sosmed;

        // jika data tidak ada
        if (empty($data['user'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Nama user ' . $slug . ' tidak ada');
        }
        return view('user/detail', $data);
    }
}
