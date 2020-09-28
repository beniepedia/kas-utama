<div class="row mt-3">
    <div class="col-md-12">
        <form action="<?= base_url(service('uri')->getSegment(1) . '/ganti_password') ?>" id="form-password">
            <?= csrf_field() ?>
            <div class="form-group row">
                <label for="passLama" class="col-sm-4 col-form-label">Password Lama</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" name="passLama" id="passLama" placeholder="Masukkan password lama">
                </div>
            </div>
            <div class="form-group row">
                <label for="passBaru" class="col-sm-4 col-form-label">Password Baru</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" name="passBaru" id="passBaru" placeholder="Masukkan password baru">
                </div>
            </div>
            <div class="form-group row">
                <label for="passConf" class="col-sm-4 col-form-label">Konfirmasi Password</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" name="passConf" id="passConf" placeholder="Masukkan konfirmasi password">
                </div>
            </div>

            <div class="form-group float-right">
                <button type="reset" class="btn btn-danger btn-sm batal"><i class="fas fa-times"></i> Batal</button>
                <button type="submit" class="btn btn-success btn-sm simpan"><i class="fas fa-save"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    $("#form-password").validate({
        rules: {
            passLama: {
                required: true,
                remote: {
                    url: '<?= base_url(service('uri')->getSegment(1) . '/password_cek') ?>',
                    type: "post",
                    data: {
                        passLama: function() {
                            return $("#passLama").val();
                        }
                    }
                }
            },
            passBaru: {
                required: true,
                // minlength: 6,
                remote: {
                    url: '<?= base_url(service('uri')->getSegment(1) . '/password_cek') ?>',
                    type: "post",
                    data: {
                        passBaru: function() {
                            return $("#passBaru").val();
                        }
                    }
                }
            },
            passConf: {
                required: true,
                equalTo: "#passBaru",
            },
        },
        messages: {
            passLama: {
                required: "Password lama tidak boleh kosong.",
                remote: "Password lama salah. silahkan coba lagi."
            },
            passBaru: {
                required: "Password baru tidak boleh kosong.",
                minlength: "Password minimal harus {0} karakter.",
                remote: "Password baru tidak boleh sama dengan password sebelumnya."
            },
            passConf: {
                required: "Konfirmasi password tidak boleh kosong.",
                equalTo: "Konfirmasi password tidak sama dengan password baru."
            }
        },
        errorElement: "span",
        errorPlacement: function(error, element) {
            error.addClass("invalid-feedback");
            element.closest('.form-group .col-sm-8').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
            $(element).removeClass('is-valid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
            $(element).addClass('is-valid');
        },
        submitHandler: function() {
            const formChange = $("#form-password");
            const before = [
                formChange.find("button[type=submit]").html('<i class="fas fa-spinner fa-spin"></i>&nbsp;&nbsp;Menyimpan...'),
                formChange.find("button[type=submit]").attr('disabled', true),
            ];
            ajxPost(formChange.attr("action"), formChange.serialize(), before).done((respon) => {
                formChange.find("button[type=submit]").html('<i class="fas fa-save"></i>&nbsp;&nbsp;Simpan');
                formChange.find("button[type=submit]").attr('disabled', false);
                if (respon.error == 0) {
                    const notife = notif('success', 'Berhasil', respon.msg, true, false);
                    notife.then((result) => {
                        if (result.value) {
                            window.location = "<?= base_url('auth/keluar'); ?>";
                        }
                    })
                } else {
                    const notif = notif('error', 'Gagal', respon.msg, true, false);
                }
            });
        }
    });
</script>