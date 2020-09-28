<?php

if (!function_exists('indo_fulldate')) {
    function indo_fulldate($date)
    {
        $hr_arr = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu'];
        $bulan_arr = [1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'];
        if (empty($date)) {
            return "Tanggal kosong";
        }

        if (is_numeric($date)) {
            $unix_date = $date;
        } else {
            $unix_date = strtotime($date);
        }
        if (empty($unix_date)) {
            return "Tanggal Error";
        }

        $hr = date('w', $unix_date);
        $hari = $hr_arr[$hr];
        $tanggal = date('j', $unix_date);
        $bul = date('n', $unix_date);
        $bulan = $bulan_arr[$bul];
        $tahun = date('Y', $unix_date);
        $jam = date('H:i', $unix_date);

        return  $hari . ', ' . $tanggal . ' ' . $bulan . ' ' . $tahun . ' - ' . $jam;
    }
}


if (!function_exists('indo_daydate')) {
    function indo_daydate($date)
    {
        $hr_arr = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu'];
        $bulan_arr = [1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'];
        if (empty($date)) {
            return null;
        }

        if (is_numeric($date)) {
            $unix_date = $date;
        } else {
            $unix_date = strtotime($date);
        }
        if (empty($unix_date)) {
            return "Tanggal Error";
        }

        $hr = date('w', $unix_date);
        $hari = $hr_arr[$hr];
        $tanggal = date('j', $unix_date);
        $bul = date('n', $unix_date);
        $bulan = $bulan_arr[$bul];
        $tahun = date('Y', $unix_date);

        return  $hari . ', ' . $tanggal . ' ' . $bulan . ' ' . $tahun;
    }
}

if (!function_exists('indo_daydate_sm')) {
    function indo_daydate_sm($date)
    {
        $hr_arr = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu'];
        $bulan_arr = [1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'];
        if (empty($date)) {
            return null;
        }

        if (is_numeric($date)) {
            $unix_date = $date;
        } else {
            $unix_date = strtotime($date);
        }
        if (empty($unix_date)) {
            return "Tanggal Error";
        }

        $hr = date('w', $unix_date);
        $hari = $hr_arr[$hr];
        $tanggal = date('j', $unix_date);
        $bul = date('n', $unix_date);
        $bulan = $bulan_arr[$bul];
        $tahun = date('Y', $unix_date);

        return  $hari . ', ' . $tanggal . ' ' . $bulan . ' ' . $tahun;
    }
}

if (!function_exists('indo_datetime')) {
    function indo_datetime($date)
    {
        $bulan_arr = [1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'];
        if (empty($date)) {
            return "Tanggal kosong";
        }

        if (is_numeric($date)) {
            $unix_date = $date;
        } else {
            $unix_date = strtotime($date);
        }
        if (empty($unix_date)) {
            return "Tanggal Error";
        }

        $tanggal = date('j', $unix_date);
        $bul = date('n', $unix_date);
        $bulan = $bulan_arr[$bul];
        $tahun = date('Y', $unix_date);
        $jam = date('H:i', $unix_date);

        return  $tanggal . ' ' . $bulan . ' ' . $tahun . ' - ' . $jam;
    }
}

if (!function_exists('indo_date')) {
    function indo_date($date)
    {
        $bulan_arr = [1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'];
        if (empty($date)) {
            return "Tanggal kosong";
        }

        if (is_numeric($date)) {
            $unix_date = $date;
        } else {
            $unix_date = strtotime($date);
        }
        if (empty($unix_date)) {
            return "Tanggal Error";
        }

        $tanggal = date('j', $unix_date);
        $bul = date('n', $unix_date);
        $bulan = $bulan_arr[$bul];
        $tahun = date('Y', $unix_date);
        $jam = date('H:i', $unix_date);

        return  $tanggal . ' ' . $bulan . ' ' . $tahun;
    }
}

if (!function_exists('indo_date_sm')) {
    function indo_date_sm($date)
    {
        $bulan_arr = [1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'];
        if (empty($date)) {
            return "Tanggal kosong";
        }

        if (is_numeric($date)) {
            $unix_date = $date;
        } else {
            $unix_date = strtotime($date);
        }
        if (empty($unix_date)) {
            return "Tanggal Error";
        }

        $tanggal = date('j', $unix_date);
        $bul = date('n', $unix_date);
        $bulan = $bulan_arr[$bul];
        $tahun = date('Y', $unix_date);
        $jam = date('H:i', $unix_date);

        return  $tanggal . ' ' . $bulan . ' ' . $tahun;
    }
}
