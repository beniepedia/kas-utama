<?php

namespace App\Controllers;

use App\Models\levelUserModel;
use App\Models\menuModel;

class Level_user extends BaseController
{
    protected $db;
    protected $uri;

    public function __construct()
    {
        $this->db = new levelUserModel();
    }

    public function index()
    {

        $data = [
            'title' => str_replace('-', ' ', ucfirst(service('uri')->getSegment(1)))
        ];
        return view('level_user/v_level_user', $data);
    }

    public function loadData()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'level' => $this->db->orderby('id_level_user', 'DESC')->findAll(),
            ];
            $msg = [
                'data' => view('level_user/tampilData', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function proses()
    {
        # code...
        if ($this->request->isAJAX()) {
            if (empty($this->request->getPost('idleveluser'))) {
                $this->db->save([
                    'nama_level' => esc(trim($this->request->getPost('namalevel')))
                ]);
                $output = ['proses' => 'simpan', 'status' => $this->db->affectedRows()];
            } else {
                $this->db->save([
                    'id_level_user' => $this->request->getPost('idleveluser'),
                    'nama_level' => esc(trim($this->request->getPost('namalevel')))
                ]);
                $output = [
                    'proses' => 'update',
                    'status' => $this->db->affectedRows()
                ];
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
                'token' => csrf_hash(),
            ];
            echo json_encode($output);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function form_modal()
    {
        if ($this->request->isAJAX()) {
            $menuModel = new menuModel();
            $data = [
                'list_menu' => $menuModel->list_menu(),
            ];
            $view = [
                'data' => view('level_user/form_modal', $data)
            ];

            echo json_encode($view);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function ubah()
    {
        $menuModel = new menuModel();
        $update = $menuModel->update_menu_akses();
        // return redirect()->to('/pengaturan/level');
        if ($update) {
            session()->setFlashdata('notif', ['type' => 'success', 'title' => 'Update berhasil!', 'msg' => 'Akses pengguna berhasil diupdate!']);
        } else {
            session()->setFlashdata('notif', ['type' => 'danger', 'title' => 'Update gagal!', 'msg' => 'Akses pengguna gagal diupdate!']);
        }
        return redirect()->to(previous_url());
    }
}
