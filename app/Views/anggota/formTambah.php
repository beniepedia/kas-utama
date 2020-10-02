<div class="row">
    <div class="col-md-6">
        <div class="card ">
            <div class="card-header">
                <h5 class="card-title">Tambah Anggota</h5>
                <div class="card-tools">
                    </button>
                    <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Perbesar" data-card-widget="maximize"><i class="fas fa-expand"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Sembunyikan" data-card-widget="remove" onclick="loadData()"><i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <form class="form-horizontal" method="post" action="<?= base_url('anggota/save') ?>" id="form-anggota">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan nama anggota">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="email" id="email" placeholder="Masukkan email anggota">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nohp" class="col-sm-3 col-form-label">No HP</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nohp" id="nohp" placeholder="Masukkan no hp anggota">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-sm-3 col-form-label">Status</label>
                            <div class="icheck-success d-inline col-sm-9">
                                <input type="checkbox" checked id="status" name="status">
                                <label for="status">
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="alamat" id="alamat"></textarea>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <button type="submit" class="btn btn-primary btn-sm float-right save"> <i class="fas fa-save"></i>&nbsp;&nbsp;Tambah</button>

                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        const Form = $("#form-anggota");

        Form.validate({
            rules: {
                nama: {
                    required: true,
                    minlength: 5
                },
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: '<?= base_url('anggota/email_cek') ?>',
                        type: "post",
                        data: {
                            email: function() {
                                return $("#email").val();
                            }
                        }
                    }
                },
            },
            messages: {
                nama: {
                    required: "Nama tidak boleh kosong.",
                    minlength: "Nama tidak boleh kurang dari {0} karakter."
                },
                email: {
                    required: "Email tidak boleh kosong.",
                    email: "Format email tidak sesuai.",
                    remote: "Email sudah terdaftar. gunakan email yang lain."
                }
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                error.addClass("invalid-feedback");
                element.closest('.col-sm-9').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function() {
                const before = [
                    $("button.save").html('<i class="fas fa-spinner fa-spin"></i>&nbsp;&nbsp;Menyimpan...'),
                    $("button.save").prop('disabled', true)
                ];
                const action = Form.attr('action');
                const data = Form.serialize();
                ajxPost(action, data).done((respon) => {
                    if (respon.status == 1) {
                        mini_notif('success', 'Anggota berhasil ditambah!');
                        $("button.save").html('<i class="fas fa-save"></i>&nbsp;&nbsp;Tambah');
                        $("button.save").prop('disabled', false);
                        Form.trigger('reset');
                    }
                }).fail(() => {
                    $("button.save").html('<i class="fas fa-save"></i>&nbsp;&nbsp;Tambah');
                    $("button.save").prop('disabled', false);
                    Form.trigger('reset');
                    notif('error', 'Gagal', 'Tambah data anggota gagal. Silahkan coba lagi atau hubungi admin!', true, false);
                });

            }
        })
    });
</script>