<div class="row mt-3">
    <div class="col-md-12">
        <form action="<?= base_url(service('uri')->getSegment(1) . '/update') ?>" id="form-profile" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="form-group row">
                <label for="nama" class="col-sm-4 col-form-label">Nama Lengkap</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="nama" id="nama" value="<?= $user['nama'] ?>" disabled>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label">Email</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="email" id="email" value="<?= $user['email'] ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="nohp" class="col-sm-4 col-form-label">No Handphone</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="nohp" id="nohp" value="<?= $user['no_hp'] ?>" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label for="kelamin1" class="col-sm-4 col-form-label ">Kelamin</label>
                <div class="icheck-success  pl-2">
                    <input type="radio" name="kelamin" id="kelamin1" <?= ($user['kelamin'] == 'L' ? 'checked' : '') ?> disabled value="L">
                    <label for="kelamin1">Laki - Laki
                    </label>
                </div>
                <div class="icheck-success pl-4">
                    <input type="radio" name="kelamin" id="kelamin2" <?= ($user['kelamin'] == 'P' ? 'checked' : '') ?> disabled value="P">
                    <label for="kelamin2">Perempuan
                    </label>
                </div>
            </div>
            <div class="form-group row">
                <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                <div class="col-sm-8">
                    <textarea name="alamat" id="alamat" rows="5" class="form-control" disabled><?= $user['alamat'] ?></textarea>
                </div>
            </div>
            <div class="form-group float-right">
                <button type="button" class="btn btn-danger btn-sm batal" style="display: none;"><i class="fas fa-times"></i> Batal</button>
                <button type="submit" class="btn btn-success btn-sm simpan" style="display: none;"><i class="fas fa-save"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        const Form = $("#form-profile");
        const inputGambar = Form.find("#gambar");

        // inputGambar.fileinput({
        //     showUpload: false,
        //     previewFileType: 'any',
        //     theme: 'fas',
        //     maxFileSize: 1000,
        //     resizeImage: true,
        //     maxImageWidth: 200,
        //     maxImageHeight: 200,
        //     resizePreference: 'height',
        //     language: "id",
        //     allowedPreviewType: ['image'],
        //     allowedFileExtensions: ['jpg', 'png', 'jpeg'],
        //     dropZoneEnabled: false
        // });

        Form.validate({
            rules: {
                nama: {
                    required: true,
                    minlength: 5,
                },
                nohp: {
                    required: true,
                },
                kelamin: {
                    required: true,
                }
            },
            messages: {
                nama: {
                    required: "Nama tidak boleh kosong.",
                    minlength: "Nama tidak boleh kurang dari {0} karakter."
                },
                nohp: {
                    required: "No hp tidak boleh kosong."
                },
                kelamin: {
                    required: "Pilih jenis kelamin",
                },
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                error.addClass("invalid-feedback");
                element.closest('.col-sm-8').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function(form) {

                let btnSimpan = $("button.simpan");

                let before = [
                    btnSimpan.prop('disabled', true),
                    btnSimpan.html('<i class="fas fa-spinner fa-spin"></i>&nbsp;&nbsp;Menyimpan...'),
                ];

                // var data = new FormData(Form[0]);
                // var file = $("#gambar")[0].files;
                // data.append('file', file);

                ajxPost(Form.attr('action'), Form.serialize()).done((respon) => {
                    notif(respon.type, respon.title, respon.msg, true);
                    loadData();
                }).fail((e) => {

                    loadData();
                    mini_notif('error', 'Update profil gagal!');
                });

                // $.ajax({
                //     url: Form.attr('action'),
                //     data: data,
                //     method: 'post',
                //     dataType: 'json',
                //     contentType: false,
                //     processData: false,
                //     success: function(respon) {

                //     },
                // });
            }

        });
    });
</script>