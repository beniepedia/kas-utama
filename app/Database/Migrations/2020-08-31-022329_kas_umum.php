<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class kas_umum extends Migration
{
	public function up()
	{
		//
		$this->forge->addField([
			'kode_kas_umum' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
			],
			'tanggal' => [
				'type' => 'DATE',
			],
			'id_kategori' => [
				'type' => 'INT',
				'constraint' => 11,
			],
			'jenis_kas' => [
				'type' => 'VARCHAR',
				'constraint' => 30,
			],
			'jumlah' => [
				'type' => 'DOUBLE',
				'default' => 0,
			],
			'keterangan' => [
				'type' => 'TEXT',
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

		$this->forge->addKey('kode_kas_umum', TRUE);
		$this->forge->addKey('id_kategori');
		$this->forge->addForeignKey('id_kategori', 'kategori', 'id_kategori', 'RESTRICT', 'CASCADE');
		$this->forge->createTable('kas_umum');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropForeignKey('kas_umum', 'kas_umum_id_kategori_foreign');
		$this->forge->dropTable('kas_umum');
	}
}
