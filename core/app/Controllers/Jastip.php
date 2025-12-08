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


    private function cek_login()
    {
        if (session('akun_id') === null) {
            header("Location: " . base_url("akun/login"));
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

        $code_ekspedisi = explode("~", $_POST["ekspedisi"])[0];
        $service_ekspedisi = explode("~", $_POST["ekspedisi"])[1];

        $akunModel = new AkunModel();
        $list_ekspedisi = $this->cek_ongkir_dn(explode("_", $_POST["alamat"])[1], 1);
        $ongkir = 0;

        if (isset($list_ekspedisi)) {
            for ($i = 0; $i < count($list_ekspedisi); $i++) {
                if (strtolower($list_ekspedisi[$i]["code"]) == strtolower($code_ekspedisi) && strtolower($list_ekspedisi[$i]["service"]) == strtolower($service_ekspedisi)) {
                    $ongkir = $list_ekspedisi[$i]["cost"];
                }
            }
        }

        $detail_alamat =  $akunModel->detail_alamat_dn(session("akun_id"), explode("_", $_POST["alamat"])[1]);


        $data["jastip_id"] =  $akunModel->checkout(session("akun_id"), $_POST["cb"], $ongkir, $detail_alamat);
        $data["status"] = 1;
        echo json_encode($data);
    }


    public function ajax_alamat()
    {
        $this->cek_login_ajax();

        $akunModel = new AkunModel();
        $data["status"] = 1;
        $list_alamat_dn =  $akunModel->list_alamat_dn_singkat(session("akun_id"));
        $list_alamat_ln =  $akunModel->list_alamat_ln_singkat(session("akun_id"));

        $data["alamat_dn"] = [];
        for ($i = 0; $i < count($list_alamat_dn); $i++) {
            $data["alamat_dn"][] = view('jastip/v_item_pilih_alamat_dn',  $list_alamat_dn[$i]);
        }

        $data["alamat_ln"] = [];
        for ($i = 0; $i < count($list_alamat_ln); $i++) {
            $data["alamat_ln"][] = view('jastip/v_item_pilih_alamat_ln',  $list_alamat_ln[$i]);
        }

        echo json_encode($data);
    }
    public function keranjang()
    {
        $this->cek_login();
        $akunModel = new AkunModel();
        $data["list_negara"] =  $akunModel->list_negara_ln(session("akun_id"));

        $list_alamat_dn =  $akunModel->list_alamat_dn_singkat(session("akun_id"));
        $list_alamat_ln =  $akunModel->list_alamat_ln_singkat(session("akun_id"));
        $data["alamat_dn"] = [];
        for ($i = 0; $i < count($list_alamat_dn); $i++) {
            $data["alamat_dn"][] = view('jastip/v_item_pilih_alamat_dn',  $list_alamat_dn[$i]);
        }
        $data["alamat_ln"] = [];
        for ($i = 0; $i < count($list_alamat_ln); $i++) {
            $data["alamat_ln"][] = view('jastip/v_item_pilih_alamat_ln',  $list_alamat_ln[$i]);
        }
        return view('jastip/v_keranjang', $data);
    }

    public function ajax_list_keranjang()
    {
        $this->cek_login_ajax();
        $akunModel = new AkunModel();

        $data["status"] = 1;
        $data["data"] =  $akunModel->list_product_keranjang(session("akun_id"));

        echo json_encode($data);
    }


    public function ajax_ekspedisi()
    {
        $this->cek_login_ajax();
        $akunModel = new AkunModel();

        $arr_alamat = explode("_", $_POST["alamat"]);
        $detail_alamat =  $akunModel->detail_alamat_dn(session("akun_id"), $arr_alamat[1]);

        $data["status"] = 1;
        if ($arr_alamat[0] == "dn") {
            // $volume = $_POST["panjang"] * $_POST["lebar"] * $_POST["tinggi"];
            // $berat = $_POST["berat"];
            $volume = 1;
            $berat = 1;
            if ($volume / 6000 > $berat) {
                $berat = $volume / 6000;
            }
            $berat = ceil($berat);

            $list_ekspedisi = $this->cek_ongkir_dn($arr_alamat[1], $berat);

            if (isset($list_ekspedisi)) {
                $city_origin = "INDRAMAYU";
                $province_origin = "JAWA BARAT";
                $city_destination = $detail_alamat["kabupaten"];
                $province_destination = $detail_alamat["provinsi"];

                $data["list_ekspedisi"]  = view('jastip/v_item_list_ekspedisi_dn', [
                    "list_ekspedisi" =>  $list_ekspedisi,
                    "city_origin" => $city_origin,
                    "province_origin" => $province_origin,
                    "city_destination" => $city_destination,
                    "province_destination" => $province_destination,
                    "berat" => $berat
                ]);
            } else {
                $data["list_ekspedisi"]  = [];
            }
        }
        echo json_encode($data);
    }

    public function cek_ongkir_dn($alamat_id, $berat)
    {
        $akunModel = new AkunModel();
        $detail_alamat =  $akunModel->detail_alamat_dn(session("akun_id"), $alamat_id);

        // 1193 = Kec.indramayu Kab. Indramayu
        $id_origin = 1193;
        $id_destination = $detail_alamat["kecamatan_id"];


        $url = "https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost";
        $key = "951566e0f3a1c31edf61914c32c4e01a";
        $params["origin"] = $id_origin;
        $params["destination"] = $id_destination;
        $params["weight"] = $berat;
        $params["courier"] = "jne:jnt";

        $response = $this->api($url, $params, $key);
        if (isset($response["data"])) {
            return $response["data"];
        } else {
            return [];
        }
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
    public function ajax_delete_keranjang()
    {
        $this->cek_login_ajax();
        $akunModel = new AkunModel();

        $data["list_product_keranjang"] =  $akunModel->delete_keranjang(session("akun_id"), $_POST["product_id"]);
        $data["status"] = 1;
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
