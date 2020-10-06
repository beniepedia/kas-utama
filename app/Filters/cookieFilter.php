<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\penggunaModel;

class cookieFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        // $auth = \Config\Services::session();


        if (isset($_COOKIE['key_id']) and isset($_COOKIE['key_token'])) {

            helper(['cookie', 'fungsi']);
            $userModel  = new penggunaModel();
            $id         = get_cookie('key_id');
            $email_hash = get_cookie('key_token');

            $userData = $userModel->asObject()
                ->join('level_user lu', 'lu.id_level_user=pengguna.id_level_user')
                ->select(['id_pengguna', 'email', 'nama', 'nama_level', 'lu.id_level_user'])
                ->find($id);

            if (hash_id($userData->email) === $email_hash) {
                session()->set([
                    'isLogged' => true,
                    'userId' => $userData->id_pengguna,
                    'userLevelId' => $userData->id_level_user,
                    'userLevel' => $userData->nama_level,
                    'userEmail' => $userData->email,
                    'userNama' => $userData->nama,
                ]);
            }

            return redirect()->to('dashboard');
        }

        if (session()->has('isLogged')) {
            return redirect()->to('/dashboard');
        }


        //--------------------------------------------------------------------
    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here

    }
}
