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
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id_level_user' => 1,
                'id_menu' => 2,
                'akses' => 1,
                'tambah'    => 1,
                'edit' => 1,
                'hapus' => 1,
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id_level_user' => 1,
                'id_menu' => 3,
                'akses' => 1,
                'tambah'    => 1,
                'edit' => 1,
                'hapus' => 1,
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id_level_user' => 1,
                'id_menu' => 4,
                'akses' => 1,
                'tambah'    => 1,
                'edit' => 1,
                'hapus' => 1,
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id_level_user' => 1,
                'id_menu' => 5,
                'akses' => 1,
                'tambah'    => 1,
                'edit' => 1,
                'hapus' => 1,
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id_level_user' => 1,
                'id_menu' => 6,
                'akses' => 1,
                'tambah'    => 1,
                'edit' => 1,
                'hapus' => 1,
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id_level_user' => 1,
                'id_menu' => 7,
                'akses' => 1,
                'tambah'    => 1,
                'edit' => 1,
                'hapus' => 1,
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id_level_user' => 1,
                'id_menu' => 8,
                'akses' => 1,
                'tambah'    => 1,
                'edit' => 1,
                'hapus' => 1,
                'created_at' => date("Y-m-d H:i:s"),
            ],

        ];

        // Using Query Builder
        $this->db->table('akses')->insertBatch($data);
    }
}
