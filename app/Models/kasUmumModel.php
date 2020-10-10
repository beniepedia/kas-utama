<?php

namespace App\Models;

use CodeIgniter\Model;

class kasUmumModel extends Model
{
    protected $table      = 'kas_umum';
    protected $primaryKey = 'kode_kas_umum';

    protected $returnType = 'array';
    protected $allowedFields = ['kode_kas_umum', 'tanggal', 'id_kategori', 'masuk', 'keluar', 'jenis_kas', 'keterangan', 'created_by', 'updated_by'];

    protected $useTimestamps = true;

    public function getAll()
    {
        $data = $this->asObject()
            ->join('kategori k', 'k.id_kategori=' . $this->table . '.id_kategori')
            ->orderby('created_at', 'DESC')
            ->findAll();
        return $data;
    }

    public function getDetail(String $kode_kas)
    {
        $data = $this->asObject()->select($this->table . '.*,k.*,pc.nama AS created_name,pu.nama AS updated_name,luc.nama_level AS created_level,luu.nama_level AS updated_level')
            ->join('kategori k', 'k.id_kategori=' . $this->table . '.id_kategori')
            ->join('pengguna pc', 'pc.id_pengguna=' . $this->table . '.created_by', 'left')
            ->join('pengguna pu', 'pu.id_pengguna=' . $this->table . '.updated_by', 'left')
            ->join('level_user luc', 'luc.id_level_user=pc.id_level_user', 'left')
            ->join('level_user luu', 'luu.id_level_user=pu.id_level_user', 'left')
            ->where($this->table . '.kode_kas_umum', $kode_kas)
            ->first();
        return $data;
    }

    public function getTotal()
    {
        return $this->asObject()->select('SUM(masuk) AS total_kas_masuk,SUM(keluar) AS total_kas_keluar')->first();
    }
}
