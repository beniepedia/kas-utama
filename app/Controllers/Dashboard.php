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

    public function loadGrafik()
    {
        // if ($this->request->isAJAX()) {
        // $view_data = view('dashboard/grafik');

        // echo json_encode($view_data);


        // $data_chart = $this->kasUmumModel
        //     ->select('jenis_kas, MONTH(tanggal) as bulan, SUM(jumlah) as total')
        //     ->where('YEAR(tanggal)', date('Y'))
        //     ->groupBy('bulan')->findALl();
        $data_m = $this->kasUmumModel
            ->select('jenis_kas, MONTH(tanggal) as bulan, SUM(jumlah) as total')
            ->where('YEAR(tanggal)', date('Y'))
            ->where('jenis_kas', 'pemasukan')
            ->groupBy('bulan')->findAll();

        $data_p = $this->kasUmumModel
            ->select('jenis_kas, MONTH(tanggal) as bulan, SUM(jumlah) as total')
            ->where('YEAR(tanggal)', date('Y'))
            ->where('jenis_kas', 'pengeluaran')
            ->groupBy('bulan')->findAll();

        $output = [
            'm' => $data_m,
            'p' => $data_p
        ];

        return json_encode($output);
    }
}
