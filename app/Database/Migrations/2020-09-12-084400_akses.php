<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Akses extends Migration
{
	public function up()
	{
		//
		$this->forge->addField([
			'id_akses' => [
				'type' => 'INT',
				'auto_increment' => true,
				'constraint' => 11,
			],
			'id_level_user' => [
				'type' => 'INT',
				'constraint' => 11,
			],
			'id_menu' => [
				'type' => 'INT',
				'constraint' => 11,
			],
			'akses' => [
				'type' => 'INT',
				'constraint' => 1,
			],
			'tambah' => [
				'type' => 'INT',
				'constraint' => 1,
			],
			'edit' => [
				'type' => 'INT',
				'constraint' => 1,
			],
			'hapus' => [
				'type' => 'INT',
				'constraint' => 1,
			],
			'created_at' => [
				'type' => 'DATETIME',
				'null' => true,
			],
			'updated_at' => [
				'type' => 'DATETIME',
				'null' => true,
			]
		]);
		$this->forge->addPrimaryKey('id_akses');
		$this->forge->addKey('id_menu');
		$this->forge->addKey('id_level_user');
		$this->forge->addForeignKey('id_menu', 'menu', 'id_menu', 'CASCADE', 'CASCADE');
		$this->forge->addForeignKey('id_level_user', 'level_user', 'id_level_user', 'CASCADE', 'CASCADE');
		$this->forge->createTable('akses');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropForeignKey('akses', 'akses_id_menu_foreign');
		$this->forge->dropForeignKey('akses', 'akses_id_level_user_foreign');
		$this->forge->dropTable('akses');
	}
}
