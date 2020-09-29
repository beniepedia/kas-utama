<?php echo $this->include('auth/header') ?>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="<?= site_url(); ?>"><b><?= explode(' ', strtoupper($db->setting()->nama_app))[0]; ?></b><?= explode(' ', strtoupper($db->setting()->nama_app))[1]; ?></a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Daftar keanggotaan baru</p>

                <form action="<?= base_url('auth/register') ?>" method="post" id="form-register">

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" id="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Konfirmasi Password" name="passconf">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label for="agreeTerms">
                                    <small>Saya meyetujui <a href="#">ketentuan</a></small>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-sm btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <!-- <div class="social-auth-links text-center">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i>
                        Sign up using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i>
                        Sign up using Google+
                    </a>
                </div> -->

                <a href="<?= base_url('login') ?>" class="text-center">Login</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->


    <script src="<?= base_url('assets'); ?>/js/register.js"></script>
    <?php echo $this->include('auth/footer') ?>