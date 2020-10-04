<?php

namespace App\Controllers;

use App\Models\kategoriModel;

class Kategori extends BaseController
{
    protected $db;
    protected $url = "/kategori";

    public function __construct()
    {
        $this->db = new kategoriModel();
    }

    public function index()
    {
        $data = [
            'title' => str_replace('-', ' ', ucfirst(service('uri')->getSegment(1)))
        ];
        return view('kategori/v_kategori', $data);
    }

    public function loadData()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'kategori' => $this->db->orderby('id_kategori', 'DESC')->findAll(),
            ];
            $msg = [
                'data' => view('kategori/tampilData', $data)
            ];
            echo json_encode($msg);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function proses()
    {
        if ($this->request->isAJAX()) {
            if (empty($this->request->getPost('idkategori'))) {
                $this->db->save([
                    'nama_kategori' => esc(trim($this->request->getPost('kategori')))
                ]);

                $output['proses'] = 'simpan';
                $output['status'] = $this->db->affectedRows();
            } else {
                $this->db->save([
                    'id_kategori' => $this->request->getPost('idkategori'),
                    'nama_kategori' => esc(trim($this->request->getPost('kategori')))
                ]);
                $output['proses'] = 'update';
                $output['status'] = $this->db->affectedRows();
            }

            $output['token'] = csrf_hash();
            echo json_encode($output);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $this->db->delete($this->request->getPost('id'));
            $output = [
                'status' => $this->db->affectedRows(),
                'token' => csrf_hash()
            ];
            echo json_encode($output);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
