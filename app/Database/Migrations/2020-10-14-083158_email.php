<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Email extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 1,
			],
			'protocol' => [
				'type' => 'VARCHAR',
				'constraint' => 20
			],
			'host' => [
				'type' => 'VARCHAR',
				'constraint' => 50
			],
			'user' => [
				'type' => 'VARCHAR',
				'constraint' => 50
			],
			'password' => [
				'type' => 'VARCHAR',
				'constraint' => 100
			],
			'port' => [
				'type' => 'INT',
				'constraint' => 4
			],
			'secure' => [
				'type' => 'VARCHAR',
				'constraint' => 15
			],
			'mailtype' => [
				'type' => 'VARCHAR',
				'constraint' => 20
			],
			'is_register' => [
				'type' => 'INT',
				'constraint' => 1
			]

		]);

		$this->forge->addKey('id');
		$this->forge->createTable('email');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('email');
	}
}
