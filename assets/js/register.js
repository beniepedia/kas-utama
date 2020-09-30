$(document).ready(function () {
  let Form = $("#form-register");

  Form.validate({
    rules: {
      nama: {
        required: true,
        minlength: 5,
      },
      email: {
        required: true,
        email: true,
        remote: {
          url: "auth/email_cek",
          type: "post",
          data: {
            email: function () {
              return $("#email").val();
            },
          },
        },
      },
      password: {
        required: true,
        minlength: 6,
      },
      passconf: {
        required: true,
        equalTo: "#password",
      },
      terms: {
        required: true,
      },
    },
    messages: {
      nama: {
        required: "Nama lengkap tidak boleh kosong.",
        minlength: "Panjang nama minimal {5} karakter.",
      },
      email: {
        required: "Email tidak boleh kosong.",
        email: "Format email salah.",
        remote:
          "Email sudah terdaftar. coba menggunakan email lain atau <a href='login'><b>Login</b></a>",
      },
      password: {
        required: "Password tidak boleh kosong.",
        minlength: "Panjang password minimal {6} karakter.",
      },
      passconf: {
        required: "Konfirmasi password tidak boleh kosong.",
        equalTo: "Konfirmasi password harus sama dengan password.",
      },
      terms: {
        required: "Klik setuju jika anda setuju.",
      },
    },
    errorElement: "span",
    errorPlacement: function (error, element) {
      error.addClass("invalid-feedback");
      element.closest(".input-group").append(error);
      element.closest(".icheck-primary").append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass("is-invalid");
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass("is-invalid");
    },
    submitHandler: function () {
      $.ajax({
        url: Form.attr("action"),
        method: "post",
        dataType: "json",
        data: Form.serialize(),
        beforeSend: function () {
          $("button[type=submit]").html(
            '<i class="fas fa-spinner fa-spin"></i>'
          );
          $("button[type=submit]").prop("disabled", true);
        },
        success: function (respon) {
          if (respon.status == "success") {
            Swal.fire({
              icon: "success",
              title: "Registrasi berhasil!",
              html: respon.msg,
              showConfirmButton: true,
            }).then((result) => {
              if (result.value) {
                location.href = "/login";
              }
            });
          } else {
            Form.trigger("reset");
            Swal.fire({
              icon: "error",
              title: "Registrasi Gagal!",
              text: respon.msg,
              showConfirmButton: true,
            });
          }
        },
        complete: function (respon) {
          Form.trigger("reset");
          Form.children().eq(0).val(respon.responseJSON.token);
          $("button[type=submit]").html("Register");
          $("button[type=submit]").prop("disabled", false);
        },
        error: function () {
          $(".error").html(`<div class="alert alert-danger text-center alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <small>Terjadi kesalah pada sistem kami. silahkan ulangi beberapa sat lagi.</small>
      </div>`);
        },
      });
    },
  });
});
