<?php

namespace App\Database\Seeds;


class userLevelSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_level' => 'Administrator',
            ],
            [
                'nama_level' => 'Anggota',
            ]

        ];

        // Using Query Builder
        $this->db->table('level_user')->insertBatch($data);
    }
}
