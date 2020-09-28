<?php

namespace App\Models;

use CodeIgniter\Model;

class aksesModel extends Model
{

    protected $table = 'akses';

    protected $primaryKey = 'id_akses';

    protected $returnType = 'array';

    protected $allowedFields = ['id_level_user', 'id_menu', 'akses', 'tambah', 'edit', 'hapus'];

    protected $useTimestamps = true;


    public function main_menu()
    {
        $main_menu = $this->join('menu', 'menu.id_menu = akses.id_menu')
            ->select('menu.*', 'akses.akses', 'akses.tambah', 'akses.edit', 'akses.hapus')
            ->where('id_level_user', session()->get('userLevelId'))
            ->where('akses', 1)
            ->where('aktif', 'Y')
            ->orderby('no_urut')
            ->where('menu.level_menu', 'main_menu')->get()->getResultObject();

        return $main_menu;
    }

    public function sub_menu()
    {
        $sub_menu = $this->join('menu', 'menu.id_menu = akses.id_menu')
            ->select('menu.*', 'akses.akses', 'akses.tambah', 'akses.edit', 'akses.hapus')
            ->where('id_level_user', session()->get('userLevelId'))
            ->where('akses', 1)
            ->where('aktif', 'Y')
            ->where('menu.level_menu', 'sub_menu')
            ->orderby('no_urut')
            ->get()->getResultObject();

        return $sub_menu;
    }



    public function list_akses(int $id)
    {
        return $this->where('id_level_user', $id)->find();
    }

    public function update_akses($data = [], $id)
    {
        $this->where('id_level_user', $id);
        return $this->updateBatch($data, 'id_menu');
    }
}
