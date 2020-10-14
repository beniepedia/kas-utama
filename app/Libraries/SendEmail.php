<?php

namespace App\Libraries;

use App\Models\emailModel;

class SendEmail
{

    public static function emailset()
    {
        $email = \Config\Services::email();

        $emailModel = new emailModel();

        $config['protocol'] = $emailModel->get()->protocol;
        $config['SMTPHost'] = $emailModel->get()->host;
        $config['SMTPUser'] = $emailModel->get()->user;
        $config['SMTPPass'] = $emailModel->get()->password;
        $config['SMTPPort'] = $emailModel->get()->port;
        $config['SMTPCrypto'] = $emailModel->get()->secure;
        $config['mailType'] = $emailModel->get()->mailtype;
        $config['newline'] = "\r\n";

        return $email->initialize($config);
    }



    public static function system($type, $email, $nama, $token)
    {
        $sendEmail = self::emailset();

        $data = [
            'nama' => $nama,
            'token' => $token,
            'email' => $email,
        ];

        if ($type === 'verifikasi') {
            $sendEmail->setSubject('Verifikasi Email registrasi');
            $body = view('App\Views\email\verifikasi', $data);
        } elseif ($type === 'lupaPassword') {
            $sendEmail->setSubject('Permintaan reset password');
            $body = view('App\Views\email\lupapassword', $data);
        }

        $sendEmail->setFrom('beniepedia@gmail.com', 'MY APP');

        $sendEmail->setTo($email);

        $sendEmail->setMessage($body);

        return $sendEmail->send();
    }
}
