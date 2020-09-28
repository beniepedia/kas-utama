<?php

namespace App\Controllers;

use App\Models\penggunaModel;

class Profile extends BaseController
{
    protected $userModel;


    public function __construct()
    {
        $this->userModel = new penggunaModel();
    }


    public function index()
    {
        $data['title'] = str_replace('-', ' ', ucfirst(service('uri')->getSegment(1)));
        return view('profile/v_profile', $data);
    }


    public function loadData()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'user' => $this->userModel->find(session()->get('userId')),
            ];

            $view = [
                'profile' => view('profile/tampilData', $data),
                'ganti_password' => view('profile/v_ganti_password'),
                'profile_image' => view('profile/v_profile_image', $data)
            ];

            echo json_encode($view);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'id_pengguna' => session()->get('userId'),
                'nama' => esc(trim($this->request->getPost('nama'))),
                'no_hp' => esc(trim($this->request->getPost('nohp'))),
                'kelamin' => esc(trim($this->request->getPost('kelamin'))),
                'alamat' => esc(trim($this->request->getPost('alamat'))),
            ];

            $update = $this->userModel->save($data);

            if ($update) {
                $output['type'] = 'success';
                $output['title'] = 'Berhasil!';
                $output['msg'] = "Data berhasil diubah...";
            } else {
                $output['type'] = 'error';
                $output['title'] = 'gagal!';
                $output['msg'] = "Data gagal diubah...";
            }

            echo json_encode($output);
        }
    }

    public function ganti_photo()
    {
        if ($this->request->isAJAX()) {
            $uploadFolder = 'writable/user_image/';
            $gambarLama = $this->request->getPost('gambarLama');
            $gambarBaru = $this->request->getPost('gambarBaru');

            if ($gambarLama != 'default.png') {
                if (file_exists($uploadFolder . $gambarLama)) {
                    unlink($uploadFolder . $gambarLama);
                }
            }

            $gambarBaru_array_1 = explode(';', $gambarBaru);
            $gambarBaru_array_2 = explode(',', $gambarBaru_array_1[1]);

            $data_gambar = base64_decode($gambarBaru_array_2[1]);

            $namaGambarBaru = time() . '_' . str_replace(' ', '_', strtolower(session()->get('userNama'))) . '.png';

            file_put_contents($uploadFolder . $namaGambarBaru, $data_gambar);

            // simpan data ke database

            $this->userModel->save([
                'id_pengguna' => session()->get('userId'),
                'photo' => $namaGambarBaru
            ]);

            $output =  [
                'img_link' => '<img src="' .  $uploadFolder . $namaGambarBaru . '" class="img-circle elevation-2"  alt="User Avatar"/>',
                'link' => $uploadFolder . $namaGambarBaru,
            ];

            echo json_encode($output);
        }
    }

    public function password_cek()
    {
        if ($this->request->isAJAX()) {

            $passLama = $this->request->getPost('passLama');
            $passBaru = $this->request->getPost('passBaru');
            $user = $this->userModel->find(session()->get('userId'));

            if ($this->request->getPost('passLama')) {

                if (password_verify($passLama, $user['password']) == 1) {
                    echo 'true';
                } else {
                    echo "false";
                }
            } else {
                if (password_verify($passBaru, $user['password']) == 1) {
                    echo "false";
                } else {
                    echo 'true';
                }
            }
        }
    }

    public function ganti_password()
    {
        if ($this->request->isAJAX()) {
            $password = password_hash($this->request->getPost('passBaru'), PASSWORD_DEFAULT);
            $userId = session()->get('userId');

            $updatePassword = $this->userModel->save(['id_pengguna' => $userId, 'password' => $password]);
            if ($updatePassword) {
                $output['error'] = 0;
                $output['type'] = 'success';
                $output['title'] = 'Berhasil!';
                $output['msg'] = "Password berhasil diubah. Silahkan login ulang menggunakan password anda yang baru.";
            } else {
                $output['type'] = 'error';
                $output['title'] = 'gagal!';
                $output['msg'] = "Password gagal diubah. Silahkan coba lagi / hubungi admin.";
            }

            echo json_encode($output);
        }
    }
}
