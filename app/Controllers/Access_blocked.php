<?php

namespace App\Controllers;


class Access_blocked extends BaseController
{
    public function index()
    {
        echo view('errors/html/error_403');
    }
}
