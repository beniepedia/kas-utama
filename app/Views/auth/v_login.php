<?php echo $this->include('auth/header') ?>


<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?= site_url(); ?>"><b><?= explode(' ', strtoupper($db->setting()->nama_app))[0]; ?></b><?= explode(' ', strtoupper($db->setting()->nama_app))[1]; ?></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="overlay" style="display: none;"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <div class="notif"></div>
                <form action="<?= base_url('auth/login_proses'); ?>" method="post" id="form-login">

                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-6">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Ingat saya
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-6 ">
                            <button type="submit" class="btn btn-primary btn-sm btn-block"> <i class="fas fa-sign-in-alt"></i>&nbsp;&nbsp;Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <!-- 
                <div class="social-auth-links text-center mb-3">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                </div> -->
                <!-- /.social-auth-links -->
                <hr>
                <p class="mb-1">
                    <a href="<?= base_url('auth/lupa-password') ?>"><small>Lupa password</small></a>
                </p>
                <p class="mb-0">
                    <a href="<?= base_url('register') ?>" class="text-center"><small>Daftar akun baru</small></a>
                </p>
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