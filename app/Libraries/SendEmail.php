<?php

namespace App\Libraries;

class SendEmail
{

    public static function emailset()
    {
        $email = \Config\Services::email();

        $config['protocol'] = 'smtp';
        $config['SMTPHost'] = 'smtp.gmail.com';
        $config['SMTPUser'] = 'beniepedia@gmail.com';
        $config['SMTPPass'] = 'Medan2020';
        $config['SMTPPort'] = 465;
        $config['SMTPCrypto'] = "ssl";
        $config['mailType'] = 'html';
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
