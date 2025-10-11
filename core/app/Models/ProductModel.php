<?php

namespace App\Models;

use CodeIgniter\Model;

class productModel extends Model
{
    protected $table      = 'product';
    protected $primaryKey = 'id';

    // protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nama', 'slug', 'kategori', 'harga', 'deskripsi', 'review', 'foto1', 'foto2', 'foto3', 'foto4', 'foto5'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';



    public function get($slug = false)
    {
        if ($slug == false) {
            return $this->table('product')->orderBy('nama', 'asc');
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function search($keyword, $kategori)
    {
        if ($keyword && $kategori) {
            return $this->table('product')->orderBy('nama', 'asc')->like('nama', $keyword)->where('kategori', $kategori);
        } elseif ($keyword) {
            return $this->table('product')->orderBy('nama', 'asc')->like('nama', $keyword);
        } elseif ($kategori) {
            return $this->table('product')->orderBy('nama', 'asc')->where('kategori', $kategori);
        } else {
            return $this->table('product')->orderBy('nama', 'asc');
        }
    }
}
