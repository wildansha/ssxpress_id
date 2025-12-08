<?php

namespace App\Models;

class AkunModel
{
    public function list_negara_ln()
    {
        $db = \Config\Database::connect();
        $query = "SELECT * from negara_ln order by negara";
        return $db->query($query)->getResultArray();
    }

    public function get_detail_akun($email)
    {
        $db = \Config\Database::connect();
        $email = $db->escape($email);
        $query = "SELECT * from akun where email=$email";
        return $db->query($query)->getRowArray();
    }
    public function get_detail_akun_by_id($id)
    {
        $db = \Config\Database::connect();
        $id = $db->escape($id);

        $query = "SELECT * from akun where id=$id";
        $detail = $db->query($query)->getRowArray();


        return $detail;
    }

    public function insert_akun($email, $password)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('akun');
        $result_insert = $builder->insert([
            "email" => $email,
            "password" => $password,
        ]);

        if ($db->error()["code"] == 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function insert_keranjang($akun_id, $product_id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('keranjang');
        $result_insert = $builder->insert([
            "akun_id" => $akun_id,
            "product_id" => $product_id,
        ]);

        if ($db->error()["code"] == 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function is_di_keranjang($akun_id, $product_id)
    {
        $db = \Config\Database::connect();
        $product_id = $db->escape($product_id);
        $query = "SELECT count(id) as jml from keranjang where akun_id = $akun_id AND product_id=$product_id limit 1";
        $jml_result = $db->query($query)->getRowArray()["jml"];
        return $jml_result;
    }
    public function list_product_keranjang($akun_id)
    {
        $db = \Config\Database::connect();
        $query = "SELECT p.*, k.qty
        from keranjang k
        join product p on p.id = k.product_id
        where k.akun_id = $akun_id
        ORDER by k.id desc";
        $result = $db->query($query)->getResultArray();
        return $result;
    }
    public function jml_keranjang($akun_id)
    {
        $db = \Config\Database::connect();
        $query = "SELECT count(k.id) as jml
        from keranjang k
        where k.akun_id = $akun_id";
        $result = $db->query($query)->getRowArray()["jml"];
        return $result;
    }

    public function delete_keranjang($akun_id, $product_id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('keranjang');
        $result_delete = $builder->delete([
            "akun_id" => $akun_id,
            "product_id" => $product_id,
        ]);

        if ($db->error()["code"] == 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function checkout($akun_id, $list_product_id, $ongkir, $detail_alamat)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('jastip');
        $result_insert = $builder->insert([
            "akun_id" => $akun_id,
            "ongkir" => $ongkir,
            "provinsi_id" => $detail_alamat["provinsi_id"],
            "provinsi" => $detail_alamat["provinsi"],
            "kabupaten" => $detail_alamat["kabupaten"],
            "kecamatan" => $detail_alamat["kecamatan"],
            "kabupaten_id" => $detail_alamat["kabupaten_id"],
            "kecamatan_id" => $detail_alamat["kecamatan_id"],
            "nama_penerima" => $detail_alamat["nama_penerima"],
            "telp_penerima" => $detail_alamat["telp_penerima"],
            "alamat_penerima" => $detail_alamat["alamat_penerima"],
            "status" => 0,
        ]);
        $jastip_id = $db->insertID();

        $query = "INSERT into jastip_product (jastip_id,product_id ,harga ,qty )
                    SELECT $jastip_id, p.id,p.harga, k.qty
                    FROM keranjang k
                    join product p on p.id=k.product_id 
                    WHERE k.akun_id = $akun_id";

        $jml_product = count($list_product_id);
        if ($jml_product > 0) {
            $query .= " AND p.id in ( ";
            for ($i = 0; $i < $jml_product; $i++) {
                $query .= $db->escape($list_product_id[$i]);
                if ($i < $jml_product - 1) {
                    $query .= ",";
                }
            }
            $query .= " ) ";
        }
        $db->query($query);

        // ===========================================================================================

        $query_delete = "DELETE FROM keranjang WHERE akun_id = $akun_id ";
        if ($jml_product > 0) {
            $query_delete .= " AND product_id in ( ";
            for ($i = 0; $i < $jml_product; $i++) {
                $query_delete .= $db->escape($list_product_id[$i]);
                if ($i < $jml_product - 1) {
                    $query_delete .= ",";
                }
            }
            $query_delete .= " ) ";
        }
        $db->query($query_delete);


        if ($db->error()["code"] == 0) {
            return $jastip_id;
        } else {
            return 0;
        }
    }

    public function jastip_status()
    {
        $db = \Config\Database::connect();

        $query = "SELECT *  from jastip_status";
        $jastip_statuses = $db->query($query)->getResultArray();
        return $jastip_statuses;
    }

    public function list_history($akun_id, $status_id)
    {
        $db = \Config\Database::connect();
        $status_id = $db->escape($status_id);


        $query = "SELECT count(jp.product_id)-1 as jml_other,jp.harga, j.id as jastip_id,j.status, p.nama as product_name ,p.foto1 , DATE_FORMAT(j.created_at,'%d-%m-%Y %H:%i:%s') as waktu_pesan
        from jastip j 
        join jastip_product jp on jp.jastip_id = j.id
        join  product p on p.id = jp.product_id
        where j.akun_id = $akun_id
        and j.status = $status_id
        group by j.id
        ";
        $arr_history = $db->query($query)->getResultArray();
        return $arr_history;
    }


    public function cek_kepemilikan_jastip($akun_id, $jastip_id)
    {
        $db = \Config\Database::connect();

        $query = "SELECT count(j.id) as jml
        from jastip j 
        where  j.id = $jastip_id
        and j.akun_id = $akun_id
        limit 1";
        $status_kepemilikan = $db->query($query)->getRowArray()["jml"];

        return $status_kepemilikan;
    }

    public function detail_jastip($akun_id, $jastip_id)
    {
        $db = \Config\Database::connect();

        $query = "SELECT j.*, 
        js.status_name,
        DATE_FORMAT(j.created_at,'%d-%m-%Y') as waktu_pesan
        from jastip j
        join jastip_status js on js.id=j.status 
        where j.id = $jastip_id
        and j.akun_id = $akun_id
        limit 1
        ";
        $jastip = $db->query($query)->getRowArray();

        $jastip["list_product"] = [];
        $query2 = "SELECT jp.*, p.nama as product_name, p.id as product_id, p.slug, p.foto1
                    from jastip_product jp
                    join product p on p.id = jp.product_id
                    where jp.jastip_id = $jastip_id
                    ";

        $jastip["list_product"] = $db->query($query2)->getResultArray();

        return $jastip;
    }


    public function list_alamat_dn($akun_id)
    {
        $db = \Config\Database::connect();
        $query = "SELECT a.*
                    from alamat_dn a
                    where a.akun_id = $akun_id
                    order by id desc
                    ";
        return $db->query($query)->getResultArray();
    }

    public function list_alamat_dn_singkat($akun_id)
    {
        $db = \Config\Database::connect();
        $query = "SELECT a.id, a.provinsi, a.kabupaten, a.kecamatan, a.alamat, a.nama_penerima, a.telp_penerima
                    from alamat_dn a
                    where a.akun_id = $akun_id
                    order by id desc
                    ";
        return $db->query($query)->getResultArray();
    }
    public function list_alamat_ln_singkat($akun_id)
    {
        $db = \Config\Database::connect();
        $query = "SELECT a.id, nl.negara, a.alamat, a.nama_penerima, a.telp_penerima
                    from alamat_ln a
                    join negara_ln nl on nl.id=a.id_negara
                    where a.akun_id = $akun_id
                    order by id desc
                    ";
        return $db->query($query)->getResultArray();
    }


    public function detail_alamat_dn($akun_id, $alamat_id)
    {
        $db = \Config\Database::connect();
        $alamat_id = $db->escape($alamat_id);

        $query = "SELECT a.*
                    from alamat_dn a
                    where a.id = $alamat_id
                    and a.akun_id = $akun_id
                    ";
        return $db->query($query)->getRowArray();
    }
    public function detail_alamat_ln($akun_id, $alamat_id)
    {
        $db = \Config\Database::connect();
        $alamat_id = $db->escape($alamat_id);

        $query = "SELECT a.*
                    from alamat_ln a
                    where a.id = $alamat_id
                    and a.akun_id = $akun_id
                    ";
        return $db->query($query)->getRowArray();
    }
    public function list_alamat_ln($akun_id)
    {
        $db = \Config\Database::connect();
        $query = "SELECT a.* , n.negara
                    from alamat_ln a
                    join negara_ln n on n.id = a.id_negara
                    where a.akun_id = $akun_id
                    order by id desc
                    ";
        return $db->query($query)->getResultArray();
    }
    public function simpan_alamat_dn($params)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('alamat_dn');
        $result_insert = $builder->insert($params);
        return $result_insert;
    }
    public function simpan_alamat_ln($params)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('alamat_ln');
        $result_insert = $builder->insert($params);
        return $result_insert;
    }

    public function delete_alamat_dn($alamat_dn_id, $akun_id)
    {
        $db = \Config\Database::connect();
        $alamat_dn_id = $db->escape($alamat_dn_id);

        $query = "DELETE FROM alamat_dn where id=$alamat_dn_id and akun_id=$akun_id ";
        return $db->query($query);
    }

    public function delete_alamat_ln($alamat_ln_id, $akun_id)
    {
        $db = \Config\Database::connect();
        $alamat_ln_id = $db->escape($alamat_ln_id);

        $query = "DELETE FROM alamat_ln where id=$alamat_ln_id and akun_id=$akun_id ";
        return $db->query($query);
    }
}
