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


    public static function verifikasi($email, $nama, $token)
    {
        $sendEmail = self::emailset();

        $sendEmail->setFrom('beniepedia@gmail.com', 'MY APP');
        $sendEmail->setTo($email);
        $sendEmail->setSubject('Verifikasi Email registrasi');

        $data = [
            'nama' => $nama,
            'token' => $token
        ];

        $body = view('App\Views\email\verifikasi', $data);

        $sendEmail->setMessage($body);

        $sendEmail->send();
    }
}
