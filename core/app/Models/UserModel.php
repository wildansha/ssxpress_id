<?php

namespace App\Models;

class UserModel
{
    
    public function get_list_order($start, $length, &$iTotalRecords, $keyword)
    {
        $db = \Config\Database::connect();

        $builder = $db->table('order_dn')->select("id,email,resi");
        if ($keyword != "" && $keyword !== null) {
            $builder = $builder->where("email", $keyword)->orWhere("id", $keyword)->orWhere("resi", $keyword);
        }
        $builder = $builder->orderBy("id", "desc");

        $iTotalRecords = $builder->countAllResults(false);;

        $builder = $builder->limit($length, $start)->get();

        return $builder->getResultArray();
    }
    public function get_detail($id)
    {
        $db = \Config\Database::connect();

        $query = "SELECT o.*, m.nama
        FROM order_dn o
        join mitra m on o.email=m.email
        where o.id ='$id'  ";
        return $db->query($query)->getRowArray();
    }


    public function list_ekspedisi()
    {
        $db = \Config\Database::connect();

        $query = "SELECT DISTINCT(UPPER(ekspedisi)) as ekspedisi FROM `order_dn` ORDER by ekspedisi;";
        return $db->query($query)->getResultArray();
    }
    public function list_kurir()
    {
        $db = \Config\Database::connect();

        $query = "SELECT *
        FROM admin
        where tipe = 2
        order by id  ";
        return $db->query($query)->getResultArray();
    }
    public function get_detail_ln($id)
    {
        $db = \Config\Database::connect();
        $builder = $db
            ->table('order_ln')
            ->where('id', $id)
            ->get();
        return $builder->getRowArray();
    }
    public function insert()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('order_dn');
        return $builder->get();
    }
    public function update($id, $data)
    {
        $db = \Config\Database::connect();
        $result = $db->table('order_dn')
            ->set($data)
            ->where('id', $id)
            ->update();
        return $result;
    }

    public function cek_pvg($id_order, $id_akun, $tipe_akun)
    {
        $db = \Config\Database::connect();

        if ($tipe_akun == 1) {
            return true;
        } else if ($tipe_akun == 2) {
            $query = "SELECT count(id)  as count
            FROM order_dn
            where id= $id_order
            and kurir_id = $id_akun
            LIMIT 1  ";
            $count_result = $db->query($query)->getRowArray()["count"];
            if ($count_result > 0) {
                return true;
            } else {
                return false;
            }
        }
    }
}
