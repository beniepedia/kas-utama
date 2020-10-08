<?php

namespace App\Models;

use CodeIgniter\Model;

class kasUmumModel extends Model
{
    protected $table      = 'kas_umum';
    protected $primaryKey = 'kode_kas_umum';

    protected $returnType = 'array';
    protected $allowedFields = ['kode_kas_umum', 'tanggal', 'id_kategori', 'jumlah', 'jenis_kas', 'keterangan'];

    protected $useTimestamps = true;

    public function getAll()
    {
        $builder = $this->join('kategori', 'kategori.id_kategori=' . $this->table . '.id_kategori')
            ->orderby('created_at', 'DESC')
            ->findAll();
        return $builder;
    }

    public function total_kas_masuk(String $jenis)
    {
        // $this->selectSum('masuk')->where('');
        // return $query;
    }
}
