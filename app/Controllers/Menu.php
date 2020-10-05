<?php

namespace App\Controllers;

use App\Models\menuModel;

class Menu extends BaseController
{
    protected $menuModel;

    public function __construct()
    {
        $this->menuModel = new menuModel();
    }

    public function index()
    {
        $data = [
            'title' => str_replace('-', ' ', ucfirst(service('uri')->getSegment(1)))
        ];
        return view('menu/v_menu', $data);
    }

    public function loadData()
    {
        if ($this->request->isAJAX()) {
            $items = $this->menuModel->orderby('no_urut')->get()->getResultObject();

            $data = [
                'menu' => $this->menuModel->getHTML($items)
            ];

            $view = view('menu/tampilData', $data);
            echo json_encode($view);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function simpan_menu()
    {
        if ($this->request->isAJAX()) {
            $source       = $this->request->getPost('source');
            $destination  = $this->request->getPost('destination');
            // membuat child menu
            $item             = $this->menuModel->where('id_menu', $source)->get()->getRowObject();
            $item->main_menu  = $destination;
            $data = [
                'id_menu' => $source,
                'main_menu' => $destination
            ];

            if (!empty($destination)) {
                $data['level_menu'] = 'sub_menu';
            } else {
                $data['level_menu'] = 'main_menu';
            }

            $this->menuModel->save($data);


            // Mengatur susunan menu
            $ordering       = json_decode($this->request->getPost('order'));
            $rootOrdering   = json_decode($this->request->getPost('rootOrder'));

            if ($ordering) {
                foreach ($ordering as $order => $item_id) {
                    if ($itemToOrder = $this->menuModel->find($item_id)) {
                        $data = [
                            'id_menu' => $itemToOrder['id_menu'],
                            'no_urut' => $order
                        ];

                        $this->menuModel->save($data);
                    }
                }
            } else {
                foreach ($rootOrdering as $order => $item_id) {
                    if ($itemToOrder = $this->menuModel->find($item_id)) {
                        $data = [
                            'id_menu' => $itemToOrder['id_menu'],
                            'no_urut' => $order
                        ];

                        $this->menuModel->save($data);
                    }
                }
            }

            return json_encode(['token' => csrf_hash()]);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function modal_edit()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'menu' => $this->menuModel->find($this->request->getPost('id'))
            ];

            $view_data = [
                'view' => view('menu/modal_edit', $data),
                'token' => csrf_hash(),
            ];

            echo json_encode($view_data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function tambah()
    {
        if ($this->request->isAJAX()) {

            if ($this->request->getPost('status')) {
                $aktif = 'Y';
            } else {
                $aktif = 'N';
            }

            $data = [
                'nama_menu' => esc(trim(strtolower($this->request->getPost('nama')))),
                'url' => esc(trim(strtolower($this->request->getPost('url')))),
                'icon' => $this->request->getPost('icon'),
                'aktif' => $aktif,
            ];

            $tambah = $this->menuModel->save($data);

            if ($tambah) {
                $output['status'] = 'success';
            } else {
                $output['status'] = 'error';
            }

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
                'id_menu' => esc(trim($this->request->getPost('id'))),
                'nama_menu' => esc(strtolower(trim($this->request->getPost('nama')))),
                'url' => esc(strtolower(trim($this->request->getPost('url')))),
                'icon' => esc(strtolower(trim($this->request->getPost('icon')))),
            ];

            $update = $this->menuModel->save($data);
            echo json_encode($update);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function edit_status()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'id_menu' => $this->request->getPost('id'),
                'aktif' => $this->request->getPost('status'),
            ];

            $update = [
                'status' => $this->menuModel->save($data),
                'token' => csrf_hash()
            ];
            echo json_encode($update);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $this->menuModel->delete($this->request->getPost('id'));

            $output = [
                'status' => $this->menuModel->affectedRows(),
                'token' => csrf_hash(),
            ];

            echo json_encode($output);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
