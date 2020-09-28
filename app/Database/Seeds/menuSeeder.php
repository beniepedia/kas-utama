<?php

namespace App\Database\Seeds;

use \Ramsey\Uuid\Uuid;

class menuSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {

        $data = [
            [
                'nama_menu' => 'dashboard',
                'level_menu' => 'main_menu',
                'url' => 'dashboard',
                'icon'    => 'fas fa-tachometer-alt',
                'aktif' => 'Y',
                'no_urut' => 1,
                'main_menu' => 0
            ],
            [
                'nama_menu' => 'kategori',
                'level_menu' => 'main_menu',
                'url' => 'kategori',
                'icon'    => 'fas fa-th',
                'aktif' => 'Y',
                'no_urut' => 2,
                'main_menu' => 0
            ],
            [
                'nama_menu' => 'kas Umum',
                'level_menu' => 'main_menu',
                'url' => 'kas_umum',
                'icon'    => 'fas fa-th',
                'aktif' => 'Y',
                'no_urut' => 3,
                'main_menu' => 0
            ],
            [
                'nama_menu' => 'anggota',
                'level_menu' => 'main_menu',
                'url' => 'anggota',
                'icon'    => 'fas fa-th',
                'aktif' => 'Y',
                'no_urut' => 4,
                'main_menu' => 0
            ],

        ];

        // Using Query Builder
        $this->db->table('menu')->insertBatch($data);
    }
}
