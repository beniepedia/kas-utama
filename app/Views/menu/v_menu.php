<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/jquery-nestable/nestable.css">

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="row">
            <!-- left column -->
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header ui-sortable-handle" style="cursor: move;">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            Menu order
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool refresh" data-toggle="tooltip" title="Refresh" onclick="loadData()"><i class="fas fa-sync-alt"></i></button>
                            <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Perkecil" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Perbesar" data-card-widget="maximize"><i class="fas fa-expand"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Sembunyikan" data-card-widget="remove"><i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body" style="min-height: 100px;">
                        <div id="nestable-menu">
                            <button type="button" data-action="expand-all" class="btn btn-xs  btn-dark"><i class="fas fa-expand"></i>&nbsp;&nbsp;Expand All</button>
                            <button type="button" data-action="collapse-all" class="btn btn-xs btn-dark"><i class="fas fa-compress"></i>&nbsp;&nbsp;Collapse All</button>
                        </div>
                        <p id="success-indicator" class="alert alert-success mt-2" style="display: none;">
                            <span class="fas fa-check-square"></span>&nbsp;&nbsp; Perubahan menu berhasil disimpan!
                        </p>
                        <div class="overlay" style="display: none;"><i class="fas fa-3x fa-sync-alt fa-spin"></i></div>
                        <div class="dd" id="nestable">

                        </div>

                    </div>
                    <!-- /.card-body -->

                </div>
            </div>

            <!-- right column -->
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header ui-sortable-handle" style="cursor: move;">
                        <div class="card-title">
                            <i class="fas fa-bars mr-1"></i>
                            Tambah Menu
                        </div>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Perkecil" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Perbesar" data-card-widget="maximize"><i class="fas fa-expand"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Sembunyikan" data-card-widget="remove"><i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url(service('uri')->getSegment(1) . '/tambah') ?>" id="form-tambah-menu">
                            <?= csrf_field(); ?>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Nama Menu</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan nama menu">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="url" class="col-sm-3 col-form-label">URL</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="url" id="url" placeholder="Masukkan url menu">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="icon" class="col-sm-3 col-form-label">Icon</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="icon" id="icon" placeholder="Masukkan icon menu">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-sm-3 col-form-label">status</label>
                                <div class="icheck-primary d-inline col-sm-9">
                                    <input type="checkbox" id="checkboxPrimary1" checked="" name="status">
                                    <label for="checkboxPrimary1">
                                    </label>
                                </div>
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm float-right tambah-menu"><i class="fas fa-save"></i>&nbsp;&nbsp;Tambah</button>
                    </div>
                    </form>
                </div>
            </div>
        </div> <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<div class="modal_edit">
</div>

<script src="<?= base_url('assets') ?>/plugins/jquery-nestable/nestable.js"></script>
<script>
    function loadData() {
        let before = [
            $(".overlay").show()
        ];
        ajxGet('<?= base_url(service('uri')->getSegment(1) . '/loadData'); ?>', before).done((respon) => {
            $(".dd").html(respon);
            $(".overlay").hide();
        });
    }

    $(document).ready(function() {
        loadData();

        $(".dd").nestable({
            maxDepth: 2,
            dropCallback: function(details) {

                var order = new Array();

                $("li[data-id='" + details.destId + "']").find('ol:first').children().each(function(index, elem) {
                    order[index] = $(elem).attr('data-id');
                });

                if (order.length === 0) {
                    var rootOrder = new Array();
                    $("#nestable > ol > li").each(function(index, elem) {
                        rootOrder[index] = $(elem).attr('data-id');
                    });
                }

                $.post('<?= base_url(service('uri')->getSegment(1) . '/simpan_menu'); ?>', {
                            source: details.sourceId,
                            destination: details.destId,
                            order: JSON.stringify(order),
                            rootOrder: JSON.stringify(rootOrder)
                        },
                        function(data) {
                            // console.log('data '+data); 
                        })
                    .done(function(respon) {
                        $("#success-indicator").fadeIn(100).delay(1000).fadeOut(function() {
                            location.reload(true);
                        });
                    })
                    .fail(function() {})
                    .always(function() {});
            }
        });

        $("button[name=save]").click(function(e) {
            e.preventDefault();



        })

        // $(".dd").nestable();
    });

    $(document).ready(function() {

        $('#nestable-menu').on('click', function(e) {
            var target = $(e.target),
                action = target.data('action');
            if (action === 'expand-all') {
                $('.dd').nestable('expandAll');
            }
            if (action === 'collapse-all') {
                $('.dd').nestable('collapseAll');
            }
        });
    });

    $(document).ready(function() {
        let Form = $("#form-tambah-menu");

        Form.validate({
            rules: {
                nama: {
                    required: true,
                    minlength: 3,
                },
                url: {
                    required: true,
                },
                icon: {
                    required: true
                }
            },
            messages: {
                nama: {
                    required: "Nama menu tidak boleh kosong.",
                    minlength: "Nama menu harus lebih dari {0} karakter."
                },
                url: {
                    required: "URL tidak boleh kosong."
                },
                icon: {
                    required: "Pilih icon menu terlebih dahulu."
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
                let before = [
                    $(".tambah-menu").prop('disabled', true),
                    $(".tambah-menu").html('<i class="fas fa-spinner fa-spin"></i>&nbsp;&nbsp;Menyimpan...'),
                ];
                ajxPost(Form.attr('action'), Form.serialize(), before).done((respon) => {
                    if (respon.status == 'success') {
                        location.reload(true);
                    }
                });
            },
        });

    })
</script>
<?= $this->endSection() ?>