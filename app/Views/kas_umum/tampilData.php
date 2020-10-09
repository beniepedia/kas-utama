<?php
// $saldo = $pemasukan['jumlah'] - $pengeluaran['jumlah'];
?>
<div class="row mb-3">
    <div class="col">
        <button class="btn btn-primary btn-sm float-right tambah elevation-2"> <i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Data</button>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-success"><i class="fas fa-dollar-sign"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Total Pemasukan</span>
                <span class="info-box-number"><?= indo_currency($total->total_kas_masuk) ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-danger"><i class="fas fa-dollar-sign"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Total Pengeluaran</span>
                <span class="info-box-number"><?= indo_currency($total->total_kas_keluar) ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-info"><i class="fas fa-wallet"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Total Saldo</span>
                <span class="info-box-number"><?= indo_currency($total->total_kas_masuk - $total->total_kas_keluar) ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
</div>

<div class="card ">
    <div class="card-header">
        <h5 class="card-title">Daftar Transaksi</h5>
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
        <table class="table table-hover table-bordered text-center" id="tabel-kas-masuk">
            <thead class="bg-gray">
                <tr>
                    <th>No</th>
                    <th>Kode Transaksi</th>
                    <th>Tanggal</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                    <th>Jenis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($kas as $kas) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $kas->kode_kas_umum ?></td>
                        <td><?= indo_date($kas->tanggal) ?></td>
                        <td><?= indo_currency($kas->masuk) ?></td>
                        <td><?= indo_currency($kas->keluar) ?></td>
                        <td>
                            <?php if ($kas->jenis_kas == "M") : ?>
                                <i class="fas fa-angle-double-up text-success" data-toggle="tooltip" data-placement="auto" title="Kas masuk" style="cursor: pointer;"></i>
                            <?php else : ?>
                                <i class="fas fa-angle-double-down text-danger" data-toggle="tooltip" data-placement="auto" title="Kas keluar" style="cursor: pointer;"></i>
                            <?php endif ?>
                        </td>
                        <td>
                            <a href="javascript:void(0)" class="text-warning edit" data-id="<?= $kas->kode_kas_umum ?>"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                            <a href="javascript:void(0)" class="text-danger delete" data-id="<?= $kas->kode_kas_umum ?>"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(function() {
        $('#tabel-kas-masuk').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        <?php $uri = \Config\Services::uri(); ?>

        $("#tabel-kas-masuk").on('click', '.delete', function(e) {
            e.preventDefault();
            const conf = confirmAlert('Anda Yakin?', 'Apakah anda yakin ingin menghapus data ini?', 'Ya, Hapus!');
            conf.then((result) => {
                if (result.value) {
                    const data = {
                        'id': $(this).attr('data-id')
                    };
                    const before = [
                        $(this).html('<i class="fas fa-spinner fa-spin"></i>')
                    ];
                    ajxPost("<?= base_url($uri->getSegment(1, 0) . '/hapus') ?>", data, before).done((response) => {
                        console.log(response);
                        if (response.status === 1) {
                            mini_notif('success', 'Data berhasil dihapus.');
                            loadData();
                        } else {
                            mini_notif('error', 'Data gagal dihapus.');
                        }
                        $(this).html('<i class="fas fa-trash text-danger"></i>');
                    })
                }
            })
        });

        $("#tabel-kas-masuk").on('click', '.edit', function(e) {
            e.preventDefault();
            const data = {
                id: $(this).attr('data-id')
            };
            ajxPost('<?= site_url($uri->getSegment(1, 0) . '/formModalUbah') ?>', data).done(function(respon) {
                $(".modal_view").html(respon.view).show();
                $("#modal-form").modal('show');
            }).fail((e) => {
                alert(e.responseText);
            });
        });

        $(".tambah").click(function(e) {
            e.preventDefault();
            ajxGet('<?= site_url($uri->getSegment(1, 0) . '/formModalTambah') ?>').done(function(respon) {
                $(".modal_view").html(respon.view).show();
                $("#modal-form").modal('show');
            }).fail((e) => {
                alert(e.responseText);
            });
        });
    });
</script>