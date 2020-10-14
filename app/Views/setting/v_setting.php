<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Umum</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Messages</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false">Settings</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                <form action="<?= base_url(service('uri')->getSegment(1, 0) . '/update') ?>" id="form-setting" method="post" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
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
                                    <hr class="mt-4">
                                    <div class="form-group float-right ">
                                        <button type="submit" class="btn btn-info update">Update</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                <form action="<?= base_url(service('uri')->getSegment(1, 0) . '/update') ?>" id="form-setting" method="post">
                                    <?= csrf_field(); ?>
                                    <div class="form-group row">
                                        <label for="protocol" class="col-sm-4 col-form-label">Protokol</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="protocol" id="protocol" placeholder="Masukkan email protocol" value="<?= $email->protocol; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="host" class="col-sm-4 col-form-label">Host</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="host" id="host" placeholder="Masukkan email host" value="<?= $email->host; ?>">
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
                                    <hr class="mt-4">
                                    <div class="form-group float-right ">
                                        <button type="submit" class="btn btn-info update">Update</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                                Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-three-settings" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
                                Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                            </div>
                        </div>
                    </div>
                </div> <!-- /.row -->
            </div>

            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="<?= site_url('writable/uploads/' . $setting->logo); ?>" alt="logo" style="width:80%;">
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- /.container-fluid -->
</section>
<!-- /.content -->
<script>
    $(document).ready(function() {
        $("#logo").fileinput({
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
        $("#form-setting").validate({
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
            }
        });
    });
</script>
<?= $this->endSection() ?>