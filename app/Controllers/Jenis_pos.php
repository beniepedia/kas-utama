<?php

namespace App\Controllers;


class Jenis_pos extends BaseController
{
    public function index()
    {
        $data = [
            'title' => str_replace('-', ' ', ucfirst(service('uri')->getSegment(1))),
        ];
        return view('jenis_pos/v_jenis_pos', $data);
    }
}
