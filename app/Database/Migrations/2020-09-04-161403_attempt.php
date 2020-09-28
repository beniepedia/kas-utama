<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Attempt extends Migration
{
	public function up()
	{
		//
		$this->forge->addField([
			'id_attempt' => [
				'type' => 'INT',
				'constraint' => 6,
			],
			'host' => [
				'type' => 'VARCHAR',
				'constraint' => 20,
			],
			'id_pengguna' => [
				'type' => 'VARCHAR',
				'constraint' => 32,
			],
			'waktu' => [
				'type' => 'VARCHAR',
				'constraint' => 30
			],

		]);

		$this->forge->addKey('id_attempt', true);
		$this->forge->createTable('attempt');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropTable('attempt');
	}
}
