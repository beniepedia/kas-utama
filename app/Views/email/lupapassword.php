<?= $this->include('email/header') ?>

<body itemscope itemtype="http://schema.org/EmailMessage">

    <table class="body-wrap">
        <tr>
            <td></td>
            <td class="container" width="600">
                <div class="content">
                    <table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope itemtype="http://schema.org/ConfirmAction">
                        <tr>
                            <td class="content-wrap" style="box-shadow: 0px 2px 4px rgba(0,0,0,.20)">
                                <meta itemprop="name" content="Confirm Email" />
                                <div class="logo">
                                    <img src="<?= site_url('writable/uploads/logo.png') ?>" alt="">
                                </div>
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td class="content-block" style="font-size:20px;font-weight:bold;color:#555">
                                            Hi, <?php echo $nama ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Kamu baru saja mengajukan permintaan setel ulang kata sandi. Kami akan membantu untuk menyetel ulang kata sandi kamu. <br><br>
                                            <div style="color: #999;">Gunakan tombol dibawah ini untuk mengatur ulang kata sandi kamu.</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" class="content-block" itemprop="handler" itemscope itemtype="">
                                            <a href="<?php echo base_url('reset-password?email=' . $email . '&token=' . urlencode($token)) ?>" class="btn-primary" itemprop="url">Setel ulang kata sandi</a>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            <div>Jika tombol diatas tidak berfungsi, kamu bisa klik link dibawah ini atau copy paste pada browser</div><br>
                                            <div class="link"><?php echo base_url('reset-password?email=' . $email . '&token=' . urlencode($token)) ?></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block" style="color: #999;">
                                            Abaikan pesan ini jika kamu merasa tidak melakukan pengajuan untuk mengatur ulang kata sandi anda.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block" style="font-style: italic;">
                                            &mdash; Team Verifikasi
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <div class="footer">
                        <table width="100%">
                            <tr>
                                <!-- <td class="aligncenter content-block">Follow <a href="http://twitter.com/mail_gun">@Mail_Gun</a> on Twitter.</td> -->
                            </tr>
                        </table>
                    </div>
                </div>
            </td>
            <td></td>
        </tr>
    </table>

</body>

</html>