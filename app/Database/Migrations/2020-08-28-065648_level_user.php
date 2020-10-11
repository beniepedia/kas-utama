<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Level_user extends Migration
{
	public function up()
	{
		//
		$this->forge->addField([
			'id_level_user' => [
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => true,
			],
			'nama_level' => [
				'type' => 'VARCHAR',
				'constraint' => 30,
			],
		]);

		$this->forge->addPrimaryKey('id_level_user');
		$this->forge->createTable('level_user');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropTable('level_user');
	}
}
