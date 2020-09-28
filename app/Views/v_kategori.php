<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>
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
                    <h1>Kategori</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php if (session()->getFlashdata('notif')) : ?>
                <div class="alert alert-<?= session()->getFlashdata('notif')['type'];  ?> alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-info"></i> <?= session()->getFlashdata('notif')['title'] ?></h5>
                    <?= session()->getFlashdata('notif')['pesan'] ?>
                </div>
            <?php endif ?>
            <div class="row">
                <!-- left column -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="title">Tambah Kategori</h5>
                        </div>
                        <div class="card-body">
                            <form action="/kategori/proses" method="post" id="form-add">
                                <?= csrf_field() ?>
                                <input type="hidden" name="idkategori" id="idkategori">
                                <div class="form-group">
                                    <label for="kategori">Nama Kategori</label>
                                    <input type="text" class="form-control" name="kategori" id="kategori" placeholder="Masukan nama kategori" autocomplete="off">
                                </div>
                                <button type="submit" name="addkategori" class="btn btn-primary btn-sm float-right"><i class="fas fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                <button type="reset" class="btn btn-secondary btn-sm" style="display: none;"><i class="fas fa-times"></i>&nbsp;&nbsp;Batal</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <!-- general form elements -->
                    <div class="card">
                        <div class="card-header">
                            <h5>Daftar Kategori</h5>
                        </div>
                        <div class="card-body">
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
                                                    <form action="/kategori/hapus" method="post">
                                                        <?= csrf_field() ?>
                                                        <input type="hidden" name="id" value="<?= $k['id_kategori'] ?>">
                                                        <button type="submit" onclick="return confirm('Hapus Kategori ini?')" name="deletekategori" class="btn text-danger" data-toggle="tooltip" data-placement="top" title="Hapus kategori"><i class="fas fa-trash"></i></button>
                                                        <button type="button" class="btn text-warning edit" data-id="<?= $k['id_kategori'] ?>" data-name="<?= $k['nama_kategori'] ?>" data-toggle="tooltip" data-placement="top" title="Ubah kategori"><i class="fas fa-edit"></i></button>
                                                    </form>
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
        const btnCancel = $('button[type=reset]');
        const title = $('.title');
        const inputKategori = $('#form-add input[type=text]');
        const inputId = $('#idkategori');
        $(document).on('click', '.edit', function() {
            const id = $(this).attr('data-id');
            const name = $(this).attr('data-name');
            title.text('Ubah Kategori');
            inputKategori.val(name);
            inputId.val(id);
            inputKategori.focus();
            btnCancel.show();
        });

        btnCancel.click(function() {
            title.text('Tambah Kategori');
            inputKategori.val('');
            inputId.val('');
            $(this).hide();
        });
    });
</script>
<?= $this->endSection() ?>