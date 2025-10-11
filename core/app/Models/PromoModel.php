<?php

namespace App\Models;

use CodeIgniter\Model;

class PromoModel extends Model
{
    protected $table      = 'promo';
    protected $primaryKey = 'id';

    protected $useSoftDeletes = false;

    protected $allowedFields = ['judul', 'foto', 'isi'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';



    public function get($id = false)
    {
        if ($id == false) {
            return $this->orderBy('created_at', 'desc')->findAll();
        }
        return $this->where(['id' => $id])->first();
    }

    public function search($keyword)
    {
        return $this->table('promo')->orderBy('created_at', 'desc')->like('judul', $keyword);
    }
}
