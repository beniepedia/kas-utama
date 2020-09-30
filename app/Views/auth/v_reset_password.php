<?php echo $this->include('auth/header') ?>

<body class="hold-transition lockscreen">
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">
        <!-- User name -->
        <div class="lockscreen-name mt-3">Setel ulang kata sandi</div>
        <!-- START LOCK SCREEN ITEM -->
        <div class="lockscreen-item px-3 ">
            <!-- lockscreen credentials (contains the form) -->
            <div class="py-2 text-muted">

            </div>
            <form action="<?= site_url('auth/reset_password') ?>" id="reset-password" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="id" value="<?= $id; ?>">
                <div class="input-group">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Masukan kata sandi baru">
                </div>
                <div class="input-group">
                    <input type="password" class="form-control" name="passconf" placeholder="Masukan konfirmasi kata sandi">
                </div>
                <small class="text-danger error"></small>
                <div class="py-3 text-center">
                    <button type="submit" class="btn btn-sm btn-primary">Setel ulang kata sandi</button>
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