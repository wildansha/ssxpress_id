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
        $this->cek_login_ajax();

        $adminModel = new AdminModel();
        $data["data"] = $adminModel->list_product($_POST["kategori"]);


        echo json_encode($data);
    }



    public function ajax_insert_product()
    {
        $this->cek_login_ajax();

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
                    'required' => 'Nama Product harus diisi',
                    'is_unique' => 'Pilih Nama lain, Nama Tersebut sudah ada'
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
            $errors = $this->validator->getErrors();
            echo json_encode(["status" => 0, "msg" => $errors]);
            exit;
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

        $slug = url_title($this->request->getPost('nama'), '-', true);
        $productModel = new ProductModel();
        $productModel->save([
            'nama' => $this->request->getPost('nama'),
            'slug' => $slug,
            'kategori' => $this->request->getPost('kategori'),
            'kategori' => $this->request->getPost('kategori'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'harga' => preg_replace('/[^0-9]/', '', $this->request->getPost('harga')),
            'foto1' => $namaFoto[0],
            'foto2' => $namaFoto[1],
            'foto3' => $namaFoto[2],
            'foto4' => $namaFoto[3],
            'foto5' => $namaFoto[4],

        ]);

        echo json_encode(["status" => 1, "msg" => "Berhasil"]);
    }

    public function ajax_update_product()
    {
        $this->cek_login_ajax();


        // CEK NAMA
        $productModel = new ProductModel();
        $productLama = $productModel->find($this->request->getPost('id'));
        if ($productLama['nama'] == $this->request->getPost('nama')) {
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
            $errors = $this->validator->getErrors();
            echo json_encode(["status" => 0, "msg" => $errors]);
            exit;
        }


        //ambil foto
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
                $namaFoto[$i] = $this->request->getPost("foto" . $j . "Lama");

                //menghapus foto apabila terdeteksi menekan tombol hapus foto
                if ($this->request->getPost('foto' . $j . 'Lama') != 'default.jpg' && $this->request->getPost('foto' . $j . 'Lama') != '') {
                    if ($this->request->getPost('hapusFoto' . $j) == 'y') {
                        $namaFoto[$i] = "";
                        try {
                            unlink('assets/img/product/' . $this->request->getPost('foto' . $j . 'Lama'));
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

        $slug = url_title($this->request->getPost('nama'), '-', true);
        $productModel->save([
            'id' => $_POST["id"],
            'nama' => $this->request->getPost('nama'),
            'slug' => $slug,
            'kategori' => $this->request->getPost('kategori'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'harga' => preg_replace('/[^0-9]/', '', $this->request->getPost('harga')),
            'berat' => $this->request->getPost('berat'),
            'foto1' => $namaFoto[0],
            'foto2' => $namaFoto[1],
            'foto3' => $namaFoto[2],
            'foto4' => $namaFoto[3],
            'foto5' => $namaFoto[4],
        ]);

        echo json_encode(["status" => 1, "msg" => "Berhasil"]);
    }

    public function detail_product($product_id)
    {
        $this->cek_login();
        $kategoriModel = new KategoriModel();
        $adminModel = new AdminModel();
        $detail["product"] = $adminModel->detail_product($product_id);
        $detail['kategori_all'] = $kategoriModel->get();

        // dd($detail);
        return view('admin/v_admin_detail_product', $detail);
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
