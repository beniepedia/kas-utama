<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transaksi extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'no_transaksi' => [
				'type' => 'VARCHAR',
				'constraint' => 128
			],
			'id_pengguna' => [
				'type' => 'VARCHAR',
				'constraint' => 32,
			],
		]);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
