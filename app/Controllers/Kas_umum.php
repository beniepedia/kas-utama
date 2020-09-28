<?php

namespace App\Controllers;

use App\Models\kategoriModel;
use App\Models\kasUmumModel;

class Kas_umum extends BaseController
{
    protected $kategoriModel;
    protected $kasUmumModel;

    public function __construct()
    {
        $this->kategoriModel = new kategoriModel();
        $this->kasUmumModel = new kasUmumModel();
    }

    public function index()
    {
        $data = [
            'title' => str_replace('-', ' ', ucfirst(service('uri')->getSegment(1)))
        ];
        return view('kas_umum/v_list_kas', $data);
    }

    public function loadData()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'transaksi' => $this->kasUmumModel->getAll(),
                'pemasukan' => $this->kasUmumModel->total('pemasukan')->getRowArray(),
                'pengeluaran' => $this->kasUmumModel->total('pengeluaran')->getRowArray(),
            ];

            $view = [
                'data' => view('kas_umum/tampilData', $data)
            ];

            echo json_encode($view);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function formModalTambah()
    {
        $uri = \Config\Services::uri();
        if ($this->request->isAJAX()) {
            $data = [
                'kategori' => $this->kategoriModel->orderby('nama_kategori', 'ASC')->findAll(),
                'datamodal' => [
                    'title' => 'Tambah Data',
                    'btn' => 'Simpan',
                    'btn-name' => 'tambah',
                    'action' => base_url($uri->getSegment(1, 0) . '/tambah')
                ]
            ];
            $view = [
                'data' => view('/kas_umum/form_modal', $data)
            ];

            echo json_encode($view);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function formModalUbah()
    {
        $uri = \Config\Services::uri();
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');

            $data = [
                'kategori' => $this->kategoriModel->orderby('nama_kategori', 'ASC')->findAll(),
                'kas' => $this->kasUmumModel->find($id),
                'datamodal' => [
                    'title' => 'Ubah Data',
                    'btn' => 'Update',
                    'btn-name' => 'update',
                    'action' => base_url($uri->getSegment(1, 0) . '/ubah')
                ]
            ];
            $view = [
                'data' => view('/kas_umum/form_modal', $data)
            ];

            echo json_encode($view);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function tambah()
    {

        if ($this->request->isAJAX()) {
            if (isset($_POST['tambah'])) {
                $data_arr = [
                    'kode_kas_umum' => 'T-' . date('dgis'),
                    'tanggal' => date("Y-m-d", strtotime($this->request->getPost('tanggal'))),
                    'id_kategori' => $this->request->getPost('kategori'),
                    'jenis_kas' => $this->request->getPost('jenis'),
                    'jumlah' => str_replace('.', '', $this->request->getPost('jumlah')),
                    'keterangan' => esc(trim($this->request->getPost('keterangan')))
                ];

                $this->kasUmumModel->insert($data_arr);
                echo json_encode(['action' => 'tambah', 'status' => $this->kasUmumModel->affectedRows()]);
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function ubah()
    {
        if ($this->request->isAJAX()) {
            if (isset($_POST['update'])) {
                $data_arr = [
                    'kode_kas_umum' => $this->request->getPost('id'),
                    'tanggal' => date("Y-m-d", strtotime($this->request->getPost('tanggal'))),
                    'id_kategori' => $this->request->getPost('kategori'),
                    'jenis_kas' => $this->request->getPost('jenis'),
                    'jumlah' => str_replace('.', '', $this->request->getPost('jumlah')),
                    'keterangan' => esc(trim($this->request->getPost('keterangan')))
                ];

                $this->kasUmumModel->save($data_arr);
                echo json_encode(['action' => 'update', 'status' => $this->kasUmumModel->affectedRows()]);
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $this->kasUmumModel->delete($id);
            echo json_encode(['status' => $this->kasUmumModel->affectedRows()]);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
