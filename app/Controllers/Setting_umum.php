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
            'setting' => $this->settingModel->first(),
        ];
        return view('setting/v_setting', $data);
    }
}
