<?php $uri = \Config\Services::uri(); ?>
<table class="table table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th style="width: 80%;">Nama Level User</th>
            <th>Opsi</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($level) : ?>
            <?php $no = 1;
            foreach ($level as $l) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= ucfirst($l['nama_level']) ?></td>
                    <td>
                        <a href="javascript:void(0)" class="text-info lihat" data-id="<?= $l['id_level_user'] ?>" data-toggle="tooltip" data-placement="top" title="Lihat detail akses"><i class="fas fa-eye"></i></a>&nbsp;&nbsp;
                        <a href="javascript:void(0)" class="text-warning edit" data-id="<?= $l['id_level_user'] ?>" data-name="<?= $l['nama_level'] ?>" data-toggle="tooltip" data-placement="top" title="Ubah nama level"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                        <a href="javascript:void(0)" class="text-danger delete" data-toggle="tooltip" data-placement="top" title="Hapus level user" data-id="<?= $l['id_level_user'] ?>" data-name="<?= $l['nama_level'] ?>"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
            <?php endforeach ?>
        <?php else : ?>
            <tr>
                <td colspan="3" align="center">Tidak ada data</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<script>
    function resetForm() {
        $('.title').text('Tambah Level');
        $('#form-add-level input[type=text]').val('');
        $('#idleveluser').val('');
        $('button[type=reset]').hide();
    }

    $(document).ready(function() {
        $(".delete").click(function(e) {
            e.preventDefault();
            const id = $(this).attr('data-id');
            const name = $(this).attr('data-name');
            const btn = $(this);
            Swal.fire({
                title: 'Yakin?',
                html: `Anda yakin ingin menghapus data level <b> ${name} </b> ?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '<?= base_url($uri->getSegment(1) . '/hapus') ?>',
                        dataType: 'json',
                        method: 'post',
                        data: {
                            id: id
                        },
                        beforeSend: function() {
                            btn.html('<i class="fas fa-spinner fa-spin"></i>');
                        },
                        success: function(response) {
                            if (response > 0) {
                                notif('success', 'Berhasil!', 'Data berhasil dihapus!', true);
                                loadData();
                                resetForm();
                            } else {
                                notif('error', 'Oops!', 'Data gagal dihapus!', true);
                            }
                        },
                        complete: function() {

                            btn.html('<i class="fas fa-trash-alt"></i>');
                        }
                    });
                }
            })
        });

        $(document).on('click', '.edit', function() {
            const id = $(this).attr('data-id');
            const name = $(this).attr('data-name');
            $('.title').text('Ubah level');
            $('#form-add-level input[type=text]').val(name).focus();
            $('#idleveluser').val(id);
            $('button[type=reset]').show();
        });

        $('button[type=reset]').click(function() {
            resetForm();
        });
    });


    $(document).ready(function() {
        $(".lihat").click(function() {
            let url = "<?= base_url($uri->getSegment(1) . '/form_modal') ?>";
            let id = $(this).attr('data-id');
            ajxPost(url, {
                level_user: id,
            }).done((respon) => {
                $(".modal_view").html(respon.data).show();
                $("#modal-form").modal({
                    backdrop: 'static',
                    keyboard: false
                }, 'show');
            });
        });

    });
</script>