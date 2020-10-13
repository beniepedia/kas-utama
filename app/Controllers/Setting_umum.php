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
            'title' => str_replace('-', ' ', ucfirst(service('uri')->getSegment(1))),
            'setting' => $this->settingModel->first(),
        ];
        return view('setting/v_setting', $data);
    }

    public function update()
    {

        if ($this->request->getMethod() == 'post') {
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
            return redirect()->back();
        }
    }
}
