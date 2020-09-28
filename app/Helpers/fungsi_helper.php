<?php

if (!function_exists('indo_currency')) {
    function indo_currency($angka)
    {
        if (is_numeric($angka)) {
            $angka = 'Rp ' . number_format($angka, '0', ',', '.');
        } else {
            $angka = 'Format angka tidak valid!';
        }
        return $angka;
    }
}
