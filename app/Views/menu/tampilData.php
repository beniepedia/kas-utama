<?= $menu ?>



<script>
    $(document).ready(function() {
        $("body").on('click', '.edit-menu', function() {
            let id = $(this).attr('id-menu');
            ajxPost('<?= base_url(service('uri')->getSegment(1) . '/modal_edit'); ?>', {
                id: id
            }).done((respon) => {
                $(".modal_edit").html(respon.view).show();
                $("#form-edit").modal('show');
            })
        });


        $("body").on('click', ".status-menu", function() {
            let id = $(this).attr('id-menu');
            let nama = $(this).attr('nama-menu');
            let status = $(this).attr('status');
            let text = '';

            if (status == 'Y') {
                text = `Anda yakin ingin menonaktifkan menu <b>${nama}</b> ?`;
            } else if (status == 'N') {
                text = `Anda yakin ingin mengaktifkan menu <b>${nama}</b> ?`;
            }
            let conf = confirmAlert('', text, 'YA!');
            conf.then((result) => {
                if (result.value) {
                    ajxPost('<?= base_url(service('uri')->getSegment(1) . '/edit_status'); ?>', {
                        id: id,
                        status: status
                    }).done((respon) => {
                        if (respon.status == 1) {
                            loadData();
                        } else {
                            mini_notif('error', 'perintah gagal!');
                        }
                    }).fail((e) => {
                        alert(e.responseText);
                    });
                }
            });
        });

        $("body").on('click', '.hapus-menu', function() {
            let id = $(this).attr('id-menu');
            let nama = $(this).attr('nama-menu');
            let conf = confirmAlert('Perhatian!', `Aapakah anda yakin ingin menghapus menu <b>${nama}</b>`, 'YA, Hapus!');

            conf.then((result) => {
                if (result.value) {
                    ajxPost('<?= base_url(service('uri')->getSegment(1) . '/hapus'); ?>', {
                        id: id
                    }).done((respon) => {
                        if (respon.status == 1) {
                            loadData();
                        } else {
                            mini_notif('error', 'perintah gagal!');
                        }
                    }).fail((e) => {
                        alert(e.responseText);
                    });
                }
            });

        });

    });
</script>