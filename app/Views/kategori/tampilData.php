<table class="table table-hover table-sm">
    <thead>
        <tr>
            <th>No</th>
            <th style="width: 80%;">Nama Kategori</th>
            <th>Opsi</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($kategori) : ?>
            <?php $no = 1;
            foreach ($kategori as $k) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= ucfirst($k['nama_kategori']) ?></td>
                    <td>
                        <a href="javascript:void(0)" class="text-warning edit" data-id="<?= $k['id_kategori'] ?>" data-name="<?= $k['nama_kategori'] ?>" data-toggle="tooltip" data-placement="top" title="Ubah kategori"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                        <a href="javascript:void(0)" class="text-danger delete" data-toggle="tooltip" data-placement="top" title="Hapus kategori" data-id="<?= $k['id_kategori'] ?>" data-name="<?= $k['nama_kategori'] ?>"><i class="fas fa-trash-alt"></i></a>
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
        $('.title').text('Tambah Kategori');
        $('#form-add input[type=text]').val('');
        $('#idkategori').val('');
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
                html: `Anda yakin ingin menghapus kategori <b> ${name} </b> ?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '<?= base_url('kategori/hapus') ?>',
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
            $('.title').text('Ubah Kategori');
            $('#form-add input[type=text]').val(name).focus();
            $('#idkategori').val(id);
            $('button[type=reset]').show();
        });

        $('button[type=reset]').click(function() {
            resetForm();
        });
    });
</script>