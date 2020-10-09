<?php

namespace App\Controllers;

use App\Models\penggunaModel;
use App\Models\levelUserModel;

use \Ramsey\Uuid\Uuid;


class Anggota extends BaseController
{

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new penggunaModel();
        $this->userLevel = new levelUserModel();
    }


    public function index()
    {
        $data = [
            'title' => str_replace('-', ' ', ucfirst(service('uri')->getSegment(1)))
        ];
        return view('anggota/v_anggota', $data);
    }

    public function loadData()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'user' => $this->userModel->getUser(),
            ];

            $view = [
                'data' => view('anggota/tampilData', $data)
            ];

            echo json_encode($view);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function tambah()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah anggota',
            ];

            $view = [
                'data' => view('anggota/formTambah', $data)
            ];
            echo json_encode($view);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function tambah_banyak()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah banyak anggota',
            ];
            $view = [
                'data' => view('anggota/formTambahBanyak', $data)
            ];
            echo json_encode($view);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function save_banyak()
    {
        if ($this->request->isAJAX()) {
            $nama = $this->request->getPost('nama');
            $email = $this->request->getPost('email');
            $nohp = $this->request->getPost('nohp');
            $kelamin = $this->request->getPost('kelamin');
            $password = $this->request->getPost('password');
            $status = $this->request->getPost('status');

            $jumlahData = count($nama);

            for ($i = 0; $i < $jumlahData; $i++) {
                $data[] = [
                    'id_pengguna' => Uuid::uuid4()->getHex(),
                    'nama' => $nama[$i],
                    'email' => $email[$i],
                    'password' => password_hash($password[$i], PASSWORD_DEFAULT),
                    'kelamin' => $kelamin[$i],
                    'no_hp' => $nohp[$i],
                    'id_level_user' => 2,
                    'status' => $status[$i],
                ];
            }


            $this->userModel->insertBatch($data);
            $result = $this->userModel->affectedRows();
            if ($result) {
                $output['title'] = 'Berhasil!';
                $output['type'] = 'success';
                $output['msg'] = "$jumlahData data berhasil ditambah.";
            } else {
                $output['type'] = 'error';
                $output['title'] = 'gagal!';
                $output['msg'] = "$jumlahData data gagal ditambah.";
            }

            echo json_encode($output);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }


    public function save()
    {
        if ($this->request->isAJAX()) {
            if (isset($_POST['status'])) {
                $status = 1;
            } else {
                $status = 0;
            }

            $data = [
                'id_pengguna' => Uuid::uuid4()->getHex(),
                'nama' => esc(trim($this->request->getPost('nama'))),
                'email' => esc(trim($this->request->getPost('email'))),
                'no_hp' => esc(trim($this->request->getPost('nohp'))),
                'password' => esc($this->request->getPost('password')),
                'alamat' => esc($this->request->getPost('alamat')),
                'status' => $status,
            ];
            $this->userModel->insert($data);
            $ouput['status'] = $this->userModel->affectedRows();
            $ouput['token'] = csrf_hash();
            echo json_encode($ouput);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function hapus_banyak()
    {
        if ($this->request->isAJAX()) {
            $str = explode(' ', $this->request->getPost('id'));
            $jumlahId = count($str);
            for ($i = 0; $i < $jumlahId; $i++) {
                $result = $this->userModel->delete($str[$i]);
            }

            if ($result) {
                $ouput['msg'] = "{$jumlahId} data berhasil dihapus";
                $ouput['type'] = "success";
                $ouput['title'] = "Berhasil!";
            } else {
                $ouput['msg'] = "{$jumlahId} data gagal dihapus";
                $ouput['type'] = "error";
                $ouput['title'] = "Gagal!";
            }
            $ouput['token'] = csrf_hash();
            echo json_encode($ouput);
        }
    }

    public function email_cek()
    {
        if ($this->request->isAJAX()) {
            $email = $this->request->getPost('email');
            $user = $this->userModel->where('email', $email)->find();
            if ($user) {
                echo 'false';
            } else {
                echo 'true';
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function detail()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $data = [
                'user' => $this->userModel->asObject()->find($id)
            ];
            $output['view'] = view('anggota/v_detail', $data);
            $output['token'] = csrf_hash();

            echo json_encode($output);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function ubah_status()
    {
        if ($this->request->isAJAX()) {
            // if (Permision::cek_akses()->edit != 1) {
            //     return false;
            // }

            $id = $this->request->getPost('id');
            $action = $this->request->getPost('action');

            $output['status'] = $this->userModel->update($id, ['status' => $action]);
            $output['token'] = csrf_hash();
            echo json_encode($output);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'user' => $this->userModel->asObject()->find($this->request->getVar('id')),
                'role' => $this->userLevel->asObject()->findAll(),
            ];

            $view_data = [
                'view' => view('anggota/edit', $data),
                'token' => csrf_hash()
            ];
            echo json_encode($view_data);
        }
    }
}
