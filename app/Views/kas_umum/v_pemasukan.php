<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>
<?php helper('fungsi') ?>
<style>
    /* table .btn {
        border: none;
    } */
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pemasukan</h1>
                </div>
                <div class="col-sm-6">
                    <a href="/pemasukan/tambah" class="btn btn-primary btn-sm float-right"> <i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Data</a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php if (session()->getFlashdata('notif')) : ?>
                <div class="alert alert-<?= session()->getFlashdata('notif')['type'];  ?> alert-dismissible notif">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-info"></i> <?= session()->getFlashdata('notif')['title'] ?></h5>
                    <?= session()->getFlashdata('notif')['pesan'] ?>
                </div>
            <?php endif ?>
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card">
                        <div class="card-header">
                            <div class="text-right">
                                <h5>Total Kas Masuk</h5>
                                <h5 class="font-weight-bold"><?= $total ?></h5>
                                <!-- <?= ($total != null ? indo_currency(array_sum($total)) : 'Rp. 0') ?> -->
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover " id="tabel-kas-masuk">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode KAS</th>
                                        <th>Tanggal</th>
                                        <th>kategori</th>
                                        <th style="width: 30%;">Keterangan</th>
                                        <th>Jumlah (Rp)</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($kasMasuk as $kas) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $kas['kode_kas_umum'] ?></td>
                                            <td><?= date('d/m/Y', strtotime($kas['tanggal'])) ?></td>
                                            <td><?= $kas['nama_kategori'] ?></td>
                                            <td><?= $kas['keterangan'] ?></td>
                                            <td><?= indo_currency($kas['jumlah']) ?></td>
                                            <td>
                                                <form action="/pemasukan/hapus" method="post">
                                                    <?php csrf_field() ?>
                                                    <input type="hidden" name="id" value="<?= $kas['kode_kas_umum'] ?>">
                                                    <a href="/pemasukan/ubah/<?= $kas['kode_kas_umum'] ?>" class="btn text-warning"><i class="fas fa-edit"></i></a>
                                                    <button type="submit" class="btn" name="delete" onclick="return confirm('Anda yakin ingin hapus data ini?')"><i class="fas fa-trash text-danger"></i></button>
                                                </form>
                                                <!-- <i class="fas fa-eye"></i> -->
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                                <!-- <tfoot class="">
                                    <th colspan="4" class=" text-right">Total Kas Masuk</th>
                                    <th colspan="2" class=" text-success"></th>
                                </tfoot> -->
                            </table>
                        </div>

                    </div>
                    <!-- /.card -->
                </div>
            </div> <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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
    });
</script>

<?= $this->endSection() ?>