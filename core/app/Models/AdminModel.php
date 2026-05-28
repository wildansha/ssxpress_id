<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table      = 'admin';
    protected $primaryKey = 'id';

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;


    // protected $useTimestamps = true;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function getAdmin($username)
    {
        return $this->where(['username' => $username])->first();
    }
    public function list_product($kategori)
    {
        $db = \Config\Database::connect();

        $where_clause = "";
        if ($kategori != "") {
            $where_clause = " WHERE kategori =" . $db->escape($kategori);
        }
        $query = "SELECT *
        from product 
        $where_clause
        order by nama
        ";
        $result = $db->query($query)->getResultArray();
        return $result;
    }
    public function detail_product($product_id)
    {
        $db = \Config\Database::connect();
        $product_id = $db->escape($product_id);

        $query = "SELECT *
        from product 
        where id=$product_id
        ";
        $result = $db->query($query)->getRowArray();
        return $result;
    }

    public function list_jastip($status_id)
    {
        $db = \Config\Database::connect();
        $status_id = $db->escape($status_id);

        $query = "SELECT count(jp.product_id)-1 as jml_other,jp.harga, j.id as jastip_id, p.nama as product_name ,p.foto1 , DATE_FORMAT(j.created_at,'%d-%m-%Y %H:%i:%s') as waktu_pesan,
        a.email as email_pemesan
        from jastip j 
        join jastip_product jp on jp.jastip_id = j.id
        join akun a on a.id = j.akun_id
        join  product p on p.id = jp.product_id
        where j.status = $status_id
        group by j.id
        order by j.id asc
        ";
        $arr_history = $db->query($query)->getResultArray();
        return $arr_history;
    }

    public function detail_jastip($jastip_id)
    {
        $db = \Config\Database::connect();
        $jastip_id = $db->escape($jastip_id);

        $query = "SELECT j.* , js.status_name, a.email,a.nama,coalesce(a.nomor,'') as nomor
        from jastip j
        join jastip_status js on js.id = j.status
        join akun a on a.id = j.akun_id
        where j.id = $jastip_id ";
        $jastip = $db->query($query)->getRowArray();

        // dd($jastip);
        $query_produk = "SELECT jp.harga,jp.qty, p.nama as product_name, p.slug ,p.foto1
        from jastip_product jp
        join product p on p.id = jp.product_id
        where jp.jastip_id = $jastip_id ";
        $jastip["list_product"] = $db->query($query_produk)->getResultArray();

        return $jastip;
    }
    public function proses_jastip($jastip_id, $bukti_bayar_name)
    {
        $db = \Config\Database::connect();
        $jastip_id = $db->escape($jastip_id);

        $query = "UPDATE jastip set bukti_bayar='$bukti_bayar_name' ,status=1 where id=$jastip_id ";
        $result = $db->query($query);

        return $result;
    }
    public function alasan_tolak()
    {
        $db = \Config\Database::connect();

        $query = "SELECT *
        from jastip_alasan_tolak ";
        $alasan_tolak = $db->query($query)->getResultArray();

        return $alasan_tolak;
    }

    public function tolak_jastip($jastip_id, $alasan_tolak_id, $keterangan)
    {
        $db = \Config\Database::connect();
        $this->db->transStart();

        $jastip_id = $db->escape($jastip_id);
        $alasan_tolak_id = $db->escape($alasan_tolak_id);
        $keterangan = $db->escape($keterangan);

        $query = "UPDATE jastip set status=4 where id=$jastip_id ";
        $db->query($query);

        $query = "INSERT INTO jastip_log_tolak (jastip_id,alasan_tolak_id,keterangan) VALUES ($jastip_id,$alasan_tolak_id,$keterangan) ";
        $db->query($query);


        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            return ["status" => 0];
        } else {
            return ["status" => 1];
        }
    }


    public function input_resi($jastip_id, $resi)
    {
        $db = \Config\Database::connect();
        $jastip_id = $db->escape($jastip_id);

        $query = "UPDATE jastip set resi_ssxpress='$resi' ,status=1 where id=$jastip_id ";
        $result = $db->query($query);

        return $result;
    }


    public function list_agen()
    {
        $db = \Config\Database::connect();

        $query = "SELECT a.*, mk.kabupaten,mk.jenis, mp.provinsi
        from agen a
        join master_kabupaten mk on mk.id = a.kabupaten_id
        join master_provinsi mp on mp.id = mk.id_provinsi
        order by mp.provinsi, mk.kabupaten, a.nama
        ";
        $arr_agen = $db->query($query)->getResultArray();
        return $arr_agen;
    }

    public function detail_agen($id_agen)
    {
        $db = \Config\Database::connect();
        $id_agen = $db->escape($id_agen);

        $query = "  SELECT a.*, mk.kabupaten,mk.jenis, mp.provinsi
        from agen a
        join master_kabupaten mk on mk.id = a.kabupaten_id
        join master_provinsi mp on mp.id = mk.id_provinsi
        WHERE a.id = $id_agen
        ";
        $agen = $db->query($query)->getRowArray();
        return $agen;
    }

    public function insert_agen($params)
    {
        $db = \Config\Database::connect();

        $nama = isset($params["nama"]) ? $db->escape($params["nama"]) : "''";
        $kabupaten_id = isset($params["kabupaten_id"]) ? $db->escape($params["kabupaten_id"]) : "''";
        $alamat = isset($params["alamat"]) ? $db->escape($params["alamat"]) : "''";
        $link_gmaps = isset($params["link_gmaps"]) ? $db->escape($params["link_gmaps"]) : "''";


        $query = "INSERT into agen (nama, kabupaten_id, alamat, link_gmaps) VALUES ($nama, $kabupaten_id, $alamat, $link_gmaps) ";
        $result = $db->query($query);
        if ($result) {
            return ["status" => 1, "msg" => "Berhasil"];
        } else {
            return ["status" => 0, " msg" => $db->error()];
        }
    }
    public function update_agen($params)
    {
        $db = \Config\Database::connect();

        $id = isset($params["id"]) ? $db->escape($params["id"]) : "''";
        $nama = isset($params["nama"]) ? $db->escape($params["nama"]) : "''";
        $kabupaten_id = isset($params["kabupaten_id"]) ? $db->escape($params["kabupaten_id"]) : "''";
        $alamat = isset($params["alamat"]) ? $db->escape($params["alamat"]) : "''";
        $link_gmaps = isset($params["link_gmaps"]) ? $db->escape($params["link_gmaps"]) : "''";


        $query = "UPDATE agen set nama=$nama, kabupaten_id=$kabupaten_id, alamat=$alamat, link_gmaps=$link_gmaps where id=$id ";
        $result = $db->query($query);
        if ($result) {
            return ["status" => 1, "msg" => "Berhasil"];
        } else {
            return ["status" => 0, " msg" => $db->error()];
        }
    }
    public function delete_agen($agen_id)
    {
        $db = \Config\Database::connect();
        $agen_id = $db->escape($agen_id);

        $query = "DELETE FROM agen WHERE id=$agen_id ";
        $result = $db->query($query);
        if ($result) {
            return ["status" => 1, "msg" => "Berhasil"];
        } else {
            return ["status" => 0, " msg" => $db->error()];
        }
    }

    public function list_kabupaten()
    {
        $db = \Config\Database::connect();

        $query = "SELECT mk.* , mp.provinsi 
        from master_kabupaten mk
        join master_provinsi mp on mp.id=mk.id_provinsi
        order by mp.provinsi , mk.kabupaten";
        return $db->query($query)->getResultArray();
    }
}
