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
}
