<?php


$db = new \App\Models\settingModel();
$userDB = new \App\Models\penggunaModel();
$setting = $db->setting();

$userData = $userDB->where('status', 0)->findAll();

$userBaru = count($userData);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?= csrf_meta(); ?>
    <title> <?= strtoupper($setting->nama_app); ?> | <?= (isset($title) ? $title : null) ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/icheck-bootstrap/icheck-bootstrap.css">
    <!-- pace-progress -->
    <!-- <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/pace-progress/themes/black/pace-theme-flat-top.css"> -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/pace-progress/themes/blue/pace-theme-minimal.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Datepicker -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
    <!-- adminlte-->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/adminlte.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/sweetalert2/sweetalert2.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/ekko-lightbox/ekko-lightbox.css">
    <!-- Bootstrap file input -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/bootstrap-fileinput/css/fileinput.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/bootstrap-fileinput/themes/explorer-fas/theme.css">
    <!-- Croppie JS -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/croppie/css/croppie.css">
    <!-- jQuery -->
    <script src="<?= base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Admin JS -->
    <script src="<?= base_url('assets') ?>/js/admin.js"></script>
    <!-- jQuery Confirm -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/jquery-confirm/css/jquery-confirm.min.css">
    <script src="<?= base_url('assets') ?>/plugins/jquery-confirm/js/jquery-confirm.min.js"></script>
    <!-- jquery mask -->
    <script src="<?= base_url('assets') ?>/plugins/jquery-mask/dist/jquery.mask.min.js"></script>

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini pace-danger layout-fixed">

    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light elevation-1">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="../../index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <?php if (session()->get('userLevelId') == 1) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning navbar-badge">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> 4 new messages
                                <span class="float-right text-muted text-sm">3 mins</span>
                            </a>
                            <?php if ($userBaru > 0) : ?>
                                <div class="dropdown-divider"></div>
                                <a href="<?= base_url('anggota') ?>" class="dropdown-item">
                                    <i class="fas fa-users mr-2"></i>
                                    <div class="badge badge-primary"><?= $userBaru; ?>
                                    </div>&nbsp;&nbsp;Anggota baru
                                </a>
                            <?php endif; ?>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i> 3 new reports
                                <span class="float-right text-muted text-sm">2 days</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                        </div>
                    </li>
                <?php endif ?>
                <!-- <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>

                </li> -->
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= site_url() ?>" class="brand-link elevation-2">
                <img src="<?= base_url('writable/uploads/logo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><?= strtoupper($setting->nama_app); ?></span>
            </a>

            <!-- Sidebar -->
            <?php echo $this->include('layouts/sidebar') ?>
            <!-- /.sidebar -->
        </aside>
        <div class="content-wrapper">
            <?php echo $this->include('layouts/breadcrumb') ?>

            <!-- Content Wrapper. Contains page content -->
            <?php echo $this->renderSection('content') ?>
            <!-- /.content-wrapper -->
        </div>
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.0.5
            </div>
            <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->


    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- pace-progress -->
    <script src="<?= base_url('assets') ?>/plugins/pace-progress/pace.min.js"></script>
    <!-- DataTables -->
    <script src="<?= base_url('assets') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- Select2 -->
    <script src="<?= base_url('assets') ?>/plugins/select2/js/select2.full.min.js"></script>
    <!-- jQUery Validate -->
    <script src="<?= base_url('assets') ?>/plugins/jquery-validate/js/jquery-validate.min.js"></script>
    <!-- Ekko Lightbox -->
    <script src="<?= base_url('assets') ?>/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
    <!-- Croppie JS -->
    <script src="<?= base_url('assets') ?>/plugins/croppie/js/croppie.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/croppie/js/exif.js"></script>
    <!-- daterangepicker -->
    <script src="<?= base_url('assets') ?>/plugins/moment/moment.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= base_url('assets') ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?= base_url('assets') ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- Bootstrap File Input -->
    <script src="<?= base_url('assets') ?>/plugins/bootstrap-fileinput/js/plugins/piexif.js" type="text/javascript"></script>
    <script src="<?= base_url('assets') ?>/plugins/bootstrap-fileinput/js/plugins/sortable.js" type="text/javascript"></script>
    <script src="<?= base_url('assets') ?>/plugins/bootstrap-fileinput/js/fileinput.js" type="text/javascript"></script>
    <script src="<?= base_url('assets') ?>/plugins/bootstrap-fileinput/themes/fas/theme.js" type="text/javascript"></script>
    <script src="<?= base_url('assets') ?>/plugins/bootstrap-fileinput/themes/explorer-fas/theme.js" type="text/javascript"></script>
    <script src="<?= base_url('assets') ?>/plugins/bootstrap-fileinput/js/locales/id.js" type="text/javascript"></script>
    <!-- SweetAlert2 -->
    <script src="<?= base_url('assets') ?>/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <!-- ChartJS -->
    <script src="<?= base_url('assets') ?>/plugins/chart.js/Chart.min.js"></script>
    <!-- Highchart -->
    <script src="<?= base_url('assets') ?>/plugins/highchart/highcharts.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/highchart/exporting.js"></script>
    <!-- Datepicker -->
    <script src="<?= base_url('assets') ?>/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.id.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets') ?>/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url('assets') ?>/js/demo.js"></script>


</body>

</html>