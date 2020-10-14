<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pengguna extends Migration
{
	public function up()
	{
		//
		$this->forge->addField([
			'id_pengguna' => [
				'type' => 'VARCHAR',
				'constraint' => 32,
			],
			'id_level_user' => [
				'type' => 'INT',
				'constraint' => 11,
				'default' => 3,
			],
			'nama' => [
				'type' => 'VARCHAR',
				'constraint' => 128,
			],
			'email' => [
				'type' => 'VARCHAR',
				'constraint' => 128,
				'unique' => true,
			],
			'password' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
			],
			'no_hp' => [
				'type' => 'VARCHAR',
				'constraint' => 20,
				'unique' => true,
				'null' => true,
			],
			'kelamin' => [
				'type' => 'ENUM',
				'constraint' => ['L', 'P'],
				'null' => true,
				'default' => NULL
			],
			'photo' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
				'default' => 'default.png',
			],
			'alamat' => [
				'type' => 'TEXT',
				'null' => true,
			],
			'status' => [
				'type' => 'INT',
				'constraint' => 1,
				'default' => 0,
			],
			'created_at' => [
				'type' => 'DATETIME',
				'null' => true,
			],
			'updated_at' => [
				'type' => 'DATETIME',
				'null' => true,
			],
			'deleted_at' => [
				'type' => 'DATETIME',
				'null' => true,
			],
		]);

		$this->forge->addPrimaryKey('id_pengguna');
		$this->forge->addKey('id_level_user');
		$this->forge->addForeignKey('id_level_user', 'level_user', 'id_level_user', 'CASCADE', 'RESTRICT');
		$this->forge->createTable('pengguna');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropForeignKey('pengguna', 'pengguna_id_level_user_foreign');
		$this->forge->dropTable('pengguna');
	}
}
