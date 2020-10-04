<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>
<?php $uri = \Config\Services::uri(); ?>
<style>
    /* table .btn {
        border: none;
    } */
</style>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <?php if (session()->getFlashdata('notif')) : ?>
            <div class="alert alert-<?= session()->getFlashdata('notif')['type']; ?> alert-dismissible fade show" role="alert">
                <strong><?= session()->getFlashdata('notif')['title']; ?></strong> <?= session()->getFlashdata('notif')['msg']; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif ?>
        <div class="row">
            <!-- left column -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Tambah Level</h5>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url($uri->getSegment(1) . '/proses') ?>" method="post" id="form-add-level">
                            <input type="hidden" name="idleveluser" id="idleveluser">
                            <div class="form-group">
                                <label for="kategori">Nama Level</label>
                                <input type="text" class="form-control" name="namalevel" id="namalevel" placeholder="Masukan nama level" autocomplete="off">
                            </div>
                            <button type="submit" name="addlevel" class="btn btn-primary btn-sm float-right"><i class="fas fa-save"></i>&nbsp;&nbsp;Simpan</button>
                            <button type="reset" class="btn btn-secondary btn-sm" style="display: none;"><i class="fas fa-times"></i>&nbsp;&nbsp;Batal</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <!-- general form elements -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool refresh" data-toggle="tooltip" title="Refresh" onclick="loadData()"><i class="fas fa-sync-alt"></i></button>
                        </div>
                        <h5 class="card-title">Daftar level user</h5>
                    </div>
                    <div class="card-body level-data">

                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div> <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<!-- Modal -->
<div class="modal_view">

</div>

<script>
    function loadData() {
        let container = $(".level-data");
        const before = [
            container.html('<h4 class="text-center"><i class="fas fa-spinner fa-spin"></i>&nbsp;&nbsp;Loading data...</h4>')
        ];
        ajxGet('<?= site_url($uri->getPath() . '/loadData') ?>', before).done((response) => {
            container.html(response.data);
        }).fail(() => {
            container.html('<h5 class="text-center text-danger">Gagal mengambil data...</h5>');
        });
    }


    $(function() {
        loadData();

        $("#form-add-level").validate({
            rules: {
                namalevel: {
                    required: true,
                    minlength: 3
                },
            },
            messages: {
                namalevel: {
                    required: 'Nama level tidak boleh kosong.',
                    minlength: 'Nama level minimal {0} karakter'
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
                const form = $("#form-add-level");
                const btn = $('button[name=addlevel]');
                const before = [
                    btn.prop('disabled', true),
                    btn.html('<i class="fas fa-spinner fa-spin"></i>&nbsp;&nbsp;Menyimpan...'),
                ];
                const data = form.serialize()
                ajxPost(form.attr('action'), data, before).done((response) => {
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
                    btn.prop('disabled', false);
                    btn.html('<i class="fas fa-save"></i>&nbsp;&nbsp;Simpan');
                    form.trigger('reset');
                }).fail((e) => {
                    alert(e.responseText);
                });
            }
        });
    });
</script>
<script>

</script>
<?= $this->endSection() ?>