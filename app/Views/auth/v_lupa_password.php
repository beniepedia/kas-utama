<?php echo $this->include('auth/header') ?>

<body class="hold-transition lockscreen">
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">
        <!-- User name -->
        <div class="lockscreen-name mt-3">Lupa password</div>
        <!-- START LOCK SCREEN ITEM -->
        <div class="lockscreen-item px-3">
            <!-- lockscreen credentials (contains the form) -->
            <div class="py-2 text-muted">
                <small>
                    Link ubah password akan dikirim melalui email.
                </small>
            </div>
            <form action="<?= site_url('auth/lupa_password') ?>" id="form-reset" method="post">
                <div class="input-group">
                    <input type="text" class="form-control" name="email" placeholder="Masukan email kamu">
                </div>
                <small class="text-danger error"></small>
                <div class="py-3 text-center">
                    <button type="submit" class="btn btn-sm btn-primary">Reset password</button>
                </div>
            </form>
            <!-- /.lockscreen credentials -->
        </div>
        <!-- /.lockscreen-item -->
        <div class="help-block text-center">
            <a href="<?= site_url('/login') ?>" class="text-muted"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Kembali</a>
        </div>

    </div>
    <!-- /.center -->

    <script src="<?= base_url('assets') ?>/js/resetpassword.js"></script>

    <?php echo $this->include('auth/footer') ?>