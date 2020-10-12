<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
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
                                <div class="form-group float-right">
                                    <button class="btn btn-info update">Ubah</button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                                Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-three-settings" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
                                Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        sadasd
                    </div>
                </div> <!-- /.row -->
            </div>
        </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<script>
    $(document).ready(function() {
        var logoDir = '<?= base_url('writable/uploads/logo.png'); ?>';
        $("#logo").fileinput({
            initialPreview: [logoDir],
            language: "id",
            theme: 'fas',
            allowedFileExtensions: ["jpg", "png", "jpeg"],
            allowedPreviewMimeTypes: ['image/jpeg', 'image/png', 'image/jpg'],
            maxFileSize: 1000,
            showUpload: false,
            initialPreviewAsData: true,
            dropZoneEnabled: false,
            previewFileType: "image",
            browseClass: "btn btn-secondary",
            browseLabel: "Upload logo",
            browseIcon: "<i class=\"fas fa-image\"></i> ",
            removeClass: "btn btn-danger",
            removeLabel: "Delete",
            removeIcon: "<i class=\"fas fa-trash\"></i> ",
        });
    });
</script>
<?= $this->endSection() ?>