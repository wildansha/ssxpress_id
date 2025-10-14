<?php

namespace App\Models;

class AkunModel
{

    public function get_detail_akun($email)
    {
        $db = \Config\Database::connect();
        $email = $db->escape($email);
        $query = "SELECT * from akun where email=$email";
        return $db->query($query)->getRowArray();
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

    public function checkout($akun_id, $list_product_id)
    {
        $db = \Config\Database::connect();
        $akun_id;
        $builder = $db->table('jastip');
        $result_insert = $builder->insert([
            "akun_id" => $akun_id,
            "status" => 0,
        ]);
        $jastip_id = $db->insertID();

        $query = "INSERT into jastip_product (header_id,product_id ,harga ,qty )
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

        $result = $db->query($query);
        if ($db->error()["code"] == 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function list_history()
    {
        $db = \Config\Database::connect();

        $this->table('jastip')->orderBy('nama', 'asc');
    }
}
