<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\HomeModel;

class Home extends BaseController
{
    public function __construct() {}


    private function cek_login_ajax()
    {
        if (session('email_akun') === null) {
            echo json_encode(["status" => "exp"]);
        }
    }
    private function cek_login()
    {
        if (session('email_akun') === null) {
            header("Location: " . base_url("akun/login"));
            exit;
        }
    }

    public function index()
    {
        $data = [];
        $homeModel = new HomeModel();
        $data["list_negara_cek_ongkir_ln"] = $homeModel->list_negara_cek_ongkir_ln();

        $data["list_kabupaten_agen"] = $homeModel->list_kabupaten_agen();
        return view('home/v_home', $data);
    }

    public function ajax_tracking()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(404);
        }

        $waktu_tracking_terakhir = session('waktu_tracking_terakhir');
        if ($waktu_tracking_terakhir != null && time() - $waktu_tracking_terakhir < 5) {
            return $this->response->setJSON([
                "status" => 0,
                "message" => "Tunggu 5 detik sebelum melakukan tracking kembali."
            ]);
        }

        $id_order = strtoupper(trim($this->request->getPost('id_order')));
        $last_phone_number = trim($this->request->getPost('last_phone_number'));
        $trace_id = preg_replace('/[^a-zA-Z0-9_-]/', '', (string) $this->request->getPost('trace_id'));
        if ($trace_id === '') {
            $trace_id = bin2hex(random_bytes(8));
        }

        $this->response->setHeader('X-Tracking-Trace-Id', $trace_id);

        if (!preg_match('/^(SSN[0-9]+|SSIN[0-9]+)$/', $id_order) || !preg_match('/^[0-9]{5}$/', $last_phone_number)) {
            return $this->response->setJSON([
                "status" => 0,
                "message" => "Nomor resi atau 5 digit terakhir no HP tidak valid."
            ]);
        }

        session()->set('waktu_tracking_terakhir', time());

        $url = "https://mitraekspedisi.com/order/api_cek_resi";
        $params["p5"] = (string) env('tracking.apiKey', '');
        $params["p3"] = $id_order;
        $params["p4"] = $last_phone_number;
        $data = $this->tracking_api($url, $params, $trace_id, $id_order);

        if (!is_array($data)) {
            $data = ["tracking_error" => "Tracking tidak dapat dimuat (ID: " . $trace_id . ")"];
        }

        return $this->response->setJSON([
            "status" => 1,
            "html" => view('home/v_hasil_tracking', $data)
        ]);
    }

    /**
     * Memanggil API tracking sekaligus menyimpan detail kegagalan ke writable/logs.
     */
    private function tracking_api($url, array $params, $trace_id, $id_order)
    {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($params),
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT => 30,
            // Pertahankan perilaku helper API lama; error TLS tetap tercatat oleh cURL.
            CURLOPT_SSL_VERIFYPEER => false,
        ]);

        $started_at = microtime(true);
        $raw_response = curl_exec($ch);
        $curl_errno = curl_errno($ch);
        $curl_error = curl_error($ch);
        $http_status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $content_type = (string) curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
        $duration_ms = (int) round((microtime(true) - $started_at) * 1000);
        curl_close($ch);

        $data = is_string($raw_response) ? json_decode($raw_response, true) : null;
        $json_error = json_last_error_msg();

        if ($curl_errno !== 0 || $http_status < 200 || $http_status >= 300 || !is_array($data)) {
            // Respons dibatasi agar file log tidak membengkak dan tidak menyimpan halaman penuh.
            $response_preview = is_string($raw_response)
                ? substr(preg_replace('/\s+/', ' ', $raw_response), 0, 500)
                : '';

            log_message('critical', 'TRACKING_API_FAILED {context}', [
                'context' => json_encode([
                    'trace_id' => $trace_id,
                    'id_order' => $id_order,
                    'http_status' => $http_status,
                    'curl_errno' => $curl_errno,
                    'curl_error' => $curl_error,
                    'json_error' => $json_error,
                    'content_type' => $content_type,
                    'duration_ms' => $duration_ms,
                    'response_preview' => $response_preview,
                ], JSON_UNESCAPED_SLASHES),
            ]);

            return null;
        }

        return $data;
    }

    /**
     * Menerima error transport dari browser dan menulisnya ke writable/logs.
     */
    public function ajax_tracking_client_log()
    {
        if (strtoupper($this->request->getMethod()) !== 'POST') {
            return $this->response->setStatusCode(405);
        }

        $trace_id = substr(preg_replace('/[^a-zA-Z0-9_-]/', '', (string) $this->request->getPost('trace_id')), 0, 64);
        $id_order = substr(strtoupper(trim((string) $this->request->getPost('id_order'))), 0, 30);
        $ajax_status = substr((string) $this->request->getPost('ajax_status'), 0, 50);
        $http_status = (int) $this->request->getPost('http_status');
        $error = substr((string) $this->request->getPost('error'), 0, 200);
        $response_preview = substr(preg_replace('/\s+/', ' ', (string) $this->request->getPost('response_preview')), 0, 500);

        log_message('critical', 'TRACKING_UI_FAILED {context}', [
            'context' => json_encode([
                'trace_id' => $trace_id,
                'id_order' => $id_order,
                'ajax_status' => $ajax_status,
                'http_status' => $http_status,
                'error' => $error,
                'response_preview' => $response_preview,
                'ip' => $this->request->getIPAddress(),
                'user_agent' => substr((string) $this->request->getUserAgent(), 0, 250),
            ], JSON_UNESCAPED_SLASHES),
        ]);

        return $this->response->setStatusCode(204);
    }

    public function ajax_list_kecamatan()
    {

        $url = "https://rajaongkir.komerce.id/api/v1/destination/domestic-destination?limit=100&search=" . rawurlencode($_POST["search"]);
        $key = "951566e0f3a1c31edf61914c32c4e01a";

        $response = $this->api($url, null, $key);


        echo json_encode($response);
    }

    public function ajax_list_agen()
    {

        $homeModel = new HomeModel();
        $list_agen = $homeModel->list_agen($_POST["kabupaten_agen"]);
        $data["data"] = [];
        for ($i = 0; $i < count($list_agen); $i++) {
            $list_agen[$i]["index"] = $i;
            $data["data"][$i]['item']  = view("home/v_item_agen", $list_agen[$i]);
        }


        echo json_encode($data);
    }

    public function ajax_list_ongkir_dn()
    {
        $volume = $_POST["panjang"] * $_POST["lebar"] * $_POST["tinggi"];
        $berat = $_POST["berat"];
        if ($volume / 6000 > $_POST["berat"]) {
            $berat = $volume / 6000;
        }
        $berat = ceil($berat);

        $origin = explode("|", $_POST["origin"]);
        $id_origin = $origin[0];
        $district_origin = $origin[1];
        $city_origin = $origin[2];
        $province_origin = $origin[3];

        $destination = explode("|", $_POST["destination"]);
        $id_destination = $destination[0];
        $district_destination = $destination[1];
        $city_destination = $destination[2];
        $province_destination = $destination[3];

        $url = "https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost";
        $key = "951566e0f3a1c31edf61914c32c4e01a";
        $params["origin"] = $id_origin;
        $params["destination"] = $id_destination;
        $params["weight"] = $berat;
        $params["courier"] = "jne:jnt";

        $response = $this->api($url, $params, $key);



        if (isset($response["data"])) {
            foreach ($response["data"] as $key => $pengiriman) {
                $kode_ekspedisi = strtoupper(trim((string) $pengiriman["code"]));
                $service_ekspedisi = strtoupper(trim((string) $pengiriman["service"]));

                if ($kode_ekspedisi == "JNE" && $service_ekspedisi != "REG") {
                    unset($response["data"][$key]);
                }
            }
            $response["data"] = array_values($response["data"]);

            $data["status"] = 1;
            $data["list_ongkir_dn"] = view('home/v_item_list_ongkir_dn', [
                "list_ongkir_dn" => $response["data"],
                "city_origin" => $city_origin,
                "province_origin" => $province_origin,
                "city_destination" => $city_destination,
                "province_destination" => $province_destination,
                "berat" => $berat
            ]);
        } else {
            $data["status"] = 0;
            $data["list_ongkir_dn"] = [];
        }



        echo json_encode($data);
    }

    public function ajax_list_ongkir_ln()
    {
        $homeModel = new HomeModel();
        $result = $homeModel->detail_ongkir_ln($_POST["negara_ongkirln"])["text_ongkir"];


        echo json_encode($result);
    }


    public function kontak_kami()
    {
        $data = [];
        return view('home/v_kontak_kami', $data);
    }

    public function profil_perusahaan()
    {
        $data = [];
        return view('home/v_profil_perusahaan', $data);
    }

    public function layanan()
    {
        $data = [];
        return view('home/v_layanan', $data);
    }
}
