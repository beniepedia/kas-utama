$(document).ready(function () {
    let Form = $("#form-lupa-password");
    Form.validate({
        rules: {
            email: {
                required: true,
                email: true,

            }
        },
        messages: {
            email: {
                required: "Masukan email terlebih dahulu.",
                email: "Format email tidak sesuai",
            }
        },
        errorElement: "span",
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            element.closest(".input-group").append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid");
            $(".error").text("");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass("is-invalid");
        },
        submitHandler: function () {
            $.ajax({
                url: Form.attr('action'),
                method: 'post',
                dataType: 'json',
                data: Form.serialize(),
                beforeSend: function () {
                    $("button[type=submit]").html('<i class="fas fa-spinner fa-spin"></i>&nbsp;&nbsp;Silahkan tunggu');
                    $("button[type=submit]").attr('disabled', true);
                },
                success: function (respon) {

                    if (respon.error === 0) {
                        var notify = notif('success', 'Berhasil!', respon.msg, true, false);
                        notify.then((result) => {
                            if (result.value) {
                                location.href = '/login';
                            }
                        })
                    }
                    else if (respon.error === 1) {

                        $(".error").text(respon.msg);

                    }
                    else if (respon.error === 2) {
                        var notify = notif('error', 'Opps. Error!', respon.msg, true, false);
                        notify.then((result) => {
                            if (result.value) {
                                location.href = '/login';
                            }
                        })
                    }
                },
                complete: function (respon) {
                    Form.trigger('reset');
                    Form.children().eq(0).val(respon.responseJSON.token);
                    $("button[type=submit]").html('Reset password');
                    $("button[type=submit]").attr('disabled', false);
                },
                error: function () {
                    $(".error").text('Maaf, terjadi kesalahan pada sistem.');
                },
            })
        }
    });
});

$(document).ready(function () {
    let Form = $("#reset-password");

    Form.validate({
        rules: {
            password: {
                required: true,
                minlength: 6,
            },
            passconf: {
                required: true,
                equalTo: '#password',
            }
        },
        messages: {
            password: {
                required: "Kata sandi baru tidak boleh kosong.",
                minlength: "Kata sandi minimal {0} karakter",
            },
            passconf: {
                required: "konfirmasi kata sandi tidak boleh kosong.",
                equalTo: "Konfimasi kata sandi dan sandi baru tidak sama.",
            }
        },
        errorElement: "span",
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            element.closest(".input-group").append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid");
            $(".error").text("");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass("is-invalid");
        },
        submitHandler: function () {
            let before = [
                $("button[type=submit]").attr('disabled', true),
                $("button[type=submit]").html('<i class="fas fa-spinner fa-spin"></i>&nbsp;&nbsp;Silahkan tunggu'),
            ];
            ajxPost(Form.attr('action'), Form.serialize()).done((respon) => {
                if (respon.status == 'success') {
                    let notify = notif('success', 'Sukses...!!!', respon.msg, true, false);
                    notify.then((result) => {
                        if (result.value) {
                            location.href = '/login';
                        }
                    })
                }

                $("button[type=submit]").attr('disabled', false);
                $("button[type=submit]").html('Setel ulang kata sandi');
            }).always((respon) => {
                Form.children().eq(0).val(respon.token);
            }).fail((e) => {
                Form.trigger('reset');
                $("button[type=submit]").attr('disabled', false);
                $("button[type=submit]").html('Setel ulang kata sandi');
                $(".error").text("Maaf, Terjadi kesalahan pada sistem kami.");
            });
        }
    })


});