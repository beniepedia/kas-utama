<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class NoAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        // $auth = \Config\Services::session();

        if (!session()->has('isLogged')) {

            if (previous_url() === site_url()) {
                return redirect()->to('/login');
            } else {
                return redirect()->to('/login')->with('pesan', 'Silahkan login terlebih dahulu');
            }
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
