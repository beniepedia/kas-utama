<?php

namespace App\Database\Seeds;

use \Ramsey\Uuid\Uuid;

class penggunaSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {

        $data = [
            [
                'id_pengguna' => Uuid::uuid4()->getHex(),
                'id_level_user' => 1,
                'nama' => 'Admin',
                'email'    => 'admin@test.com',
                'password' => password_hash('admin', PASSWORD_DEFAULT),
                'status' => 1,
                'created_at' => date('Y-m-d h:i:s'),
            ],
            [
                'id_pengguna' => Uuid::uuid4()->getHex(),
                'id_level_user' => 2,
                'nama' => 'Anggota',
                'email'    => 'anggota@test.com',
                'password' => password_hash('anggota', PASSWORD_DEFAULT),
                'status' => 1,
                'created_at' => date('Y-m-d h:i:s'),
            ]

        ];

        // Using Query Builder
        $this->db->table('pengguna')->insertBatch($data);
    }
}
