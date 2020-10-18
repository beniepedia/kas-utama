<?php

namespace App\Controllers;


class Tagihan extends BaseController
{
    protected $bulan;

    public function __construct()
    {
        $this->bulan = [1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'];;
    }

    public function index()
    {
        $data = [
            'bulan' => $this->bulan
        ];
        return view('tagihan/v_tagihan', $data);
    }
}
