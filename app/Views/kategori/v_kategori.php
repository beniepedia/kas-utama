<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>
<style>
    /* table .btn {
        border: none;
    } */
</style>
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
                            <?= csrf_field(); ?>
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
                    <div class="card-body kategori-data">

                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div> <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<script>
    function loadData() {

        const before = [
            $(".kategori-data").html('<h4 class="text-center"><i class="fas fa-spinner fa-spin"></i>&nbsp;&nbsp;Loading data...</h4>')
        ];
        ajxGet('<?= site_url('/kategori/loadData') ?>', before).done((response) => {
            $(".kategori-data").html(response.data);
        }).fail(() => {
            $(".kategori-data").html('<h5 class="text-center text-danger">Gagal mengambil data...</h5>');
        });
    }


    $(function() {
        loadData();

        let Form = $("#form-add");
        Form.validate({
            rules: {
                kategori: {
                    required: true,
                    minlength: 3
                },
            },
            messages: {
                kategori: {
                    required: 'Nama kategori tidak boleh kosong.',
                    minlength: 'Nama kategori minimal {0} karakter'
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
            },
            submitHandler: function() {
                const btn = $('button[name=addkategori]');
                const before = [
                    btn.attr('disable', 'disabled'),
                    btn.html('<i class="fas fa-spinner fa-spin"></i>&nbsp;&nbsp;Menyimpan...'),
                ];
                const data = $("#form-add").serialize()
                ajxPost(Form.attr('action'), data, before).done((response) => {
                    Form.children().eq(0).val(response.token);
                    if (response.proses === 'simpan') {
                        if (response.status > 0) {
                            notif('success', 'Sukses!', 'Data berhasil ditambah!', true);
                            loadData();
                        } else {
                            notif('error', 'Oops!', 'Data gagal ditambah!', true);
                        }
                    } else if (response.proses === 'update') {
                        if (response.status > 0) {
                            notif('success', 'Sukses!', 'Data berhasil diupdate!', true);
                            loadData();
                            resetForm();
                        } else {
                            notif('error', 'Oops!', 'Data gagal diupdate!', true);
                        }
                    }
                    btn.removeAttr('disable', 'disabled');
                    btn.html('<i class="fas fa-save"></i>&nbsp;&nbsp;Simpan');
                    $("#form-add").trigger('reset');
                });
            }
        });
    });
</script>
<script>

</script>
<?= $this->endSection() ?>