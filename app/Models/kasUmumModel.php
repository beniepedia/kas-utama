<?php

namespace App\Models;

use CodeIgniter\Model;

class kasUmumModel extends Model
{
    protected $table      = 'kas_umum';
    protected $primaryKey = 'kode_kas_umum';

    protected $returnType = 'array';
    protected $allowedFields = ['kode_kas_umum', 'tanggal', 'id_kategori', 'masuk', 'keluar', 'jenis_kas', 'keterangan'];

    protected $useTimestamps = true;

    public function getAll()
    {
        $data = $this->asObject()->join('kategori', 'kategori.id_kategori=' . $this->table . '.id_kategori')
            ->orderby('created_at', 'DESC')
            ->findAll();
        return $data;
    }

    public function getTotal()
    {
        return $this->asObject()->select('SUM(masuk) AS total_kas_masuk,SUM(keluar) AS total_kas_keluar')->first();
    }
}
