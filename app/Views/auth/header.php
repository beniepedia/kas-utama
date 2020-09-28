<?php
$uri = service('uri')->getSegments();


switch (count($uri)) {
    case 0:
        $url = "login";
        break;

    case 1:
        $url = service('uri')->getSegment(1);
        break;
    case 2:
        $url = service('uri')->getSegment(2);
        break;
    default:
        $url = "";
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= strtoupper($db->setting()->nama_app); ?> | <?= str_replace('-', ' ', ucfirst($url)) ?> </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/icheck-bootstrap/icheck-bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/adminlte.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/sweetalert2/sweetalert2.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- jQuery -->
    <script src="<?= base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Admin JS -->
    <script src="<?= base_url('assets') ?>/js/admin.js"></script>
</head>