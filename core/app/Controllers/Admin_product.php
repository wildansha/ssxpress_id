<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\KategoriModel;


class admin_product extends BaseController
{
    public function __construct()
    {
        $this->productModel = new ProductModel();
        $kategoriModel = new KategoriModel();
        $this->kategori_all =  $kategoriModel->get();
    }
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
        $this->cek_login();
        
        $dataPerPage = 12;
        $currentPage = $this->request->getVar('page_product') ? $this->request->getVar('page_product') : 1;

        $keyword = $this->request->getVar('keyword');
        $kategori = $this->request->getVar('kategori');

        $product = $this->productModel->search($keyword, $kategori);



        $data = [
            'keyword' => $keyword,
            'kategori' => $kategori,
            'kategori_all' => $this->kategori_all,
            'dataPerPage' => $dataPerPage,
            'product' => $product->paginate($dataPerPage, 'product'),
            'pager' => $product->pager,
            'currentPage' => $currentPage
        ];

        return view('admin_product/index', $data);
    }


    public function detail($slug)
    {
        if (session('username') == null) {
            return view('admin/login');
        } else {
            session();

            $data = [
                'title' => 'Detail dan Edit product',
                'validation' => \config\Services::validation(),
                'product' => $this->productModel->get($slug),
                'kategori_all' => $this->kategori_all,
            ];

            // jika data tidak ada
            if (empty($data['product'])) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Nama product ' . $slug . ' tidak ada');
            }
            return view('admin_product/detail', $data);
        }
    }

    public function create()
    {
        if (session('username') == null) {
            return view('admin/login');
        } else {
            session();
            $data = [
                'title' => 'Form Tambah product',
                'validation' => \config\Services::validation(),
                'kategori_all' => $this->kategori_all,
            ];
            return view('admin_product/create', $data);
        }
    }


    public function save()
    {
        if (session('username') == null) {
            return view('admin/login');
        } else {
            // validasi input
            $rule_foto = [];
            for ($i = 1; $i <= 6; $i++) {
                array_push(
                    $rule_foto,
                    [
                        'rules' => 'max_size[foto' . $i . ',8000]|is_image[foto' . $i . ']|mime_in[foto' . $i . ',image/jpg,image/jpeg,image/png]',
                        'errors' => [
                            'max_size' => 'ukuran foto maks 8mb',
                            'is_image' => 'File yang dipilih bukan foto',
                            'mime_in' => 'File yang dipilih bukan foto'
                        ]
                    ]
                );
            }


            if (!$this->validate([
                'nama' => [
                    'rules' => 'required|is_unique[product.nama]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'is_unique' => '{field} sudah ada'
                    ]
                ],
                'harga' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi'
                    ]
                ],
                'foto1' => $rule_foto[0],
                'foto2' => $rule_foto[1],
                'foto3' => $rule_foto[2],
                'foto4' => $rule_foto[3],
                'foto5' => $rule_foto[4]
            ])) {
                return redirect()->to(base_url() . '/admin_product/create')->withInput();
            }


            //ambil foto
            $fileFoto = [
                $this->request->getFile('foto1'),
                $this->request->getFile('foto2'),
                $this->request->getFile('foto3'),
                $this->request->getFile('foto4'),
                $this->request->getFile('foto5'),
            ];

            $namaFoto = [];
            for ($i = 0; $i < count($fileFoto); $i++) {
                // apakah tidak ada foto yg diupload
                if ($fileFoto[$i]->getError() == 4) {
                    $namaFoto[$i] = '';
                } else {
                    //generate nama file random
                    $namaFoto[$i] = $fileFoto[$i]->getRandomName();

                    // resize+move foto
                    \Config\Services::image()
                        ->withFile($fileFoto[$i])
                        ->resize(700, 700, false, 'height')
                        ->save('assets/img/product/' . $namaFoto[$i]);
                }
            }

            $slug = url_title($this->request->getVar('nama'), '-', true);
            $this->productModel->save([
                'nama' => $this->request->getVar('nama'),
                'slug' => $slug,
                'kategori' => $this->request->getVar('kategori'),
                'deskripsi' => $this->request->getVar('deskripsi'),
                'harga' => $this->request->getVar('harga'),
                'foto1' => $namaFoto[0],
                'foto2' => $namaFoto[1],
                'foto3' => $namaFoto[2],
                'foto4' => $namaFoto[3],
                'foto5' => $namaFoto[4],

            ]);

            session()->setFlashdata('pesan', 'Data Berhasil Ditambah.');
            return redirect()->to(base_url() . '/admin_product');
        }
    }
    public function update($id)
    {
        if (session('username') == null) {
            return view('admin/login');
        } else {
            // CEK NAMA
            $productLama = $this->productModel->find($id);
            if ($productLama['nama'] == $this->request->getVar('nama')) {
                $rule_nama = 'required';
            } else {
                $rule_nama = 'required|is_unique[product.nama]';
            }

            $rule_foto = [];
            for ($i = 1; $i <= 6; $i++) {
                array_push(
                    $rule_foto,
                    [
                        'rules' => 'max_size[foto' . $i . ',8000]|is_image[foto' . $i . ']|mime_in[foto' . $i . ',image/jpg,image/jpeg,image/png]',
                        'errors' => [
                            'max_size' => 'ukuran foto maks 8mb',
                            'is_image' => 'File yang dipilih bukan foto',
                            'mime_in' => 'File yang dipilih bukan foto'
                        ]
                    ]
                );
            }
            // validasi input
            if (!$this->validate([
                'nama' => $rule_nama,
                'harga' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi'
                    ]
                ],
                'foto1' => $rule_foto[0],
                'foto2' => $rule_foto[1],
                'foto3' => $rule_foto[2],
                'foto4' => $rule_foto[3],
                'foto5' => $rule_foto[4]
            ])) {
                return redirect()->to(base_url() . '/admin_product/' . $this->request->getVar('slug'))->withInput();
            }

            $fileFoto = [
                $this->request->getFile('foto1'),
                $this->request->getFile('foto2'),
                $this->request->getFile('foto3'),
                $this->request->getFile('foto4'),
                $this->request->getFile('foto5'),
            ];

            //cek foto, apakah tetap foto lama
            for ($i = 0; $i < count($fileFoto); $i++) {
                $j = $i + 1;

                // apakah tidak ada foto yg diupload
                if ($fileFoto[$i]->getError() == 4) {
                    $namaFoto[$i] = $this->request->getVar("foto" . $j . "Lama");

                    //menghapus foto apabila terdeteksi menekan tombol hapus foto
                    if ($this->request->getVar('foto' . $j . 'Lama') != 'default.jpg' && $this->request->getVar('foto' . $j . 'Lama') != '') {
                        if ($this->request->getVar('hapusFoto' . $j) == 'y') {
                            $namaFoto[$i] = "";
                            try {
                                unlink('assets/img/product/' . $this->request->getVar('foto' . $j . 'Lama'));
                            } catch (\Throwable $th) {
                                //throw $th;
                            }
                        }
                    }
                } else {
                    //generate nama file random
                    $namaFoto[$i] = $fileFoto[$i]->getRandomName();

                    // resize+move foto
                    \Config\Services::image()
                        ->withFile($fileFoto[$i])
                        ->resize(700, 700, false, 'height')
                        ->save('assets/img/product/' . $namaFoto[$i]);

                    if ($this->request->getVar('foto' . $j . 'Lama') != 'default.jpg' && $this->request->getVar('foto' . $j . 'Lama') != '') {
                        try {
                            unlink('assets/img/product/' . $this->request->getVar('foto' . $j . 'Lama'));
                        } catch (\Throwable $th) {
                            //throw $th;
                        }
                    }
                }
            }

            $slug = url_title($this->request->getVar('nama'), '-', true);
            $this->productModel->save([
                'id' => $id,
                'nama' => $this->request->getVar('nama'),
                'slug' => $slug,
                'kategori' => $this->request->getVar('kategori'),
                'deskripsi' => $this->request->getVar('deskripsi'),
                'harga' => $this->request->getVar('harga'),
                'foto1' => $namaFoto[0],
                'foto2' => $namaFoto[1],
                'foto3' => $namaFoto[2],
                'foto4' => $namaFoto[3],
                'foto5' => $namaFoto[4],
            ]);

            $siteMap = $this->sitemapModel->getByUrl(base_url() . '/product/detail/' . $productLama['slug']);

            $this->sitemapModel->save([
                'id' => $siteMap['id'],
                'url' => base_url() . "/product/detail/" . $slug,
                'changefreq' => "yearly",
                'priority' => 0.9,
            ]);

            session()->setFlashdata('pesan', 'Data Berhasil Diedit.');
            return redirect()->to(base_url() . '/admin_product');
        }
    }

    public function delete($id)
    {
        if (session('username') == null) {
            return view('admin/login');
        } else {
            // cari foto bedasar id
            $product = $this->productModel->find($id);

            // hapus file foto
            for ($i = 1; $i <= 5; $i++) {
                if ($product['foto' . $i] != 'default.jpg' && $product['foto' . $i] != '') {
                    try {
                        unlink('assets/img/product/' . $product['foto' . $i]);
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
                }
            }

            $this->productModel->delete($id);


            return redirect()->to(base_url() . '/admin_product');
        }
    }
}
