<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>
<?php helper('datetime'); ?>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 profile-image">
                <!-- Profile Image -->
                <div class="card card-widget widget-user" id="profile-image">
                    <div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="card card-info card-tabs">
                    <div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                            <li class="nav-item px-3">
                                <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#myprofile" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#form_ganti_password" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Ganti Password</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-two-tabContent">
                            <div class="tab-pane fade active show" id="myprofile" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">

                            </div>
                            <div class="tab-pane fade" id="form_ganti_password" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">

                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>


<script>
    function loadData() {
        $before = [
            $(".overlay").show()
        ];
        ajxGet("<?= base_url(service('uri')->getSegment(1) . '/loadData') ?>", $before).done((respon) => {
            $("#profile-image").html(respon.profile_image);
            $("#myprofile").html(respon.profile);
            $("#form_ganti_password").html(respon.ganti_password);
            $(".overlay").hide()
        });
    }

    $(document).ready(function() {
        loadData();
        $(document).on('click', '.ubah-profile', function() {
            $("#form-profile :input").prop('disabled', false);
            $(".simpan").show();
            $(".batal").show();
            $("#form-profile :input[name=nama]").focus();
        });

        $(document).on("click", ".batal", function() {
            loadData();
        });

        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });
    });
</script>



<?= $this->endSection() ?>