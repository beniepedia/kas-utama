<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserToken extends Migration
{
	public function up()
	{
		//
		$this->forge->addField([
			'id_user_token' => [
				'type' => 'INT',
				'constraint' => 6,

			],
			'email' => [
				'type' => 'VARCHAR',
				'constraint' => 128
			],
			'token' => [
				'type' => 'VARCHAR',
				'constraint' => 128,
			],
			'date_created' => [
				'type' => 'VARCHAR',
				'constraint' => 128,
			],
		]);

		$this->forge->addPrimaryKey('id_user_tokne');
		$this->forge->createTable('user_token');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropTable('user_token');
	}
}
