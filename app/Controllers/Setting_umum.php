<?php

namespace App\Controllers;

class Setting_umum extends BaseController
{
    protected $settingModel;
    protected $emailModel;

    public function __construct()
    {
        $this->settingModel = new \App\Models\settingModel();
        $this->emailModel = new \App\Models\emailModel();
    }

    public function index()
    {

        $data = [
            'title' => str_replace('-', ' ', ucfirst(service('uri')->getSegment(1))),
            'setting' => $this->settingModel->first(),
            'email' => $this->emailModel::get(),
        ];
        return view('setting/v_setting', $data);
    }

    public function update()
    {

        if ($this->request->getMethod() == 'post') {
            if (isset($_POST['generalsetting'])) {
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
                $this->settingModel->update(0, $data);
                return redirect()->back();
            }

            if (isset($_POST['emailsetting'])) {

                if ($this->request->getVar('isregister')) {
                    $isregister = 1;
                } else {
                    $isregister = 0;
                }

                $data = [
                    'protocol' => esc(trim($this->request->getPost('protocol'))),
                    'host' => esc(trim($this->request->getPost('host'))),
                    'user' => esc(trim($this->request->getPost('user'))),
                    'password' => ($this->request->getPost('password')),
                    'port' => ($this->request->getPost('port')),
                    'secure' => esc(trim($this->request->getPost('secure'))),
                    'mailtype' => esc(trim($this->request->getPost('mailtype'))),
                    'mailtype' => esc(trim($this->request->getPost('mailtype'))),
                    'is_register' => $isregister,
                ];
                $this->emailModel->update(0, $data);
                return redirect()->back();
            }
        }
    }
}
