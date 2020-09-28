<?php

namespace App\Models;

use CodeIgniter\Model;

class kategoriModel extends Model
{
    protected $table      = 'Kategori';
    protected $primaryKey = 'id_kategori';

    protected $returnType = 'array';

    protected $allowedFields = ['nama_kategori'];
}
