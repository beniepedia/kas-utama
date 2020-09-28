<?php echo $this->extend('layouts/template') ?>
<?php echo $this->section('content') ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ubah Data Pemasukan</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-purple">
                        <!-- form start -->
                        <form role="form" action="<?= base_url('pemasukan/ubah') ?>" method="post" id="form-kas">
                            <?= csrf_field() ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Tanggal :</label>
                                    <input type="date" class="form-control" name="tanggal" value="<?= $kas['tanggal'] ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="">Kategori :</label>
                                    <select name="kategori" class="select2bs4" style="width: 100%;">
                                        <option value="" disabled selected>Pilih kategori</option>
                                        <?php foreach ($kategori as $k) : ?>
                                            <option value="<?= $k['id_kategori'] ?>" <?= ($kas['id_kategori'] == $k['id_kategori'] ? 'selected' : null) ?>><?= ucfirst(($k['nama_kategori'])) ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="">Jumlah (Rp)</label>
                                    <input type="text" name="jumlah" class="form-control" value="<?= $kas['jumlah'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Keterangan :</label>
                                    <textarea name="keterangan" cols="10" rows="3" class="form-control"><?= $kas['keterangan'] ?></textarea>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" name="tambahkas" class="btn btn-primary btn-sm float-right">Tambah&nbsp;&nbsp;<i class="fas fa-paper-plane"></i></button>
                            </div>
                        </form>
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<script>
    $(function() {
        $("#form-kas").validate({
            rules: {
                tanggal: {
                    required: true,
                },
                kategori: {
                    required: true,


                },
                jumlah: {
                    required: true,
                    digits: true,
                },
                keterangan: {
                    required: true,
                    minlength: 10,
                },
            },
            messages: {
                tanggal: {
                    required: "Tanggal tidak boleh kosong.",
                },
                kategori: {
                    required: "Pilih kategori.",
                },
                jumlah: {
                    required: "Masukan jumlah KAS masuk.",
                    digits: "Masukan hanya angka."
                },
                keterangan: {
                    required: "Isi keterangan sumber pemasukan KAS.",
                    minlength: 'Isi minimal 5 karakter'
                }
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                error.addClass("invalid-feedback");
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
                $(element).addClass('is-valid');
            }
        });

    });
</script>

<?php echo $this->endSection() ?>