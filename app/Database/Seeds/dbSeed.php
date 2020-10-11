<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class dbSeed extends Seeder
{
	public function run()
	{

		$this->call('userLevelSeeder');
		$this->call('penggunaSeeder');
		$this->call('menuSeeder');
		$this->call('settingSeeder');
		$this->call('aksesSeeder');
	}
}
