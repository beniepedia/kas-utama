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
                'nama' => 'Benie',
                'email'    => 'superadmin@test.com',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id_pengguna' => Uuid::uuid4()->getHex(),
                'id_level_user' => 2,
                'nama' => 'Ahmad Qomaini',
                'email'    => 'admin@test.com',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]

        ];

        // Using Query Builder
        $this->db->table('pengguna')->insertBatch($data);
    }
}
