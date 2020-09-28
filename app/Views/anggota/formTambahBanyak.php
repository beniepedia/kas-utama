<div class="row">
    <div class="col-md-12">
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
                <form action="<?= base_url('anggota/save_banyak'); ?>" method="post" id="form-tambah-banyak">
                    <?= csrf_field() ?>
                    <div class="table-responsive-lg">
                        <button type="reset" class="btn btn-dark btn-flat btn-sm mb-2"><i class="fas fa-save"></i>&nbsp;&nbsp;Bersihkan</button>
                        <button type="submit" class="btn btn-primary btn-flat btn-sm mb-2"><i class="fas fa-save"></i>&nbsp;&nbsp;Simpan</button>
                        <table class="table table-hover table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No HP</th>
                                    <th>Kelamin</th>
                                    <th>Password</th>
                                    <th style="width: 110px;">Status</th>
                                    <th class="text-center"><button type="button" class="btn btn-success btn-xs tambah-row"><i class="fas fa-plus"></i></button></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" class="form-control form-control-sm" name="nama[]"></td>
                                    <td><input type="text" class="form-control form-control-sm" name="email[]"></td>
                                    <td><input type="text" class="form-control form-control-sm" name="nohp[]"></td>
                                    <td>
                                        <select name="kelamin[]" class="form-control form-control-sm">
                                            <option value="" selected disabled>Pilih jenis kelamin</option>
                                            <option value="L">Laki - Laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control form-control-sm" name="password[]"></td>
                                    <td>
                                        <select name="status[]" class="form-control form-control-sm">
                                            <option value="1">Aktif</option>
                                            <option value="0">Non Aktif</option>
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger btn-xs hapus-row"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.tambah-row').click(function() {
            var row = $(".table").find("tbody tr:last").clone().appendTo("tbody");
            row.find("input").val('');
        });

        $(document).on('click', '.hapus-row', function() {
            const trIndex = $(this).closest('tr').index();
            if (trIndex > 1 - 1) {
                $(this).closest('tr').remove();
            }
        });
    });

    $(document).ready(function() {

        $("form#form-tambah-banyak").on('submit', function(e) {
            e.preventDefault();

            $(this).find('input[name="nama[]"]').each(function() {
                $(this).rules('add', {
                    required: true
                })
            });

            $(this).find('input[name="email[]"]').each(function() {
                $(this).rules('add', {
                    required: true
                })
            });


        });

        $("#form-tambah-banyak").validate();






        // var validator = $("#form-tambah-banyak").validate({

        //     rules: {
        //         'nama[]': {
        //             required: true
        //         },
        //         'email[]': {
        //             required: true,
        //             email: true,
        //             remote: {
        //                 url: '<?= base_url('anggota/email_cek') ?>',
        //                 type: "post",
        //                 data: {
        //                     email: function() {
        //                         return $("#email").val();
        //                     }
        //                 }
        //             }
        //         },
        //         'kelamin[]': {
        //             required: true,
        //         },
        //     },
        //     messages: {
        //         'nama[]': {
        //             required: 'Nama tidak boleh kosong',
        //         },
        //         'email[]': {
        //             required: 'Email tidak boleh kosong',
        //             email: 'Format email tidak valid.',
        //             remote: 'Email sudah terdaftar.',
        //         },
        //         'kelamin[]': {
        //             required: 'Pilih jenis kelamin',
        //         },
        //     },
        //     errorElement: "span",
        //     errorPlacement: function(error, element) {
        //         error.addClass("invalid-feedback");
        //         element.closest('tbody td').append(error);
        //     },
        //     highlight: function(element, errorClass, validClass) {
        //         $(element).addClass('is-invalid');
        //     },
        //     unhighlight: function(element, errorClass, validClass) {
        //         $(element).removeClass('is-invalid');
        //     },
        //     submitHandler: function() {
        //         Swal.fire({
        //             title: 'Simpan Data ?',
        //             text: "Simpan semua data anggota ? ",
        //             icon: 'info',
        //             showCancelButton: true,
        //             cancelButtonColor: '#d33',
        //             confirmButtonText: 'Ya, Simpan!'
        //         }).then((result) => {
        //             if (result.value) {
        //                 const form = $("#form-tambah-banyak");
        //                 const before = [
        //                     $("button[type=submit]").html('<i class="fas fa-spinner fa-spin"></i>&nbsp;&nbsp;Menyimpan...'),
        //                     $("button[type=submit]").prop('disabled', true)
        //                 ];
        //                 ajxPost(form.attr('action'), form.serialize(), before).done((respon) => {
        //                     $("button[type=submit]").html('<i class="fas fa-save"></i>&nbsp;&nbsp;Simpan');
        //                     $("button[type=submit]").prop('disabled', false);
        //                     notif(respon.type, respon.title, respon.msg);
        //                     loadData();
        //                 });
        //             }
        //         })

        //     }
        // });

        $("button[type=reset]").click(function() {
            validator.resetForm();
        });
    });
</script>