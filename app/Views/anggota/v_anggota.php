<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <!-- <h1>Daftar Transaksi</h1> -->
            </div>
            <div class="col-sm-6 ">
                <!-- <i class="fas fa-plus"></i> Tambah Anggota -->
                <a href="javascript:void(0)" class="btn btn-primary btn-sm btn-flat float-right tambah-banyak"> <i class="fas fa-user-plus"></i>&nbsp;&nbsp;Tambah Banyak</a>
                <a href="javascript:void(0)" class="btn btn-success btn-sm btn-flat float-right tambah"> <i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah</a>
                <button type="button" class="btn btn-danger btn-sm btn-flat float-right hapus-semua" style="display: none;"><i class="fas fa-trash-alt"></i>&nbsp;&nbsp;Hapus semua</button>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 tampilAnggota">

                <!-- content display -->

            </div>
        </div> <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- Modal -->
<div class="modal_view">

</div>


<script>
    function loadData() {
        const view = $(".tampilAnggota");
        $(".tambah").show();
        $(".tambah-banyak").show();
        const before = [
            view.html('<h4 class="text-center mt-5"><i class="fas fa-spinner fa-spin"></i>&nbsp;&nbsp;Loading data...</h4>')
        ];
        ajxGet('<?= site_url('anggota/loadData') ?>', before).done(function(respon) {
            view.html(respon.data);
        }).fail(function() {
            view.html('<h4 class="text-center text-danger mt-5">Gagal mengambil data...</h4>');
        });
    }

    $(document).ready(function() {
        loadData();

        $(".tambah").click(function(e) {
            $(this).hide();
            $(".tambah-banyak").hide();
            const view = $(".tampilAnggota");
            e.preventDefault();
            ajxGet('<?= site_url('anggota/tambah') ?>').done(function(respon) {
                view.html(respon.data);

            });
        });
    });

    $(document).ready(function() {
        $(".tambah-banyak").click(function(e) {
            $(this).hide();
            $(".tambah").hide();
            const view = $(".tampilAnggota");
            e.preventDefault();
            ajxGet('<?= site_url('anggota/tambah_banyak') ?>').done(function(respon) {
                view.html(respon.data);
            });
        });
    });

    $("body").on("click", ".edit", function(e) {
        e.preventDefault();
        $(".tambah").hide();
        $(".tambah-banyak").hide();
        let id = $(this).attr('id');
        ajxPost('<?= site_url(service('uri')->getSegment(1, 0) . '/edit'); ?>', {
            id: id
        }).done((respon) => {
            $(".tampilAnggota").html(respon.view);
        }).fail((e) => {
            alert(e.responseText);
        })
    });
</script>
<?= $this->endSection() ?>