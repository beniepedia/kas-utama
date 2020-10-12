<form action="<?= base_url(service('uri')->getSegment(1, 0) . '/update') ?>" id="form-setting" method="post" enctype="multipart/form-data">
    <div class="form-group row">
        <label for="nama" class="col-sm-4 col-form-label">Nama aplikasi</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan nama aplikasi" value="<?= $setting->nama_app; ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="desa" class="col-sm-4 col-form-label">Desa</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="desa" id="desa" placeholder="Masukkan desa" value="<?= $setting->desa; ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="kelurahan" class="col-sm-4 col-form-label">Kelurahan</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="kelurahan" id="kelurahan" placeholder="Masukkan kelurahan" value="<?= $setting->kelurahan; ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="kecamatan" class="col-sm-4 col-form-label">Kecamatan</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="kecamatan" id="kecamatan" placeholder="Masukkan kecamatan" value="<?= $setting->kecamatan; ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="logo" class="col-sm-4 col-form-label">Logo aplikasi</label>
        <div class="col-sm-8">
            <input type="file" name="logo" id="logo" accept="image/*">
        </div>
    </div>
    <hr>
    <div class="form-group float-right">
        <button type="submit" class="btn btn-info update">Update</button>
    </div>
</form>
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

            let data = new FormData($(this)[0]);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name=X-CSRF-TOKEN]').attr('content')
                }
            });

            $.ajax({
                url: $(this).attr('action'),
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "json",
                data: data,
                beforeSend: function() {
                    $('button[type=submit]').html('<i class="fas fa-spinner fa-spin"></i>&nbsp;&nbsp;Menyimpan...');
                    $('button[type=submit]').prop('disabled', true);

                },
                success: function(respon) {
                    if (respon.status == 'success') {
                        load();
                        var notif = mini_notif('success', respon.msg);
                        notif.then((result) => {
                            if (result.value) {
                                location.reload(true);
                            }
                        });
                    } else if (respon.status == 'error') {
                        mini_notif('error', respon.msg);
                    }
                },
                complete: function(data) {
                    $('meta[name=X-CSRF-TOKEN]').attr('content', data.responseJSON.token);
                    $('button[type=submit]').html('Update');
                    $('button[type=submit]').prop('disabled', false);
                },
            });

        });
    });
</script>