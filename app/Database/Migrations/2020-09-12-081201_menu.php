<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Menu extends Migration
{
	public function up()
	{
		//
		$this->forge->addField([
			'id_menu' => [
				'type' => 'INT',
				'auto_increment' => true,
			],
			'nama_menu' => [
				'type' => 'VARCHAR',
				'constraint' => 30,
			],
			'level_menu' => [
				'type' => 'ENUM',
				'constraint' => ['main_menu', 'sub_menu'],
				'default' => 'main_menu',
			],
			'url' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => true,
			],
			'icon' => [
				'type' => 'VARCHAR',
				'constraint' => 128,
				'null' => true,
			],
			'aktif' => [
				'type' => 'ENUM',
				'constraint' => ['Y', 'N'],
				'default' => 'Y',
			],
			'no_urut' => [
				'type' => 'INT',
			],
			'main_menu' => [
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

		$this->forge->addPrimaryKey('id_menu');
		$this->forge->createTable('menu');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropTable('menu');
	}
}
