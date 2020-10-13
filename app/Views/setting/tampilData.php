<script>
    $(document).ready(function() {
        var logoDir = '<?= base_url('writable/uploads/' . $setting->logo); ?>';
        $("#logo").fileinput({
            initialPreview: [logoDir],
            language: "id",
            theme: 'fas',
            allowedFileExtensions: ["jpg", "png", "jpeg"],
            allowedPreviewMimeTypes: ['image/jpeg', 'image/png', 'image/jpg'],
            maxFileSize: 1000,
            showUpload: false,
            showRemove: false,
            initialPreviewAsData: true,
            dropZoneEnabled: false,
            previewFileType: "image",
            browseClass: "btn btn-secondary",
            browseLabel: "Upload logo",
            browseIcon: "<i class=\"fas fa-image\"></i> ",
        });
    });

    $(document).ready(function() {
        $("#form-setting").submit(function(e) {
            e.preventDefault();

            // let data = new FormData($(this)[0]);
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name=X-CSRF-TOKEN]').attr('content')
            //     }
            // });


            $(this).validate({
                rules: {
                    nama: {
                        required: true,
                    },
                    desa: {
                        required: true,
                    },
                    kelurahan: {
                        required: true,
                    },
                    kecamatan: {
                        required: true,
                    },
                    alamat: {
                        required: true,
                    },
                },
                messages: {
                    nama: {
                        required: "Nama aplikasi tidak boleh kosong.",
                    },
                    desa: {
                        required: "Desa tidak boleh kosong.",
                    },
                    kelurahan: {
                        required: "Kelurahan tidak boleh kosong.",
                    },
                    kecamatan: {
                        required: "Kecamatan tidak boleh kosong.",
                    },
                    alamat: {
                        required: "ALamat tidak boleh kosong.",
                    },
                },
                errorElement: "span",
                errorPlacement: function(error, element) {
                    error.addClass("invalid-feedback");
                    element.closest('.form-group .col-sm-8').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                    $(element).removeClass('is-valid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                    $(element).addClass('is-valid');
                },
                submitHandler: function() {
                    $("#form-setting").submit();
                },
            })

            // $.ajax({
            //     url: $(this).attr('action'),
            //     method: "POST",
            //     processData: false,
            //     contentType: false,
            //     dataType: "json",
            //     data: data,
            //     beforeSend: function() {
            //         $('button[type=submit]').html('<i class="fas fa-spinner fa-spin"></i>&nbsp;&nbsp;Menyimpan...');
            //         $('button[type=submit]').prop('disabled', true);

            //     },
            //     success: function(respon) {
            //         if (respon.status == 'success') {
            //             load();
            //             var notif = mini_notif('success', respon.msg);
            //             notif.then((result) => {
            //                 if (result.value) {
            //                     location.reload(true);
            //                 }
            //             });
            //         } else if (respon.status == 'error') {
            //             mini_notif('error', respon.msg);
            //         }
            //     },
            //     complete: function(data) {
            //         $('meta[name=X-CSRF-TOKEN]').attr('content', data.responseJSON.token);
            //         $('button[type=submit]').html('Update');
            //         $('button[type=submit]').prop('disabled', false);
            //     },
            // });

        });
    });
</script>