<?php

namespace App\Database\Seeds;


class aksesSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {

        $data = [
            [
                'id_level_user' => 1,
                'id_menu' => 1,
                'akses' => 1,
                'tambah'    => 1,
                'edit' => 1,
                'hapus' => 1,
            ],
            [
                'id_level_user' => 1,
                'id_menu' => 2,
                'akses' => 1,
                'tambah'    => 1,
                'edit' => 1,
                'hapus' => 1,
            ],
            [
                'id_level_user' => 1,
                'id_menu' => 3,
                'akses' => 1,
                'tambah'    => 1,
                'edit' => 1,
                'hapus' => 1,
            ],
            [
                'id_level_user' => 1,
                'id_menu' => 4,
                'akses' => 1,
                'tambah'    => 1,
                'edit' => 1,
                'hapus' => 1,
            ],

        ];

        // Using Query Builder
        $this->db->table('akses')->insertBatch($data);
    }
}
