<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kategori extends Migration
{
	public function up()
	{
		//
		$this->forge->addField([
			'id_kategori' => [
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => true,
			],
			'nama_kategori' => [
				'type' => 'VARCHAR',
				'constraint' => 50,
			],
		]);

		$this->forge->addKey('id_kategori', TRUE);
		$this->forge->createTable('kategori');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropTable('kategori');
	}
}
