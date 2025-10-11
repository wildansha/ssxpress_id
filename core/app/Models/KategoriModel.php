<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table      = 'kategori';
    protected $primaryKey = 'kategori';

    // protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['kategori', 'foto'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function get()
    {
        return $this->orderBy('kategori', 'asc')->findAll();
    }
    public function search($kategori)
    {
        return $this->where(['kategori' => $kategori])->first();
    }
}
