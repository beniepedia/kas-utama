function ajxPost(url, data, before = null) {
  return $.ajax({
    url: url,
    dataType: "json",
    method: "post",
    data: data,
    beforeSend: function () {
      before;
    },
  });
}

function ajxGet(url, before = null) {
  return $.ajax({
    url: url,
    dataType: "json",
    method: "GET",
    beforeSend: function () {
      before;
    },
  });
}

function notif(type, title, pesan, buttonShow = false, timer = 3000) {
  return Swal.fire({
    icon: type,
    title: title,
    text: pesan,
    showConfirmButton: buttonShow,
    timer: timer,
  });
}

function confirmAlert(title, pesan, confirmBtn) {
  return Swal.fire({
    title: title,
    html: pesan,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: confirmBtn,
  });
}

function mini_notif(icon, title, timer = 3000) {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: timer,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  });

  return Toast.fire({
    icon: icon,
    title: title,
  });
}
