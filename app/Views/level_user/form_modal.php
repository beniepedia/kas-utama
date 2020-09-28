<?php $uri = \Config\Services::uri(); ?>
<form role="form" action="<?= base_url($uri->getSegment(1) . '/ubah'); ?>" method="post" id="form-akses" autocomplete="off">
    <?= csrf_field() ?>
    <div class="modal fade" id="modal-form">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Akses </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive-sm">
                        <input type="hidden" name="level_user" value="<?= $_POST['level_user']; ?>">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Menu</th>
                                    <th>Level Menu</th>
                                    <th class="text-center">Akses</th>
                                    <th class="text-center">Tambah</th>
                                    <th class="text-center">Edit</th>
                                    <th class="text-center">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                function checkbox($jenis, $no = null, $type, $aktif = null)
                                {
                                    return '<div class="icheck-' . $type . ' d-inline">
                                            <input type="checkbox" name="' . $jenis . $no . '" id="' . $jenis . $no . '" ' . ($aktif == 1 ? 'checked' : '') . '>
                                            <label for="' . $jenis . $no . '">
                                            </label>
                                            </div>';
                                }

                                ?>
                                <?php $no = 0;
                                foreach ($list_menu as $lm) : ?>

                                    <tr>
                                        <td>
                                            <i class="<?= $lm['icon'] ?>"></i>&nbsp;&nbsp;
                                            <?= ucfirst($lm["nama_menu"]) ?>
                                        </td>
                                        <td>
                                            <?= str_replace('_', ' ', ucfirst($lm["level_menu"])) ?>
                                        </td>

                                        <td class="text-center">
                                            <?= checkbox('akses', $no, 'primary', $lm["akses"]) ?>
                                        </td>
                                        <td class="text-center">
                                            <?= checkbox('tambah', $no, 'success', $lm["tambah"]) ?>
                                        </td>
                                        <td class="text-center">
                                            <?= checkbox('edit', $no, 'warning', $lm["edit"]) ?>
                                        </td>
                                        <td class="text-center">
                                            <?= checkbox('hapus', $no, 'danger', $lm["hapus"]) ?>
                                        </td>


                                    </tr>
                                <?php $no++;
                                endforeach ?>
                            </tbody>
                            <tfoot>
                                <th colspan="2" class="text-right">Pilih semua</th>
                                <th class="text-center">
                                    <?= checkbox('akses', 'All', 'primary', null) ?>
                                </th>
                                <th class="text-center">
                                    <?= checkbox('tambah', 'All', 'success', null) ?>
                                </th>
                                <th class="text-center">
                                    <?= checkbox('edit', 'All', 'warning', null) ?>
                                </th>
                                <th class="text-center">
                                    <?= checkbox('hapus', 'All', 'danger', null) ?>
                                </th>
                            </tfoot>
                        </table>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="" class="btn btn-primary btn-sm float-right"><i class="fas fa-paper-plane"></i>&nbsp;&nbsp;Simpan</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>

<script>
    $(document).ready(function() {

        let selectAllAkses = $("input[name=aksesAll]");
        let selectAllTambah = $("input[name=tambahAll]");
        let selectAllEdit = $("input[name=editAll]");
        let selectAllHapus = $("input[name=hapusAll]");

        let rowAkses = $(".table tbody tr").find("td:eq(2)").find("input[type=checkbox]");
        let rowTambah = $(".table tbody tr").find("td:eq(3)").find("input[type=checkbox]");
        let rowEdit = $(".table tbody tr").find("td:eq(4)").find("input[type=checkbox]");
        let rowHapus = $(".table tbody tr").find("td:eq(5)").find("input[type=checkbox]");

        if (rowAkses.prop('checked') == true) {
            selectAllAkses.attr("checked", true);
        } else {
            selectAllAkses.attr("checked", false);
        }

        if (rowTambah.prop('checked') == true) {
            selectAllTambah.attr("checked", true);
        }

        if (rowEdit.prop('checked') == true) {
            selectAllEdit.attr("checked", true);
        }

        if (rowHapus.prop('checked') == true) {
            selectAllHapus.attr("checked", true);
        }

        selectAllAkses.change(function() {
            if ($(this).is(":checked")) {
                rowAkses.prop('checked', true);
            } else {
                rowAkses.prop('checked', false);
            }
        });

        selectAllTambah.click(function() {
            if ($(this).is(":checked")) {
                rowTambah.prop('checked', true);
            } else {
                rowTambah.prop('checked', false);
            }

        });

        selectAllEdit.change(function() {
            if ($(this).is(":checked")) {
                rowEdit.prop('checked', true);
            } else {
                rowEdit.prop('checked', false);
            }
        });

        selectAllHapus.change(function() {
            if ($(this).is(":checked")) {
                rowHapus.prop('checked', true);
            } else {
                rowHapus.prop('checked', false);
            }
        });

    });
</script>