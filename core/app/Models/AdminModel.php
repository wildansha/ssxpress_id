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

        $query = "SELECT count(jp.product_id)-1 as jml_other,jp.harga, j.id as jastip_id, p.nama as product_name ,p.foto1 , DATE_FORMAT(j.created_at,'%d-%m-%Y %H:%i:%s') as waktu_pesan
        from jastip j 
        join jastip_product jp on jp.jastip_id = j.id
        join  product p on p.id = jp.product_id
        where j.status = $status_id
        group by j.id
        ";
        $arr_history = $db->query($query)->getResultArray();
        return $arr_history;
    }
    public function detail_jastip($jastip_id)
    {
        $db = \Config\Database::connect();
        $jastip_id = $db->escape($jastip_id);

        $query = "SELECT j.* , js.status_name, a.email
        from jastip j
        join jastip_status js on js.id = j.status
        join akun a on a.id = j.akun_id
        where j.id = $jastip_id ";
        $jastip = $db->query($query)->getRowArray();

        $query_produk = "SELECT jp.harga,jp.qty, p.nama as product_name, p.slug ,p.foto1
        from jastip_product jp
        join product p on p.id = jp.product_id
        where jp.jastip_id = $jastip_id ";
        $jastip["list_product"] = $db->query($query_produk)->getResultArray();

        return $jastip;
    }
}
