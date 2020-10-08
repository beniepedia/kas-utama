<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KasUmum extends Migration
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
				'type' => 'ENUM',
				'constraint' => ['M', 'K'],
			],
			'masuk' => [
				'type' => 'DOUBLE',
				'default' => 0,
			],
			'keluar' => [
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

		$this->forge->addPrimaryKey('kode_kas_umum');
		$this->forge->addKey('id_kategori');
		$this->forge->addForeignKey('id_kategori', 'kategori', 'id_kategori', 'RESTRICT', 'CASCADE');
		$this->forge->createTable('kas_umum');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropForeignKey('kas_umum', 'kas_umum_id_kategori_foreign');
		$this->forge->dropTable('tb_kas_umum');
	}
}
