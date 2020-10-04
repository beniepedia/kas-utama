<!-- modal Edit -->
<div class="modal fade show" id="form-edit" style="display: block;" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url(service('uri')->getSegment(1) . '/edit') ?>" method="post" class="form-edit">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Menu</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $menu['id_menu']; ?>">
                    <div class="form-group">
                        <label for="nama-menu">Nama </label>
                        <input type="text" class="form-control" name="nama" value="<?= $menu['nama_menu']; ?>" id="nama-menu">
                    </div>
                    <div class="form-group">
                        <label for="url">URL </label>
                        <input type="text" class="form-control" name="url" value="<?= $menu['url']; ?>" id="url">
                        <small class="text-muted">Ganti spasi dengan tanda ( - )</small>
                    </div>
                    <div class="form-group">
                        <label for="icon">Icon</label>
                        <input type="text" class="form-control" name="icon" value="<?= $menu['icon']; ?>" id="icon">
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm simpan"><i class="fas fa-save"></i>&nbsp;&nbsp;Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    $(document).ready(function() {
        const Form = $(".form-edit");

        Form.validate({
            rules: {
                nama: {
                    required: true,
                },
                url: {
                    required: true,
                },
                icon: {
                    required: true,
                },
            },
            messages: {
                nama: {
                    required: "Nama tidak boleh kosong.",
                },
                url: {
                    required: "URL tidak boleh kosong.",
                },
                icon: {
                    required: "Pilih icon menu.",
                },
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                error.addClass("invalid-feedback");
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function() {
                const before = [
                    $("button.simpan").html('<i class="fas fa-spinner fa-spin"></i>&nbsp;&nbsp;Memproses...'),
                    $("button.simpan").prop('disabled', true)
                ];
                const action = Form.attr('action');
                const data = Form.serialize();
                ajxPost(action, data).done((respon) => {
                    if (respon == 1) {
                        let notif = mini_notif('success', 'Menu berhasil diubah!');
                        $("#form-edit").modal('hide');
                        notif.then((result) => {
                            if (result) {
                                location.reload(true);
                            }
                        });
                    }
                }).fail(() => {
                    $("button.simpan").html('<i class="fas fa-save"></i>&nbsp;&nbsp;Simpan');
                    $("button.simpan").prop('disabled', false);
                    notif('error', 'Gagal', 'Terjadi kesalahan pada sistem!', true, false);
                });

            }
        })
    });
</script>