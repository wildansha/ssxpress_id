<?php

namespace App\Controllers;


use App\Models\ProductModel;
use App\Models\KategoriModel;
use App\Models\AkunModel;



class Jastip extends BaseController
{
    public function __construct()
    {
        $this->productModel = new ProductModel();

        $kategoriModel = new KategoriModel();
        $this->kategori_all =  $kategoriModel->get();
    }

    private function api($url, $params = null, $key = '', $want_decode = true, $want_array = true)
    {

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        if ($key != '') {
            curl_setopt($ch, CURLOPT_HTTPHEADER, ["key: $key"]);
        }

        if (isset($params)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


        if ($want_decode) {
            $data = json_decode(curl_exec($ch), $want_array);
        } else {
            $data = curl_exec($ch);
        }

        curl_close($ch);

        return $data;
    }


    private function cek_login()
    {
        if (session('akun_id') === null) {
            header("Location: " . base_url("account/login"));
            exit;
        }
    }
    private function cek_login_ajax()
    {
        if (session('akun_id') === null) {
            echo json_encode(["status" => "exp"]);
            exit;
        }
    }
 
    public function index()
    {
        header("Location: " . base_url("jastip/product"));
        exit;
    }
    public function product($kategori = null)
    {

        $dataPerPage = 12;
        $currentPage = $this->request->getGet('page_product') ? $this->request->getGet('page_product') : 1;

        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $product = $this->productModel->search($keyword, $kategori);
        } else {
            $product = $this->productModel->get();
        }

        $data = [
            'keyword' => $keyword,
            'kategori' => $kategori,
            'kategori_all' => $this->kategori_all,
            'dataPerPage' => $dataPerPage,
            'product' => $product->paginate($dataPerPage, 'product'),
            'pager' => $product->pager,
            'currentPage' => $currentPage,
            'urlFoto' => base_url() . '/assets/img/product/'
        ];


        return view('product/kategori', $data);
    }

    public function kategori($kategori)
    {

        $dataPerPage = 12;
        $currentPage = $this->request->getVar('page_product') ? $this->request->getVar('page_product') : 1;

        $keyword = $this->request->getVar('keyword');

        if ($kategori == "Semua Kategori") {
            $product = $this->productModel->get();
        } else {
            $product = $this->productModel->search($keyword, $kategori);
        }
        $data = [
            'urlFoto' => base_url() . '/assets/img/product/',
            'keyword' => $keyword,
            'kategori' => $kategori,
            'kategori_all' => $this->kategori_all,
            'dataPerPage' => $dataPerPage,
            'product' => $product->paginate($dataPerPage, 'product'),
            'pager' => $product->pager,
            'currentPage' => $currentPage,
        ];


        return view('product/kategori', $data);
    }

    public function detail($slug)
    {
        $data = [
            'urlFoto' => base_url() . '/assets/img/product/',
            'product' => $this->productModel->get($slug)
        ];

        // jika data tidak ada
        if (empty($data['product'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Nama product ' . $slug . ' tidak ada');
        }
        return view('product/detail', $data);
    }

    public function ajax_add_keranjang()
    {
        $this->cek_login_ajax();
        $akunModel = new AkunModel();

        // Cek jumlah keranjang
        $jml_keranjang =  $akunModel->jml_keranjang(session("akun_id"));
        if ($jml_keranjang > 50) {
            $data["status"] = 0;
            $data["msg"] = "Jumlah Barang di Keranjang Anda Sudah Maksimal, Hapus Sebagian Untuk Menambahkan Barang Lainnya";
            echo json_encode($data);
            exit;
        }

        // Cek apakah product sudah ada di keranjang atau belum
        $is_di_keranjang =  $akunModel->is_di_keranjang(session("akun_id"), $_POST["product_id"]);
        if ($is_di_keranjang == 1) {
            $data["status"] = 0;
            $data["msg"] = "Anda Telah Memiliki Barang  Ini di Keranjang Belanja";
            echo json_encode($data);
            exit;
        }


        $data["list_product_keranjang"] =  $akunModel->insert_keranjang(session("akun_id"), $_POST["product_id"]);
        $data["status"] = 1;
        echo json_encode($data);
    }

    public function checkout()
    {
        $this->cek_login_ajax();


        if (empty($_POST["cb"])) {
            echo json_encode(["status" => 0, "msg" => "Anda belum memilih produk untuk dicheckout"]);
            exit;
        }

        // echo json_encode( $_POST["cb"]);exit;

        $akunModel = new AkunModel();

        $data["jastip_id"] =  $akunModel->checkout(session("akun_id"), $_POST["cb"]);
        $data["status"] = 1;
        echo json_encode($data);
    }

    public function ajax_delete_keranjang()
    {
        $this->cek_login_ajax();
        $akunModel = new AkunModel();

        $data["list_product_keranjang"] =  $akunModel->delete_keranjang(session("akun_id"), $_POST["product_id"]);
        $data["status"] = 1;
        echo json_encode($data);
    }
    public function history()
    {
        $this->cek_login();
        $akunModel = new AkunModel();
        $data["list_status"] =  $akunModel->jastip_status();

        return view('jastip/v_history', $data);
    }
    public function ajax_data_history()
    {
        $this->cek_login_ajax();
        $akunModel = new AkunModel();
        $list_jastip =  $akunModel->list_history(session("akun_id"), $_POST["status_id"]);
        $data["data"] = [];
        for ($i = 0; $i < count($list_jastip); $i++) {
            $list_jastip[$i]["index"] = $i;
            $data["data"][$i]['item']  = view("jastip/v_item_history_jastip", $list_jastip[$i]);
        }
        echo json_encode($data);
    }

    public function detail_jastip($jastip_id)
    {
        $this->cek_login();
        $akunModel = new AkunModel();
        $status_kepemilikan = $akunModel->cek_kepemilikan_jastip(session("akun_id"), $jastip_id);
        if ($status_kepemilikan == 0) {
            return view('v_tidak_berhak');
        } else {
            $data["jastip"] = $akunModel->detail_jastip(session("akun_id"), $jastip_id);

            $url = "https://mitraekspedisi.com/order/api_cek_resi";
            $params["p1"] = "wildanshalahuddin@gmail.com";
            $params["p2"] = "w";
            $params["p3"] = isset($data["jastip"]["resi_ssxpress"]) ? $data["jastip"]["resi_ssxpress"] : "";
            // $params["p3"] = "SSIN10653";
            $data_track = $this->api($url, $params);
            $data = array_merge($data, $data_track);

            return view('jastip/v_detail_jastip', $data);
        }
    }
}
