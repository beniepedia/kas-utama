function showAlert(type, messages) {
  return `<div class="alert alert-${type} alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <div class="text-center"><small>${messages}</small></div>
        </div>`;
}

function countDown(date, messsage, id) {
  // Hitungan Mundur Waktu Dilakukan Setiap Satu Detik
  var countDownTime = setInterval(function () {
    var countDownDate = new Date(date).getTime();
    var now = new Date().getTime();
    var distance = countDownDate - now;
    // Mendapatkan Tanggal dan waktu Pada Hari ini
    //Jarak Waktu Antara Hitungan Mundur
    // Perhitungan waktu hari, jam, menit dan detik
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor(
      (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
    );
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    // Tampilkan hasilnya di elemen id = "carasingkat"
    // $('.notif').html(days + "d " + hours + "h " +
    //     minutes + " menit " + seconds + " detik ");

    $(".notif").html(
      `<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <div class="text-center"><small>${messsage}<br><b>` +
      minutes +
      ` menit ` +
      seconds +
      ` detik</b></small></div>
            </div>`
    );
    // Jika hitungan mundur selesai,
    if (distance < 0) {
      remove_attempt(id);
      clearInterval(countDownTime);
    }
  }, 1000);
  // clearInterval(countDownTime);
}

function remove_attempt(id) {
  const host = $("#form-login").attr("action");
  const url = host.replace("login", "remove_attempt");
  const before = [
    $(".notif").html(`<div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <div class="text-center"><i class="fas fa-spinner fa-spin"></i>&nbsp;&nbsp;Silahkan tunggu...</div>
            </div>`)
  ];
  ajxPost(url, { id: id }).done((respon) => {
    if (respon.error == 1) {
      localStorage.removeItem("attempt");
      $(".notif").html(`<div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <div class="text-center">${respon.msg}</div>
              </div>`);
      $("#form-login :input").prop("disabled", false);
    } else {
      $(".notif").html("");
    }
  }).fail((e) => {
    alert(e.responseText);
  });

}

function cek_attempt() {
  if (localStorage.getItem("attempt")) {
    const data = JSON.parse(localStorage.getItem("attempt"));
    $("#form-login :input").prop("disabled", true);
    countDown(data.time, data.msg, data.userId);
  }
}

$(document).ready(function () {
  cek_attempt();

  $("#form-login").validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
      },
    },
    messages: {
      email: {
        required: "Email tidak boleh kosong.",
        email: "Format email tidak sesuai.",
      },
      password: {
        required: "Password tidak boleh kosong",
      },
    },
    errorElement: "div",
    errorPlacement: function (error, element) {
      error.addClass("invalid-feedback");
      element.closest(".input-group").append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass("is-invalid");
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass("is-invalid");
    },
    submitHandler: function () {
      login();
    },
  });

  function login() {
    const form = $("#form-login");

    const before = [
      $("button[type=submit]").prop("disabled", true),
      $("button[type=submit]").html('<i class="fas fa-spinner fa-spin"></i>'),
    ];

    ajxPost(form.attr("action"), form.serialize()).done((respon) => {
      $("button[type=submit]").html(
        '<i class="fas fa-sign-in-alt"></i>&nbsp;&nbsp;Masuk'
      );
      $("button[type=submit]").prop("disabled", false);
      switch (respon.error) {
        case 0:
          $(".overlay").show();
          Swal.fire({
            title: "Login sukses!",
            html: `Hi, <b>${respon.nama}</b>. Kamu berhasil login...!!!`,
            timer: 3000,
            timerProgressBar: true,
            icon: "success",
          }).then((result) => {
            window.location = respon.link;
          });
          break;
        case 1:
          $(".notif").html(showAlert("danger", respon.msg));
          form.trigger("reset");
          break;
        case 2:
          $(".notif").html(showAlert("danger", respon.msg));
          $("input[name=password]").val("");
          break;
        case 3:
          form.trigger("reset");
          localStorage.setItem("attempt", JSON.stringify(respon));
          location.reload();
          break;
        case 4:
          $(".notif").html(showAlert("danger", respon.msg));
          form.trigger("reset");
          break;
        case 5:
          $(".notif").html(showAlert("danger", respon.msg));
          form.trigger("reset");
          break;
      }
    }).fail((e) => {
      alert(e.responseText);
      form.trigger("reset");
      $(".notif").html(`<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <div class="text-center"><small>Terjadi kesalahan pada sistem. Silahkan coba sesaat lagi</small>.</div>
                </div>`);
    });
  }
});
