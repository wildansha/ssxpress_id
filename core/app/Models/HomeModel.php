<?php

namespace App\Models;

class HomeModel
{


    public function list_negara_cek_ongkir_ln()
    {
        $db = \Config\Database::connect('mitraekspedisi');
        $query = "SELECT id,negara from ongkir_ln order by negara asc";
        return $db->query($query)->getResultArray();
    }
    public function detail_ongkir_ln($id)
    {
        $db = \Config\Database::connect('mitraekspedisi');
        $id = $db->escape($id);
        $query = "SELECT text_ongkir from ongkir_ln where id=$id";
        return $db->query($query)->getRowArray();
    }
}
