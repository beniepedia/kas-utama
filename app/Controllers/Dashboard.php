<?php

namespace App\Controllers;

use App\Models\kasUmumModel;



class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->kasUmumModel = new kasUmumModel();
    }
    public function index()
    {

        $data = [
            'title' => str_replace('-', ' ', ucfirst(service('uri')->getSegment(1))),
            'total_kas_umum' => $this->kasUmumModel->total('pemasukan')->getRowArray(),
        ];

        return view('dashboard/v_dashboard', $data);
        // $data = [
        //     'email' => 'dasdsad',
        //     'nama' => 'dasdsadwe',
        //     'token' => 'dsadsada',
        // ];
        // return view('email/lupapassword', $data);
    }
}
