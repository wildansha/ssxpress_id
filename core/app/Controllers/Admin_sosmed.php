<?php

namespace App\Controllers;

use App\Models\SosmedModel;

class Admin_sosmed extends BaseController
{
    protected $sosmedModel;

    public function __construct()
    {
        $this->sosmedModel = new SosmedModel();
    }

    public function index()
    {
        if (session('username') == null) {
            return view('admin/login');
        } else {
            $data = [
                'validation' => \config\Services::validation(),
                'sosmed' => $this->sosmedModel->get(),
            ];

            return view('admin_sosmed/index', $data);
        }
    }

    public function update($id)
    {
        if (session('username') == null) {
            return view('admin/login');
        } else {

            // validasi input
            if (!$this->validate([
                'whatsapp' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi',
                    ]
                ],
                'instagram' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi',
                    ]
                ],

                'email' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi',
                    ]
                ],

            ])) {
                return redirect()->to('/admin_sosmed/' . $this->request->getVar('id'))->withInput();
            }

            $this->sosmedModel->save([
                'id' => $id,
                'whatsapp' => $this->request->getVar('whatsapp'),
                'email' => $this->request->getVar('email'),
            ]);

            session()->setFlashdata('pesan', 'Data Berhasil Diedit.');
            return redirect()->to('/admin_sosmed');
        }
    }
}
