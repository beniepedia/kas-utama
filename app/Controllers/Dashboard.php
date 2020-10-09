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
            'kas' => $this->kasUmumModel->getTotal(),
        ];

        return view('dashboard/v_dashboard', $data);
    }

    public function loadGrafik()
    {
        if ($this->request->isAJAX()) {
            $data_m = $this->kasUmumModel
                ->select('MONTH(tanggal) AS bulan, SUM(masuk) AS masuk,SUM(keluar) AS keluar')
                ->groupBy('bulan')
                ->orderBy('tanggal')
                ->get()->getResultArray();

            $jumlah_kategori = $this->kasUmumModel
                ->join('kategori k', 'k.id_kategori=kas_umum.id_kategori')
                ->select('nama_kategori,COUNT(*) AS total')
                ->groupBy('kas_umum.id_kategori')->findAll();

            $output = [
                'grafik' => $data_m,
                'kategori' => $jumlah_kategori,
            ];

            return json_encode($output);
        }
    }
}
