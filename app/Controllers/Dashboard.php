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

        $data = $this->kasUmumModel
            ->select('jenis_kas, MONTH(tanggal) as bulan, YEAR(tanggal) as tahun, SUM(jumlah) as total')
            ->groupBy('bulan')
            ->orderby('bulan')
            ->findAll();
        d($data);

        die;



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

    public function loadGrafik()
    {
        if ($this->request->isAJAX()) {
            $view_data = view('dashboard/grafik');

            echo json_encode($view_data);
        }
    }
}
