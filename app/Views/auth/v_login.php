<?php echo $this->include('auth/header') ?>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?= site_url(); ?>"><b><?= strtoupper($db->setting()->nama_app); ?></b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="overlay" style="display: none;"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>
            <div class="card-body login-card-body">
                <p class="login-box-msg">silahkan masuk menggunakan email yang sudah terdaftar.</p>
                <div class="notif"></div>
                <form action="<?= base_url('auth/login'); ?>" method="post" id="form-login">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Masukan email" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Masukan kata sandi">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-6">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">
                                    Ingat saya
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-6 ">
                            <button type="submit" class="btn btn-primary btn-sm btn-block"> <i class="fas fa-sign-in-alt"></i>&nbsp;&nbsp;Masuk</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center mb-3">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                </div>
                <!-- /.social-auth-links -->
                <hr>
                <div class="col d-flex justify-content-between">
                    <a href="<?= base_url('auth/lupa-password') ?>">Lupa password</a>
                    <a href="<?= base_url('register') ?>" class="text-center ">Daftar akun baru</a>

                </div>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <script src="<?= base_url('assets'); ?>/js/login.js"></script>

    <?php if (session()->getFlashdata('pesan')) : ?>
        <script>
            $(function() {
                Swal.fire({
                    icon: 'warning',
                    title: 'Login',
                    text: '<?= session()->getFlashdata('pesan') ?>',
                    showConfirmButton: true,
                });
            });
        </script>
    <?php endif ?>

    <?php echo $this->include('auth/footer') ?>