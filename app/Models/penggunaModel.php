<?php

namespace App\Models;

use CodeIgniter\Model;

class penggunaModel extends Model
{

    protected $table = 'pengguna';

    protected $primaryKey = 'id_pengguna';

    protected $returnType = 'array';

    protected $allowedFields = [
        'id_pengguna',
        'nama',
        'email',
        'password',
        'no_hp',
        'kelamin',
        'photo',
        'alamat',
        'id_level',
        'status',
    ];

    protected $useTimestamps = true;

    protected $useSoftDeletes = true;

    public function getUser()
    {

        $query = $this->where('pengguna.id_level_user', 3)
            ->join('level_user', 'level_user.id_level_user=pengguna.id_level_user')->orderby('nama', 'ASC');
        return $query->findAll();
    }
}
