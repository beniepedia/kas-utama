<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class PermissionFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        // $auth = \Config\Services::session();

        if (session()->get('userlevelId') != '1') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }


        //--------------------------------------------------------------------
    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here

    }
}
