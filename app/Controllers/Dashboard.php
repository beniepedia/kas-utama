<?php

namespace App\Controllers;

use App\Models\kasUmumModel;
use PHPUnit\Runner\Filter\Factory;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->kasUmumModel = new kasUmumModel();
    }
    public function index()
    {
        $kategori = [1, 2, 3, 4];

        shuffle($kategori);

        foreach ($kategori as $v => $k) {

            $data = $k;
        }

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


        // $data_m = $this->kasUmumModel
        //     ->select('MONTH(tanggal) AS bulan, SUM(jumlah) AS total, jenis_kas')
        //     ->groupBy('bulan, jenis_kas')
        //     ->where('YEAR(tanggal)', date('Y'))->findAll();

        // $data_k = $this->kasUmumModel
        //     ->select('MONTH(tanggal) AS bulan, SUM(jumlah) AS total, jenis_kas')
        //     ->groupBy('bulan, jenis_kas')
        //     ->where('YEAR(tanggal)', date('Y'))->where('jenis_kas', 'pengeluaran')->findAll();


        // $output = [
        //     'keluar' => $data_k,
        //     'masuk' => $data_m,
        // ];

        $db = \Config\Database::connect();

        $data_m = $db->table('tes_kas')->select('MONTHNAME(tanggal) AS bulan, SUM(masuk) AS masuk,SUM(keluar) AS keluar')
            ->groupBy('bulan')
            ->orderBy('tanggal')
            ->get()->getResultArray();

        dd($data_m);
    }
}
