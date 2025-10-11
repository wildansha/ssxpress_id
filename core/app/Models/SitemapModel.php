<?php

namespace App\Models;

use CodeIgniter\Model;

class SitemapModel extends Model
{
    protected $table      = 'sitemap';
    protected $primaryKey = 'id';

    // protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['url', 'changefreq', 'priority'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function getById($id)
    {
        return $this->where(['id' => $id])->first();
    }
    public function getByUrl($url)
    {
        return $this->where(['url' => $url])->first();
    }

    public function get($url = false)
    {
        if ($url == false) {
            return $this->orderBy('created_at', 'desc')->findAll();
        } else {
            return $this->orderBy('created_at', 'desc')->like('url', $url);
        }
    }
}
