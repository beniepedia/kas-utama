<?php

namespace App\Controllers;


class Setting_umum extends BaseController
{
    protected $settingModel;

    public function __construct()
    {
        $this->settingModel = new \App\Models\settingModel();
    }

    public function index()
    {
        $data = [
            'title' => str_replace('-', ' ', ucfirst(service('uri')->getSegment(1)))
        ];
        return view('setting/v_setting', $data);
    }

    public function loadData()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'setting' => $this->settingModel->first(),
            ];

            $view_data = [
                'view' => view('setting/tampilData', $data)
            ];

            return json_encode($view_data);
        }
    }

    public function update()
    {

        if ($this->request->isAJAX()) {
            $file = $this->request->getFile('logo');

            $uploadDir = WRITEPATH . 'uploads/';

            if ($file->getError() != 4) {
                if (file_exists($uploadDir . 'logo.png')) {
                    unlink($uploadDir . 'logo.png');
                }

                $file->move($uploadDir, 'logo.png');
            }

            $data = [
                'nama_app' => esc(trim($this->request->getVar('nama'))),
                'desa' => esc(trim($this->request->getVar('desa'))),
                'kelurahan' => esc(trim($this->request->getVar('kelurahan'))),
                'kecamatan' => esc(trim($this->request->getVar('kecamatan'))),
                'alamat' => esc(trim($this->request->getVar('alamat'))),
                'logo' => 'logo.png',
            ];
            $update = $this->settingModel->update(0, $data);
            if ($update) {
                $output['status'] = 'success';
                $output['msg'] = 'pengaturan berhasil disimpan';
            } else {
                $output['status'] = 'error';
                $output['msg'] = 'gagal menyimpan';
            }
            $output['token'] = csrf_hash();
            echo json_encode($output);
        }
    }
}
