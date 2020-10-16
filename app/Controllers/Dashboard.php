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

        $jatuhtempo = "2020-10-20";
        $bulan = [1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'];


        for ($i = 1; $i <= count($bulan); $i++) {
            $tempo = date("Y-m-d", strtotime("+$i month", strtotime($jatuhtempo)));
            echo $tempo . "<br>";
            echo date("Y", strtotime($tempo)) . "<br>";
        }


        die;



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
