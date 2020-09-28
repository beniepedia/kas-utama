<!-- Add the bg color to the header using any of the bg-* classes -->
<?php helper('datetime') ?>


<div class="widget-user-header bg-info">

    <button class="btn text-white" onclick="document.getElementById('image_upload').click(); return false" style="position: absolute;left:5px;top:5px" data-toggle="tooltip" data-placement="top" title="Ganti foto profil"><i class="fas fa-camera" onMouseOver="this.style.color='grey'" onMouseOut="this.style.color='#fff'"></i> </button>
    <input type="file" id="image_upload" accept="image/*" style="visibility:hidden;position:absolute;">
    <input type="hidden" name="imageLama" value="<?= $user['photo'] ?>">

    <h3 class="widget-user-username"><?= ucfirst($user['nama']) ?></h3>
    <h5 class="widget-user-desc"><?= session()->get('userLevel') ?></h5>
</div>
<a href="<?= 'writable/user_image/' . $user['photo'] ?>" data-toggle="lightbox" class="widget-user-image">
    <img class="img-circle elevation-2" src="<?= 'writable/user_image/' . $user['photo'] ?>" alt="User Avatar">
</a>

<div class="card-footer">
    <div class="row">
        <div class="col-sm-4 border-right">
            <div class="description-block">
                <!-- <i class="fas fa-bars"></i> -->
                <h6 class="description-header">3242</h6>
                <span class="description-text">dsfsdfsdfds</span>
            </div>
            <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-4 border-right">
            <div class="description-block">
                <h5 class="description-header">13,000</h5>
                <span class="description-text">FOLLOWERS</span>
            </div>
            <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-4">
            <div class="description-block">
                <h5 class="description-header">35</h5>
                <span class="description-text">PRODUCTS</span>
            </div>
            <!-- /.description-block -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="col mt-4 text-center">
        <div class="badge badge-white text-gray">
            Tanggal Daftar <br><br>
            <?= indo_daydate($user['created_at']) ?>
        </div>
    </div>
</div>
<button class="btn btn-info btn btn-flat ubah-profile"><i class="fas fa-edit"></i> Ubah profile saya</button>

<div class="modal fade show" id="modal_upload_image" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Upload foto profil</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="image_crop"></div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary crop_upload"><i class="fas fa-upload "></i>&nbsp;&nbsp;Crop & upload</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>

<script>
    $(document).ready(function() {
        $image_crop = $("#image_crop").croppie({
            enableExif: true,
            viewport: {
                width: 250,
                height: 250,
                type: 'square',
            },
            boundary: {
                width: 400,
                height: 400,
            }
        });

        $("#image_upload").change(function() {
            let reader = new FileReader();
            reader.onload = function(event) {
                $image_crop.croppie('bind', {
                    url: event.target.result
                }).then(() => {
                    console.log("Bind Succesfull");
                });
            }
            reader.readAsDataURL(this.files[0]);
            $("#modal_upload_image").modal('show');
        });

        $(".crop_upload").click(function(event) {
            $image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport',
            }).then((response) => {
                let url = '<?= base_url(service('uri')->getSegment(1) . '/ganti_photo') ?>';
                let before = [
                    $(this).html('<i class="fas fa-spinner fa-spin"></i>&nbsp;&nbspMengupload'),
                    $(this).prop('disabled', true)
                ];
                let data = {
                    gambarBaru: response,
                    gambarLama: $("input[name=imageLama]").val(),
                };
                ajxPost(url, data).done((data) => {
                    // $(".widget-user-image").attr('href', data.link);
                    // $(".widget-user-image").html(data.img_link);
                    loadData();
                    $(".sidebar .user-panel .image").html(data.img_link);
                    $("#modal_upload_image").modal('hide');
                }).always(() => {
                    $(this).html('<i class="fas fa-upload "></i>&nbsp;&nbsp;Crop & upload');
                    $(this).prop('disabled', false);
                });
            })
        });
    });
</script>