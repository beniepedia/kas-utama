<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SettingSeeder extends Seeder
{
	public function run()
	{
		$data = [
			'id_setting' => 0,
			'nama_app' => 'e-kas pemuda',
			'logo' => 'logo.png',
			'desa'=>'teluk mempelam',
			'kelurahan' => 'tanjung kapal',
			'kecamatan' => 'rupat',
			'alamat'=> 'jalan parit dua'
		];

		$this->db->table('setting')->insert($data);
	}
}
