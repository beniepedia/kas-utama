<div class="card ">
    <div class="card-header">
        <h5 class="card-title">Daftar Anggota</h5>
        <div class="card-tools">
            <button type="button" class="btn btn-tool refresh" data-toggle="tooltip" title="Refresh" onclick="loadData()"><i class="fas fa-sync-alt"></i></button>
            <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Perkecil" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Perbesar" data-card-widget="maximize"><i class="fas fa-expand"></i>
            </button>
            <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Sembunyikan" data-card-widget="remove"><i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table-bordered" id="tabel-anggota">
            <thead>
                <tr>
                    <th class="text-center">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="selectAll">
                            <label for="selectAll" class="custom-control-label"></label>
                        </div>
                    </th>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th class="text-center">Status</th>
                    <th>Level</th>
                    <th class="text-center">Aksi</th>

                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                $row = 1;
                foreach ($user as $u) : ?>
                    <tr>
                        <td class="text-center" style="width:30px;">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input selected" type="checkbox" name="id_pengguna[]" id="selected-<?= $row ?>" value="<?= $u['id_pengguna'] ?>">
                                <label for="selected-<?= $row ?>" class="custom-control-label"></label>
                            </div>
                            <!-- <input type="checkbox" class="selectId"> -->
                        </td>
                        <td><?= $no++ ?></td>
                        <td><?= $u['nama'] ?></td>
                        <td>
                            <a href="javascript:void(0)" class="detail" id="<?= $u['id_pengguna']; ?>" style="text-decoration: underline;" data-toggle="tooltip" data-placement="auto" title="Lihat detail anggota"> <?= $u['email'] ?></a>
                        </td>

                        <td class="text-center">
                            <?php
                            if ($u['status'] == 0) {
                                $color = 'secondary';
                                $text = 'Unverified';
                            } elseif ($u['status'] == 1) {
                                $color = 'success';
                                $text = 'Verified';
                            } elseif ($u['status'] == 2) {
                                $color = 'danger';
                                $text = 'Blocked';
                            }
                            ?>
                            <div class="btn-group">
                                <button type="button" class="btn btn-<?= $color ?>  btn-xs"><?= $text ?></button>
                                <button type="button" class="btn btn-<?= $color ?> btn-xs dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    <span class="sr-only">Toggle Dropdown</span>
                                    <div class="dropdown-menu" role="menu" style="z-index: 99999;">
                                        <a class="dropdown-item" href="#">Block</a>
                                    </div>
                                </button>
                            </div>

                        </td>
                        <td><?= $u['nama_level'] ?></td>
                        <td class="text-center">
                            <a href="javascript:void(0)" class="text-warning edit" data-id="<?= $u['id_pengguna'] ?>" data-name="<?= $u['nama'] ?>" data-toggle="tooltip" data-placement="top" title="Ubah kategori"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                            <a href="javascript:void(0)" class="text-danger delete" data-toggle="tooltip" data-placement="top" title="Hapus kategori" data-id="<?= $u['id_pengguna'] ?>" data-name="<?= $u['nama'] ?>"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                <?php $row++;
                endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal detail -->
<div class="modal fade show" id="modal_detail_anggota" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Anggota</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tabel-anggota').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        $("#selectAll").change(function() {
            var jumlah = $(".selected:checked").length;
            if ($(this).is(":checked")) {
                $(".selected").prop("checked", true);
                $(".hapus-semua").show();
            } else {
                $(".selected").prop("checked", false);
                $(".hapus-semua").hide();
            }

        });

        $(".selected").click(function() {
            if ($(".selected:checked").length > 1) {
                $(".hapus-semua").show();
            } else {
                $(".hapus-semua").hide();
            }

        });

        $(".detail").click(function(e) {
            e.preventDefault();
            let id = $(this).attr('id');

            ajxPost('<?= service('uri')->getSegment(1) . '/detail' ?>', {
                id: id
            }).done((data) => {
                $("#modal_detail_anggota .modal-body").html(data);
                $("#modal_detail_anggota").modal('show');
            })

        })

        $(".hapus-semua").click(function() {
            var id = $(".selected:checked").map(function() {
                return $(this).val();
            }).get().join(' ');
            var jumlah = $(".selected:checked").length;
            if (id == 0) {
                notif('info', 'Perhatian!', 'Silahkan pilih data yang ingin anda hapus.', true, 0);
            } else {
                Swal.fire({
                    title: 'Hapus Anggota',
                    html: `Apakah anda yakin menghapus ${jumlah} anggota?`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya. Hapus semua!",
                }).then((result) => {

                    if (result.value) {
                        const before = [
                            $(this).html('<i class="fas fa-spinner fa-spin"></i>&nbsp;&nbsp;Menghapus...'),
                            $(this).prop('disabled', true)
                        ];
                        ajxPost('<?= base_url('anggota/hapus_banyak') ?>', {
                            id: id
                        }, before).done((respon) => {
                            $(".hapus-semua").html('<i class="fas fa-trash-alt"></i>&nbsp;&nbsp;Hapus semua');
                            $(".hapus-semua").prop('disabled', false);
                            $(".hapus-semua").hide();
                            loadData();
                            notif(respon.type, respon.title, respon.msg, true, false);
                        })
                    }
                });
            }
        });

    });
</script>