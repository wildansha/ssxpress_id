<?php

namespace App\Controllers;

use App\Models\PromoModel;
use App\Libraries\LibSitemap;
use App\Models\SitemapModel;

class Admin_promo extends BaseController
{

    public function __construct()
    {
        $this->promoModel = new PromoModel();
    }

    public function index()
    {
        $dataPerPage = 12;
        $currentPage = $this->request->getVar('page_promo') ? $this->request->getVar('page_promo') : 1;

        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $promo = $this->promoModel->search($keyword);
        } else {
            $promo = $this->promoModel;
        }

        if (session('username') == null) {
            return view('admin/login');
        } else {
            $data = [
                'keyword' => $keyword,
                'dataPerPage' => $dataPerPage,
                'promo' => $promo->paginate($dataPerPage, 'promo'),
                'pager' => $promo->pager,
                'currentPage' => $currentPage
            ];

            return view('admin_promo/index', $data);
        }
    }


    public function detail($id)
    {
        if (session('username') == null) {
            return view('admin/login');
        } else {
            session();

            $data = [
                'title' => 'Detail dan Edit promo',
                'validation' => \config\Services::validation(),
                'promo' => $this->promoModel->get($id)
            ];

            // jika data tidak ada
            if (empty($data['promo'])) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('promo ' . $id . ' tidak ada');
            }
            return view('admin_promo/detail', $data);
        }
    }

    public function create()
    {
        if (session('username') == null) {
            return view('admin/login');
        } else {
            session();
            $data = [
                'title' => 'Form Tambah promo',
                'validation' => \config\Services::validation()
            ];
            return view('admin_promo/create', $data);
        }
    }


    public function save()
    {
        if (session('username') == null) {
            return view('admin/login');
        } else {
            // validasi input
            if (!$this->validate([
                'judul' => [
                    'rules' => 'required|is_unique[promo.judul]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'is_unique' => '{field} sudah ada'
                    ]
                ],
                'isi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi'
                    ]
                ],
                'foto' => [
                    'rules' => 'max_size[foto,10000]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'maks foto 10 MB',
                        'is_image' => 'File yang dipilih bukan foto',
                        'mime_in' => 'File yang dipilih bukan foto'
                    ]
                ]
            ])) {
                return redirect()->to('/admin_promo/create')->withInput();
            }

            //ambil foto
            $fileFoto = $this->request->getFile('foto');

            // apakah tidak ada foto yg diupload
            if ($fileFoto->getError() == 4) {
                $judulFoto = '';
            } else {
                //generate judul file random
                $judulFoto = $fileFoto->getRandomName();

                // resize+move foto
                \Config\Services::image()
                    ->withFile($fileFoto)
                    ->resize(2000, 1000, false, 'height')
                    ->save('assets/img/promo/' . $judulFoto);
            }
            $promoModel = $this->promoModel;

            $promoModel->save([
                'judul' => $this->request->getVar('judul'),
                'isi' => $this->request->getVar('isi'),
                'foto' => $judulFoto
            ]);

            $this->sitemapModel = new SitemapModel();
            $this->sitemapModel->save([
                'url' => base_url() . "/promo/detail/" . $promoModel->getInsertID(),
                'changefreq' => "yearly",
                'priority' => 0.9,
            ]);

            session()->setFlashdata('pesan', 'Data Berhasil Ditambah.');
            return redirect()->to('/admin_promo');
        }
    }

    public function delete($id)
    {
        if (session('username') == null) {
            return view('admin/login');
        } else {
            // cari foto bedasar id
            $promo = $this->promoModel->get($id);

            // cek jika file foto default
            if ($promo['foto'] != '') {
                try {
                    unlink('assets/img/promo/' . $promo['foto']);
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
            $this->promoModel->delete($id);


            $this->sitemapModel = new SitemapModel();
            $siteMap = $this->sitemapModel->getByUrl(base_url() . '/promo/detail/' . $id);

            $this->sitemapModel->delete($siteMap['id']);

            return redirect()->to('/admin_promo');
        }
    }

    public function update($id)
    {
        if (session('username') == null) {
            return view('admin/login');
        } else {
            // CEK judul
            $promoLama = $this->promoModel->get($id);
            if ($promoLama['judul'] == $this->request->getVar('judul')) {
                $rule_judul = 'required';
            } else {
                $rule_judul = 'required|is_unique[promo.judul]';
            }

            // validasi input
            if (!$this->validate([
                'judul' => [
                    'rules' => $rule_judul,
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'is_unique' => '{field} sudah ada'
                    ]
                ],
                'isi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi'
                    ]
                ],
                'foto' => [
                    'rules' => 'max_size[foto,10000]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'ukuran maks 10 MB',
                        'is_image' => 'File yang dipilih bukan foto',
                        'mime_in' => 'File yang dipilih bukan foto'
                    ]
                ]
            ])) {
                return redirect()->to('/admin_promo/' . $this->request->getVar('slug'))->withInput();
            }

            $fileFoto = $this->request->getFile('foto');

            //cek foto, apakah tetap foto lama
            if ($fileFoto->getError() == 4) {
                $judulFoto = $this->request->getVar('fotoLama');
            } else {
                //generate random judul
                $judulFoto = $fileFoto->getRandomName();

                // resize+move foto
                \Config\Services::image()
                    ->withFile($fileFoto)
                    ->resize(2000, 1000, false, 'height')
                    ->save('assets/img/promo/' . $judulFoto);

                //hapus foto yang lama
                try {
                    unlink('assets/img/promo/' . $this->request->getVar('fotoLama'));
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }

            $this->promoModel->save([
                'id' => $id,
                'judul' => $this->request->getVar('judul'),
                'isi' => $this->request->getVar('isi'),
                'foto' => $judulFoto,
            ]);

            $this->sitemapModel = new SitemapModel();
            $siteMap = $this->sitemapModel->getByUrl(base_url() . '/promo/detail/' . $id);

            $this->sitemapModel->save([
                'id' => $siteMap['id'],
                'url' => base_url() . "/promo/detail/" . $id,
                'changefreq' => "yearly",
                'priority' => 0.9,
            ]);

            session()->setFlashdata('pesan', 'Data Berhasil Diedit.');
            return redirect()->to('/admin_promo');
        }
    }
}
