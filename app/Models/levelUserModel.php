<?php

namespace App\Models;

use CodeIgniter\Model;

class levelUserModel extends Model
{
    protected $table      = 'level_user';
    protected $primaryKey = 'id_level_user';

    protected $returnType = 'array';

    protected $allowedFields = ['nama_level'];
}
