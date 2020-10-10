<form role="form" action="<?= $datamodal['action'] ?>" method="post" id="form-kas" autocomplete="off">
    <div class="modal fade" id="modal-form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= $datamodal['title'] ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <?php if ($datamodal['btn-name'] == 'update') : ?>
                            <div class="form-group">
                                <label for="">Kode KAS</label>
                                <input type="text" name="id" class="form-control" value="<?= ($kas['kode_kas_umum'] ? $kas['kode_kas_umum'] : null) ?>" readonly>
                            </div>
                        <?php endif ?>
                        <div class="form-group">
                            <label>Tanggal :</label>
                            <input type="text" class="form-control datepicker" name="tanggal" value="<?= (isset($kas['tanggal']) ? $kas['tanggal'] : null) ?>" />
                        </div>
                        <div class="form-group">
                            <label for="">Kategori :</label>
                            <select name="kategori" class="select2bs4" style="width: 100%;">
                                <option value="" disabled selected>Pilih kategori</option>
                                <?php foreach ($kategori as $k) : ?>
                                    <option value="<?= $k['id_kategori'] ?>" <?= (isset($kas['id_kategori']) == $k['id_kategori'] ? 'selected' : null) ?>><?= ucfirst(($k['nama_kategori'])) ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="">Jenis :</label>
                            <select name="jenis" class="select2bs4">
                                <option value="" selected disabled>Pilih jenis</option>
                                <option value="M" <?= (isset($kas['jenis_kas']) && $kas['jenis_kas'] == 'M')  ? 'selected' : null ?>>Pemasukan</option>
                                <option value="K" <?= (isset($kas['jenis_kas']) && $kas['jenis_kas'] == 'K')  ? 'selected' : null ?>>Pengeluran</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Jumlah (Rp)</label>
                            <?php if (isset($kas['jenis_kas']) && $kas['jenis_kas'] == "M") : ?>
                                <input type="text" name="jumlah" class="form-control" value="<?= $kas['masuk'] ?>">
                            <?php elseif (isset($kas['jenis_kas']) && $kas['jenis_kas'] == "K") : ?>
                                <input type="text" name="jumlah" class="form-control" value="<?= $kas['keluar'] ?>">
                            <?php else : ?>
                                <input type="text" name="jumlah" class="form-control">
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label for="">Keterangan :</label>
                            <textarea name="keterangan" cols="10" rows="3" class="form-control"><?= (isset($kas['keterangan']) ? $kas['keterangan'] : null) ?></textarea>
                        </div>

                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="<?= $datamodal['btn-name'] ?>" class="btn btn-primary btn-sm float-right"><i class="fas fa-paper-plane"></i>&nbsp;&nbsp;<?= $datamodal['btn'] ?></button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>
<!-- /.modal -->
<script>
    $(function() {
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });

        $("input[name=jumlah]").mask("#.##0", {
            reverse: true,

        });

        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            todayBtn: "linked",
            clearBtn: true,
            language: "id",
            autoclose: true
        });

        var valid = $("#form-kas").validate({
            rules: {
                tanggal: {
                    required: true,
                },
                kategori: {
                    required: true,
                },
                jumlah: {
                    required: true,
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
                },
                keterangan: {
                    required: "Isi keterangan sumber pemasukan KAS.",
                    minlength: 'Keterangan harus lebih dari {0} karakter'
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
            },
            submitHandler: function(element, errorClass, validClass) {
                const Form = $("#form-kas");
                const submitBtn = Form.find('button[type=submit]');
                const action = Form.attr('action');
                const data = Form.serialize();
                // const fn = submitBtn.html('<i class="fas fa-spinner fa-spin"></i>&nbsp;&nbsp;Memproses...');
                ajxPost(action, data).then((response) => {
                    if (response.action === 'tambah') {
                        if (response.status === 1) {
                            loadData();

                            mini_notif('success', 'Tambah data berhasil!.');
                            $("#modal-form").modal('hide');
                        } else {
                            mini_notif('error', 'Tambah data gagal.');
                        }
                    } else if (response.action === 'update') {
                        if (response.status === 1) {
                            loadData();
                            mini_notif('success', 'Ubah data berhasil!.');
                            $("#modal-form").modal('hide');
                        } else {
                            mini_notif('error', 'Ubah data gagal.');
                        }
                    }
                }).fail(() => {
                    mini_notif('error', 'Terjadi kesalahn pada sistem.');
                });
            }
        });
    });
</script>