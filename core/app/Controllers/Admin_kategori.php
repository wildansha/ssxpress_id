<?php

namespace App\Controllers;

use App\Models\KategoriModel;

class Admin_kategori extends BaseController
{
    protected $kategoriModel;

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
    }

    public function index()
    {
        $dataPerPage = 12;
        $currentPage = $this->request->getVar('page_kategori') ? $this->request->getVar('page_kategori') : 1;
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $kategori = $this->kategoriModel->search($keyword);
        } else {
            $kategori = $this->kategoriModel;
        }

        if (session('username') == null) {
            return view('admin/login');
        } else {
            $data = [
                'keyword' => $keyword,
                'dataPerPage' => $dataPerPage,
                'kategori' => $kategori->paginate($dataPerPage, 'kategori'),
                'pager' => $kategori->pager,
                'currentPage' => $currentPage
            ];

            return view('admin_kategori/index', $data);
        }
    }




    public function create()
    {
        if (session('username') == null) {
            return view('admin/login');
        } else {
            session();
            $data = [
                'title' => 'Form Tambah kategori',
                'validation' => \config\Services::validation()
            ];
            return view('admin_kategori/create', $data);
        }
    }


    public function save()
    {
        if (session('username') == null) {
            return view('admin/login');
        } else {
            // validasi input
            if (!$this->validate([
                'kategori' => [
                    'rules' => 'required|is_unique[kategori.kategori]',
                    'errors' => [
                        'required' => '{field} harus diisi'
                    ]
                ],
                'foto' => [
                    'rules' => 'max_size[foto,8000]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'ukuran foto maks 8 MB',
                        'is_image' => 'File yang dipilih bukan foto',
                        'mime_in' => 'File yang dipilih bukan foto'
                    ]
                ]
            ])) {
                return redirect()->to(base_url() . '/admin_kategori/create')->withInput();
            }


            //ambil foto
            $fileFoto = $this->request->getFile('foto');

            // apakah tidak ada foto yg diupload
            if ($fileFoto->getError() == 4) {
                $namaFoto = 'default.png';
            } else {

                //generate nama file random
                $namaFoto = $fileFoto->getRandomName();

                // resize+move foto
                \Config\Services::image()
                    ->withFile($fileFoto)
                    ->resize(100, 100, false, 'height')
                    ->save('assets/img/kategori/' . $namaFoto);
            }

            $this->kategoriModel->insert([
                'kategori' => $this->request->getVar('kategori'),
                'foto' => $namaFoto
            ]);


            session()->setFlashdata('pesan', 'Data Berhasil Ditambah.');
            return redirect()->to(base_url() . '/admin_kategori');
        }
    }
    public function detail($kategori)
    {
        if (session('username') == null) {
            return view('admin/login');
        } else {
            session();

            $data = [
                'title' => 'Detail dan Edit kategori',
                'validation' => \config\Services::validation(),
                'kategori' => $this->kategoriModel->search($kategori)
            ];

            // jika data tidak ada
            if (empty($data['kategori'])) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('kategori :' . $kategori . ' tidak ada');
            }
            return view('admin_kategori/detail', $data);
        }
    }

    public function delete($keyword)
    {
        if (session('username') == null) {
            return view('admin/login');
        } else {
            // cari foto bedasar key kategori
            $kategori = $this->kategoriModel->search($keyword);

            // cek jika file foto default
            if ($kategori['foto'] != 'default.png' && $kategori['foto'] != '') {

                try {
                    unlink('assets/img/kategori/' . $kategori['foto']);
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }

            $this->kategoriModel->delete($keyword);



            return redirect()->to(base_url() . '/admin_kategori');
        }
    }

    public function update($kategori)
    {
        if (session('username') == null) {
            return view('admin/login');
        } else {
            // CEK NAMA
            $kategoriLama = $kategori;
            if ($kategoriLama == $this->request->getVar('kategori')) {
                $rule_nama = 'required';
            } else {
                $rule_nama = 'required|is_unique[kategori.kategori]';
            }
            // validasi input
            if (!$this->validate([
                'kategori' => [
                    'rules' =>  $rule_nama,
                    'errors' => [
                        'required' => '{field} harus diisi'
                    ]
                ],
                'foto' => [
                    'rules' => 'max_size[foto,8000]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'ukuran foto maks 8 MB',
                        'is_image' => 'File yang dipilih bukan foto',
                        'mime_in' => 'File yang dipilih bukan foto'
                    ]
                ]
            ])) {
                return redirect()->to(base_url() . '/admin_kategori/' . $kategori)->withInput();
            }

            $fileFoto = $this->request->getFile('foto');

            //cek foto, apakah tetap foto lama
            if ($fileFoto->getError() == 4) {
                $namaFoto = $this->request->getVar('fotoLama');
            } else {
                //generate random nama
                $namaFoto = $fileFoto->getRandomName();

                // resize+move foto
                \Config\Services::image()
                    ->withFile($fileFoto)
                    ->resize(100, 100, false, 'height')
                    ->save('assets/img/kategori/' . $namaFoto);

                if ($this->request->getVar('fotoLama') != 'default.png' && $this->request->getVar('fotoLama') != "") {
                    try {
                        unlink('assets/img/kategori/' . $this->request->getVar('fotoLama'));
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
                }
            }

            $this->kategoriModel->update($kategori, ([
                'kategori' => $this->request->getVar('kategori'),
                'foto' => $namaFoto,
            ]));

            session()->setFlashdata('pesan', 'Data Berhasil Diedit.');
            return redirect()->to(base_url() . '/admin_kategori');
        }
    }
}
