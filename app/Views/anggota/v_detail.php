<?php helper('datetime') ?>
<div class="row">
    <div class="col-sm-8">
        <div class="table-responsive">
            <table class="table table-hover table-borderless">
                <thead>
                    <tr>
                        <th class="text-right">Nama</th>
                        <td class="text-center">:</td>
                        <td><?= $user->nama; ?></td>
                    </tr>
                    <tr>
                        <th class="text-right">Email</th>
                        <td class="text-center">:</td>
                        <td><?= $user->email; ?></td>
                    </tr>
                    <tr>
                        <th class="text-right">Kelamin</th>
                        <td class="text-center">:</td>
                        <td><?= ($user->kelamin == NULL ? '-' : ($user->kelamin == 'L' ? 'Laki - laki' : 'Perempuan')); ?></td>
                    </tr>
                    <tr>
                        <th class="text-right">No Handphone</th>
                        <td class="text-center">:</td>
                        <td><?= ($user->no_hp ? $user->no_hp : '-'); ?></td>
                    </tr>
                    <tr>
                        <th class="text-right">Status</th>
                        <td class="text-center">:</td>
                        <td><?= ($user->status == 0 ? 'Non Aktif' : ($user->status == 1 ? 'Aktif' : 'Bloked')); ?></td>
                    </tr>
                    <tr>
                        <th class="text-right">Alamat</th>
                        <td class="text-center">:</td>
                        <td><?= ($user->alamat ? $user->alamat : '-'); ?></td>
                    </tr>
                    <tr>
                        <th class="text-right">Tgl Daftar</th>
                        <td class="text-center">:</td>
                        <td><?= indo_fulldate($user->created_at); ?></td>
                    </tr>
                    <tr>
                        <th class="text-right">Tgl Pembaruan</th>
                        <td class="text-center">:</td>
                        <td><?= ($user->updated_at ? indo_fulldate($user->updated_at) : '-'); ?></td>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
    <div class="col-sm-4">
        <td><img src="<?= 'writable/user_image/' . $user->photo; ?>" class="img-thumbnail" alt="User photo" width="200"></td>
    </div>
</div>