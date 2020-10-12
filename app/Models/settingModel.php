<?php

namespace App\Models;

use CodeIgniter\Model;

class settingModel extends Model
{

    protected $table = 'setting';

    protected $primaryKey = 'id_setting';

    protected $returnType = 'object';

    protected $allowedFields = ['nama_app', 'desa', 'kelurahan', 'kecamatan', 'alamat', 'logo'];


    public function setting()
    {
        return $this->first();
    }
}
