<?php

$db = new App\Models\settingModel(); ?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= strtoupper($db->setting()->nama_app); ?> | Verifikasi</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/adminlte.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>

<body class="hold-transition verifikasi-page">
    <div class="verifikasi-box">
        <div class="card">
            <div class="mt-4 text-center <?= ($status == 'success' ? 'text-success' : 'text-danger') ?>" style="font-size: 80px;">
                <i class="fas fa-<?= ($status == 'success' ? 'check-circle' : 'exclamation-triangle') ?>"></i>
            </div>
            <div class="card-body verifikasi-card-body">
                <h4 class="text-center"><?= $title; ?></h4>
                <p class="text-center"><?= $pesan; ?></p>
                <div class="text-center py-3">
                    <a href="<?= base_url('login') ?>" class="btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Kembali ke login</a>
                </div>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

</body>


</html>