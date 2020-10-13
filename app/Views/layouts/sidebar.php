<?php
$db = new \App\Models\aksesModel();

$userModel = new \App\Models\penggunaModel();

$user = $userModel->asObject()->find(session()->get('userId'));

$uri = service('uri'); ?>

<div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex ">
        <div class="image ">
            <img src="<?= site_url('writable/user_image/') . $user->photo ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="<?= base_url('profile') ?>" class="d-block badge badge-success text-white"><?= ucfirst(session('userNama')); ?></a>
            <small class="text-white">login sebagai : <b><?= ucfirst(session('userLevel')); ?></b></small>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <?php foreach ($db->main_menu() as $mm) : ?>

                <li class="nav-item has-treeview">
                    <a href="<?= base_url($mm->url) ?>" class="nav-link <?= ($uri->getSegment(1, 0) == $mm->url ? 'active' : null) ?>">
                        <i class="nav-icon <?= $mm->icon; ?>"></i>
                        <p>
                            <?= ucfirst($mm->nama_menu); ?>

                            <?= ($mm->url == '#') ? '<i class="right fas fa-angle-left"></i>' : '' ?>

                        </p>
                    </a>

                    <?php if (!empty($db->sub_menu())) : ?>
                        <?php foreach ($db->sub_menu() as $sm) : ?>
                            <?php if ($sm->main_menu == $mm->id_menu) : ?>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item ">
                                        <a href="<?= base_url(strtolower($sm->url)) ?>" class="nav-link <?= ($uri->getSegment(1) == $sm->url ? 'active' : null) ?>">
                                            <i class="nav-icon far fa-circle text-warning"></i>
                                            <p>
                                                <?= ucfirst($sm->nama_menu) ?>
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                            <?php endif ?>
                        <?php endforeach ?>
                    <?php endif ?>
                </li>

            <?php endforeach ?>
            <li class="nav-header">Extra
            </li>
            <li class="nav-item">
                <a href="<?= site_url('auth/keluar') ?>" class="nav-link keluar">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>Keluar</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('auth/locked/' . session()->get('userId')) ?>" class="nav-link">
                    <i class="nav-icon fas fa-lock"></i>
                    <p>Kunci </p>
                </a>
            </li>
        </ul>
    </nav>

    <!-- /.sidebar-menu -->
</div>

<script>
    $(document).ready(function() {
        $(".keluar").click(function(e) {
            e.preventDefault();
            let href = $(this).attr('href');
            let notif = confirmAlert('', 'Apakah anda yakin ingin keluar aplikasi?', 'YA');
            notif.then((result) => {
                if (result.value) {
                    location.href = href;
                }
            });
        })
    });
</script>