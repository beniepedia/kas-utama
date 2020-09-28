<?php

namespace App\Controllers;

use App\Models\kategoriModel;
use App\Models\kasUmumModel;


class Pemasukan extends BaseController
{
    protected $kategoriModel;
    protected $kasUmumModel;
    protected $url = "/pemasukan";

    public function __construct()
    {
        $this->kategoriModel = new kategoriModel();
        $this->kasUmumModel = new kasUmumModel();
    }
    public function index()
    {
        $data = [
            'kasMasuk' => $this->kasUmumModel->getAll(),
            'total' => $this->kasUmumModel->total(),
            'title' => 'Daftar KAS',
        ];
        return view('kas_umum/v_pemasukan', $data);
    }

    public function tambah()
    {
        if (isset($_POST['tambahkas'])) {
            $this->save($this->request->getPost());
            return redirect()->to($this->url);
        }
        $data = [
            'title' => 'Tambah Pemasukan',
            'kategori' => $this->kategoriModel->orderby('nama_kategori', 'ASC')->findAll()
        ];
        return view('kas_umum/v_tambah_pemasukan', $data);
    }

    public function ubah($id)
    {
        $data = [
            'title' => 'Ubah data pemasukan',
            'kas' => $this->kasUmumModel->find($id),
            'kategori' => $this->kategoriModel->findAll()
        ];
        return view('kas_umum/v_edit_pemasukan', $data);
    }

    public function hapus()
    {
        if (isset($_POST['delete'])) {
            $id = $this->request->getPost('id');
            $this->kasUmumModel->delete($id);
            if ($this->kasUmumModel->affectedRows() > 0) {
                session()->setFlashdata('notif', ['title' => 'Berhasil', 'pesan' => 'Data berhasil dihapus!', 'type' => 'success']);
            } else {
                session()->setFlashdata('notif', ['title' => 'Gagal', 'pesan' => 'Data gagal dihapus!', 'type' => 'danger']);
            }
            return redirect()->to($this->url);
        } else {
            return redirect()->to($this->url);
        }
    }

    private function save(array $data)
    {
        $data_arr = [
            'kode_kas_umum' => 'T-' . date('dgis'),
            'tanggal' => $data['tanggal'],
            'id_kategori' => $data['kategori'],
            'jenis_kas' => 'masuk',
            'jumlah' => esc(trim($data['jumlah'])),
            'keterangan' => esc(trim($data['keterangan']))
        ];

        $this->kasUmumModel->insert($data_arr);
        if ($this->kasUmumModel->affectedRows() > 0) {
            session()->setFlashdata('notif', ['title' => 'Berhasil', 'pesan' => 'Data berhasil ditambah!', 'type' => 'success']);
        } else {
            session()->setFlashdata('notif', ['title' => 'Gagal', 'pesan' => 'Data gagal ditambah!', 'type' => 'danger']);
        }
    }
}
