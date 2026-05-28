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
    public function list_kabupaten_agen()
    {
        $db = \Config\Database::connect();

        $query = "SELECT distinct a.kabupaten_id, k.kabupaten, k.jenis
        from agen a
        join master_kabupaten k on a.kabupaten_id = k.id
        order by k.kabupaten asc";
        return $db->query($query)->getResultArray();
    }

    public function list_agen($kabupaten_id)
    {
        $db = \Config\Database::connect();
        $kabupaten_id = $db->escape($kabupaten_id);

        $query = "SELECT distinct a.*, k.kabupaten, k.jenis
        from agen a
        join master_kabupaten k on a.kabupaten_id = k.id
        where true";
        if ($kabupaten_id !== "''") {
            $query .= " AND a.kabupaten_id = $kabupaten_id ";
        }
        return $db->query($query)->getResultArray();
    }
}
