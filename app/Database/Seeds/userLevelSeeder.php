<?php

namespace App\Database\Seeds;


class userLevelSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_level' => 'superadmin',
            ],
            [
                'nama_level' => 'administrator',
            ],
            [
                'nama_level' => 'anggota',
            ]

        ];

        // Using Query Builder
        $this->db->table('level_user')->insertBatch($data);
    }
}
