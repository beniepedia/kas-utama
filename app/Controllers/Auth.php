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

        if (isset($_POST['email']) and isset($_POST['password'])) {
            if ($this->request->isAJAX()) {
                $email = trim($this->request->getPost('email'));
                $password = $this->request->getPost('password');
                $result = $this->authModel->login($email, $password);
                return json_encode($result);
            }
        }

        $data = [
            'db' => new \App\Models\settingModel()
        ];

        return view('auth/v_login', $data);
    }

    public function register()
    {

        // if (isset($_POST['email']) and isset($_POST['nama']) and isset($_POST['password'])) {
        //     if ($this->request->isAJAX()) {
        //         $register = $this->authModel->register();
        //         return json_encode($register);
        //     }
        // }

        $data = [
            'db' => new \App\Models\settingModel()
        ];
        return view('auth/v_register', $data);
    }

    // public function login_proses()
    // {
    //     if ($this->request->isAJAX()) {
    //         $email = trim($this->request->getPost('email'));
    //         $password = $this->request->getPost('password');
    //         $result = $this->authModel->login($email, $password);
    //         return json_encode($result);
    //     } else {
    //         throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    //     }
    // }

    public function register_proses()
    {
        if ($this->request->isAJAX()) {
            $register = $this->authModel->register();
            echo json_encode($register);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function lupa_password()
    {
        if (isset($_POST['email'])) {
            if ($this->request->isAJAX()) {
                $cek = $this->authModel->lupa_password();
                return json_encode($cek);
            }
        }
        $data = [
            'db' => new \App\Models\settingModel()
        ];
        return view('auth/v_lupa_password', $data);
    }

    public function reset_password()
    {
        $email = $this->request->getGet('email');
        $token = $this->request->getGet('token');

        $config         = new \Config\Encryption();
        $config->key    = 'aBigsecret_ofAtleast32Characters';
        $config->driver = 'OpenSSL';
        $encrypter = \Config\Services::encrypter($config);

        $db = \Config\Database::connect();

        if (isset($_POST['password']) && isset($_POST['passconf'])) {
            if ($this->request->isAJAX()) {
                $email_dec = $encrypter->decrypt(base64_decode($this->request->getPost('id')));
                $data = [
                    'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                ];
                $update_pasword =  $this->authModel->where('email', $email_dec)->set($data)->update();
                if ($update_pasword) {
                    $db->table('user_token')->where('email', $email_dec)->delete();
                    $output['status'] = 'success';
                    $output['msg']    = 'Kata sandi berhasil di setel ulang. Silahkan login menggunakan kata sandi baru.';
                }

                return json_encode($output);
            }
        }

        $cek_user = $db->table('user_token')->where(['email' => $email, 'token' => $token])->get()->getRowObject();
        if (!$cek_user) {
            return redirect()->to('/login');
        }



        $data = [
            'db' => new \App\Models\settingModel(),
            'id' => base64_encode($encrypter->encrypt($cek_user->email)),
        ];

        return view('auth/v_reset_password', $data);
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
