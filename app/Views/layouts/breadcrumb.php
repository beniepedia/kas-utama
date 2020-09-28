<?php $uri = service('uri'); ?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><?= ucfirst(str_replace('-', ' ', $uri->getSegment(1, 0))); ?> </h1>
            </div>
            <?php if ($uri->getSegment(1, 0) != 'dashboard') : ?>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Beranda</a></li>
                        <li class="breadcrumb-item active"><?= ucfirst($uri->getSegment(1, 0)); ?></li>
                    </ol>
                </div>
            <?php endif ?>
        </div>
    </div><!-- /.container-fluid -->
</section>