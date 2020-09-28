<?php

namespace App\Controllers;

use App\Models\AuthModel;

use App\Libraries\SendEmail;

use CodeIgniter\Controller;

class Auth extends Controller
{
    protected $authModel;

    protected $sendEmail;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {

        parent::initController($request, $response, $logger);
    }

    public function __construct()
    {
        helper('text');
        $this->authModel = new AuthModel();
        $this->sendEmail = new SendEmail();
    }


    public function login()
    {

        return view('auth/v_login');
    }

    public function register()
    {

        return view('auth/v_register');
        // return view('email/verifikasi');
    }

    public function login_proses()
    {
        if ($this->request->isAJAX()) {
            $email = trim($this->request->getPost('email'));
            $password = $this->request->getPost('password');
            $result = $this->authModel->login($email, $password);
            return json_encode($result);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function register_proses()
    {
        if ($this->request->isAJAX()) {
            $register = $this->authModel->register();
            echo json_encode($register);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function verifikasi($token = '')
    {
        if ($token == '') {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();

        $userData = $db->table('user_token')->where('token', $token)->get()->getRowObject();

        if ($userData) {
            if (time() - $userData->date_created > DAY) {
                // token expired
                $this->authModel->where('email', $userData->email)->delete();
                $db->table('user_token')->where('email', $userData->email)->delete();
                $data['status']     = 'error';
                $data['title']      = 'Verifikasi gagal!';
                $data['pesan']      = 'Token expired. silahkan registrasi ulang.';
            } else {
                // berhasil
                $this->authModel->where('email', $userData->email)->set(['status' => 1])->update();
                $db->table('user_token')->where('email', $userData->email)->delete();
                $data['status']     = 'success';
                $data['title']      = 'Verifikasi Berhasil!';
                $data['pesan']      = "Email kamu <b>{$userData->email}</b> berhasil di verifikasi. Email sudah dapat digunakan untuk login.";
            }
        } else {
            // cek token
            $data['status']         = 'error';
            $data['title']          = 'Verifikasi gagal!';
            $data['pesan']          = 'Token tidak dapat digunakan atau sudah tidak berlaku. silahkan coba beberapa saat lagi.';
        }

        return view('auth/v_verifikasi', $data);
    }

    public function remove_attempt()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $output = $this->authModel->delete_attempt($id);
            return json_encode($output);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function keluar()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function email_cek()
    {
        if ($this->request->isAJAX()) {
            $email = trim($this->request->getPost('email'));
            $user = $this->authModel->cek_email($email);
            if ($user) {
                echo 'false';
            } else {
                echo 'true';
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function locked($id = false)
    {
        if ($id !== session()->get('userId')) {
            return redirect()->to('/login');
        }

        session()->remove('isLogged');

        return redirect()->to('/auth/lockscreen');
    }

    public function lockscreen()
    {

        if (isset($_POST['password'])) {
            $cek_login = $this->authModel->login(session()->get('userEmail'), $this->request->getPost('password'));
            if ($cek_login['error'] == 3) {
                return redirect()->to('/login');
            }

            session()->setFlashdata($cek_login);
        }

        if (!session()->get('userId')) {
            return redirect()->to('/login');
        }

        if (session()->get('isLogged')) {
            return redirect()->to('/dashboard');
        }



        $DB = new \App\Models\penggunaModel();

        $data = [
            'userData' => $DB->asObject()->find(session()->get('userId'))
        ];

        return view('auth/v_lockscreen', $data);
    }
}
