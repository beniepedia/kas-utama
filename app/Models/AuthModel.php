<?php

namespace App\Models;

use CodeIgniter\Model;

use Ramsey\Uuid\Uuid;

use App\Libraries\SendEmail as sendEmail;


class AuthModel extends Model
{
    protected $db;
    protected $user;
    protected $attempt;
    protected $request;


    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_pengguna', 'nama', 'email', 'password', 'status'];

    public function __construct()
    {

        $this->db       = db_connect();
        $this->attempt  = $this->db->table('attempt');
        $this->request  = service('request');
    }

    public function login($email, $password)
    {

        $this->where('email', $email);
        $user = $this->join('level_user', 'level_user.id_level_user=pengguna.id_level_user')
            ->get()->getRowArray();

        if ($user) {
            $user_attempt = $this->_cek_login_attempt($user['id_pengguna']);
            if ($user['status'] != 2) {
                // cek user belum verifikasi
                if ($user['status'] != 0) {
                    if ($user_attempt['count'] < 3) {
                        if (password_verify($password, $user['password']) == 1) {
                            if ($user['status'] == 1) {
                                // cek user aktif
                                $this->delete_attempt($user['id_pengguna']);
                                $this->_delete_user_token($email);

                                $setData = [
                                    'isLogged' => true,
                                    'userId' => $user['id_pengguna'],
                                    'userLevelId' => $user['id_level_user'],
                                    'userLevel' => $user['nama_level'],
                                    'userEmail' => $user['email'],
                                    'userNama' => $user['nama'],
                                ];

                                session()->set($setData);
                                $result['error'] = 0;
                                $result['nama'] = $user['nama'];
                                $result['link'] = base_url('dashboard');
                            }
                        } else {
                            $this->_user_attempt($user['id_pengguna']);
                            $result['error'] = 2;
                            $result['msg'] = 'Kata sandi salah. silahkan coba lagi.';
                        }
                    } else {
                        $attempt_date = date('Y-m-d H:i:s', $user_attempt['result']['waktu'] + MINUTE * 1);
                        $result['error'] = 3;
                        $result['msg'] = 'Anda sudah melakukan 3 kali kesalahan. Silahkan coba kembali setelah';
                        $result['time'] = $attempt_date;
                        $result['userId'] = $user['id_pengguna'];
                    }
                } else {
                    // cek user belum verifikasi
                    $this->delete_attempt($user['id_pengguna']);
                    $result['error'] = 5;
                    $result['msg'] = 'Email anda belum diverifikasi. Silahkan cek inbox emial anda untuk verifikasi email.';
                }
            } else {
                $this->delete_attempt($user['id_pengguna']);
                $result['error'] = 4;
                $result['msg'] = 'Akun anda terblokir. Hubungi admin untuk mengaktifkan akun akan kembali!.';
            }
        } else {
            $result['error'] = 1;
            $result['msg'] = 'Email tidak ditemukan!. Silahkan coba lagi...';
        }

        $result['token'] = csrf_hash();
        return $result;


        // return $user_attempt['number_of_attempt'];
    }

    public function register()
    {

        $email = esc(trim($this->request->getPost('email')));
        $nama = esc(trim($this->request->getPost('nama')));
        $token = random_string('crypto', 64);
        $data = [
            'id_pengguna' => Uuid::uuid4()->getHex(),
            'nama' => $nama,
            'email' => $email,
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        $this->insert($data);
        if ($this->affectedRows() == 1) {
            if ($this->_token_insert($email, $token)) {
                sendEmail::system('verifikasi', $email, $nama, $token);
                $output['status'] = 'success';
                $output['msg'] = "Kami sudah mengirimkan email verifikasi ke <b>{$email}</b>. Cek kotak masuk email anda dan lakukan verifikasi.";
            } else {
                $this->where('email', $email)->delete();
                $output['status'] = 'error';
                $output['msg'] = 'Terjadi kesalahan pada sistem kami. Ulangi beberapa saat lagi atau hubungi kami';
            }
        } else {
            $output['status'] = 'error';
            $output['msg'] = 'Terjadi kesalahan pada sistem kami. Ulangi beberapa saat lagi atau hubungi kami';
        }

        $output['token'] = csrf_hash();

        return $output;
    }

    public function lupa_password()
    {
        $email = trim($this->request->getPost('email'));
        $token = random_string('crypto', 64);
        $userData = $this->where(['email' => $email, 'status' => 1])->get()->getRowObject();
        if ($userData) {
            $cek_user_token = $this->_cek_user_token($email);
            if (!$cek_user_token) {
                $this->_token_insert($email, $token);
                sendEmail::system('lupaPassword', $userData->email, $userData->nama, $token);
                $output['error'] = 0;
                $output['msg']   = "Permitaan setel ulang kata sandi berhasil. Petunjuk untuk setel ulang kata sandi sudah kami kirim ke <b>{$userData->email}</b>";
            } else {
                $output['error'] = 2;
                $output['msg']   = "Kamu sudah pernah melakukan permintaan setel ulang kata sandi sebelumnya. Silahkan cek kotak masuk email anda.";
            }
        } else {
            $output['error'] = 1;
            $output['msg']   = "Email tidak terdaftar atau belum aktif. Pastikan email kamu sudah terdaftar atau terverifikasi";
        }

        $output['token'] = csrf_hash();

        return $output;
    }

    private function _cek_login_attempt($id)
    {
        $query['count'] =  $this->attempt->where('id_pengguna', $id)->countAllResults();
        $query['result'] =  $this->attempt->where('id_pengguna', $id)
            ->orderBy('waktu', 'DESC')->get()
            ->getRowArray();
        return $query;
    }

    private function _user_attempt($id)
    {
        helper('text');
        $data = [
            'id_attempt' =>  random_string('numeric', 6),
            'host' => $this->request->getIPAddress(),
            'id_pengguna' => $id,
            'waktu' => time(),
        ];

        $this->db->table('attempt')->insert($data);
    }

    public function delete_attempt($id)
    {
        $output['error'] = '';
        $output['msg'] = '';

        $query = $this->attempt->delete(['id_pengguna' => $id]);
        if ($query->resultID) {
            $output['error'] = 1;
            $output['msg'] = 'Silahkan login kembali...';
        }
        $output['token'] = csrf_hash();
        return $output;
    }

    public function cek_email($mail)
    {
        return $this->where('email', $mail)->get()->getRowArray();
    }

    private function _token_insert($email, $token)
    {
        $data = [
            'id_user_token' => random_string('numeric', 6),
            'email' => $email,
            'token' => $token,
            'date_created' => time()
        ];
        $insert = $this->db->table('user_token')->insert($data);
        return $insert->resultID;
    }

    private function _cek_user_token($email)
    {
        return $this->db->table('user_token')->where('email', $email)->get()->getRowObject();
    }

    private function _delete_user_token($email)
    {
        $delete = $this->db->table('user_token')->where('email', $email)->delete();
    }
}
