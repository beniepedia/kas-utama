<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Setting extends Migration
{
	public function up()
	{
		//
		$this->forge->addField([
			'id_setting' => [
				'type' => 'INT',
				'constraint' => 1,
			],
			'nama_app' => [
				'type' => 'VARCHAR',
				'constraint' => 100,
			],
			'desa' => [
				'type' => 'VARCHAR',
				'constraint' => 100,
			],
			'kelurahan' => [
				'type' => 'VARCHAR',
				'constraint' => 100,
			],
			'kecamatan' => [
				'type' => 'VARCHAR',
				'constraint' => 100,
			],
			'alamat' => [
				'type' => 'TEXT',
			],
			'logo' => [
				'type' => 'VARCHAR',
				'constraint' => 100,
			],
		]);

		$this->forge->addKey('id_settting');
		$this->forge->createTable('setting');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropTable('setting');
	}
}
