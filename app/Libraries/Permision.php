<?php

namespace App\Libraries;


class Permision
{
    // public $db;

    // public function __construct()
    // {
    //     $this->db = \Config\Database::connect();
    // }

    public static function cek_akses()
    {
        helper('url');
        $db = \Config\Database::connect();
        $uri = \Config\Services::uri();

        $uri = \Config\Services::uri();

        // if ($uri->getTotalSegments() == 1) {
        //     $segment = $uri->getSegment(1, 0);
        // } else {
        //     $segment = $uri->getSegment(1, 0) . '/' . $uri->getSegment(2, 0);
        // }

        $cek_menu_aktif = $db->table('menu')
            ->select('menu.nama_menu,menu.url,menu.aktif')
            ->where('url', $uri->getSegment(1, 0))
            ->get()->getRowArray();
        if ($uri->getSegment(1, 0) == 'access_blocked') {
            $cek_menu_aktif['aktif'] = 'Y';
        }

        if ($cek_menu_aktif['aktif'] == 'N') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            $akses = $db->table('akses a')
                ->select('m.nama_menu,m.url,a.*')
                ->join('menu m', 'm.id_menu=a.id_menu')
                ->where('a.id_level_user', session()->get('userLevelId'))
                ->where('m.url', $uri->getSegment(1, 0))
                ->get()->getRowArray();
            if (!$akses) {
                // throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            } else {
                if ($akses['akses'] != 1) {
                    // return redirect()->route('blocked');
                    // throw new \CodeIgniter\Router\Exceptions\RedirectException('blocked');
                    throw new \CodeIgniter\Router\Exceptions\RedirectException('access_blocked');
                } else {
                    return $akses;
                }
            }
        }
        // return $cek_menu_aktif;
    }
}
