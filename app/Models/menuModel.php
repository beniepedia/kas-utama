<?php

namespace App\Models;

use CodeIgniter\Model;

use App\Models\aksesModel;

class menuModel extends Model
{

    protected $table = 'menu';

    protected $primaryKey = 'id_menu';

    protected $returnType = 'array';

    protected $allowedFields = ['nama_menu', 'url', 'level_menu', 'main_menu', 'no_urut', 'icon'];

    protected $useTimestamps = true;

    public function list_menu()
    {
        $request = \Config\Services::request();
        $aksesModel = new aksesModel();
        $idAkses = $request->getPost('level_user');

        $menu = $this->where('aktif', 'Y')->find();
        foreach ($menu as $mn) {
            $result = false;
            foreach ($aksesModel->list_akses($idAkses) as $akses) {
                if ($mn['id_menu'] == $akses['id_menu']) {
                    $result = true;
                }
            }

            if (!$result) {
                $insert[] = [
                    'id_level_user' => $idAkses,
                    'id_menu' => $mn['id_menu'],
                    'created_at' => date('Y-m-d H:i:s'),
                ];
            }
        }

        if (isset($insert)) {
            $aksesModel->insertBatch($insert);
        }

        $return = $this->join('akses a', 'a.id_menu=menu.id_menu', 'left')
            ->select('menu.nama_menu,menu.level_menu,menu.icon,menu.main_menu,a.*')
            ->where('a.id_level_user', $idAkses)
            ->orderby('nama_menu')
            ->get()->getResultArray();

        return $return;
    }

    public function update_menu_akses()
    {
        $aksesModel = new aksesModel();
        $request = \Config\Services::request();

        $id = $request->getPost('level_user');

        $no = 0;

        foreach ($this->list_menu() as $lm) {
            $data[] = [
                'id_menu' => $lm['id_menu'],
                'akses' => ($request->getPost('akses' . $no) ? 1 : 0),
                'tambah' => ($request->getPost('tambah' . $no) ? 1 : 0),
                'edit' => ($request->getPost('edit' . $no) ? 1 : 0),
                'hapus' => ($request->getPost('hapus' . $no) ? 1 : 0),
                'updated_at' => date("Y-m-d H:i:s"),
            ];
            $no++;
        }

        return $aksesModel->update_akses($data, $id);
    }


    public function build_menu($menu, $parentID = 0)
    {
        $result = null;
        foreach ($menu as $item)
            if ($item->main_menu == $parentID) {
                $result .= "<li class='dd-item nested-list-item' data-order='{$item->no_urut}' data-id='{$item->id_menu}'>
            <div class='dd-handle nested-list-handle '>
              <i class='fas fa-bars'></i>
            </div>
            <div class='nested-list-content'>" . ucfirst($item->nama_menu) . "
              <div class='float-right'>
                <a href='javascript:void(0)' id-menu='{$item->id_menu}' class='text-warning edit-menu' data-toggle='tooltip' title='Edit menu {$item->nama_menu}'><i class='fas fa-edit'></i></a>&nbsp;&nbsp;&nbsp;
                <a href='javascript:void(0)' id-menu='{$item->id_menu}' class='text-danger lock-menu' data-toggle='tooltip' title='Nonaktifkan menu {$item->nama_menu}'><i class='fas fa-lock'></i></a>&nbsp;&nbsp;&nbsp;
                <a href='javascript:void(0)' id-menu='{$item->id_menu}' class='text-danger hapus-menu' data-toggle='tooltip' title='Hapus menu {$item->nama_menu}'><i class='fas fa-trash-alt'></i></a>
              </div>
            </div>" . $this->build_menu($menu, $item->id_menu) . "</li>";
            }
        return $result ?  "\n<ol class=\"dd-list\">\n$result</ol>\n" : null;
    }

    public function getHTML($items)
    {
        return $this->build_menu($items);
    }
}
