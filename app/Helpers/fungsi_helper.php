<?php

if (!function_exists('indo_currency')) {
    function indo_currency($angka = NULL, $format = false)
    {

        if ($angka == NULL) {
            $angka = 'Rp 0';
        } else {
            if (is_numeric($angka)) {
                $angka = 'Rp ' . number_format($angka, '0', ',', '.') . ($format == TRUE ? ',-' : NULL);
            } else {
                $angka = 'Format angka tidak valid!';
            }
        }


        return $angka;
    }
}

if (!function_exists('hash_id')) {
    function hash_id($id = 'hash_id')
    {
        $st = '';
        for ($i = 0; $i < strlen($id); $i++) {
            $st .= hash('sha256', substr($id, $i, 1));
        }

        return hash('md5', $st);
    }
}
