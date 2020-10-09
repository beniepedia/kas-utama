<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>

<style>
    /* table .btn {
        border: none;
    } */
</style>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12 tampilPemasukan">
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
    <?php $uri = \Config\Services::uri(); ?>

    function loadData() {
        const view = $(".tampilPemasukan");
        const before = [
            view.html('<h4 class="text-center mt-5"><i class="fas fa-spinner fa-spin"></i>&nbsp;&nbsp;Loading data...</h4>')
        ];
        ajxGet('<?= site_url($uri->getSegment(1, 0) . '/loadData') ?>', before).done(function(respon) {
            view.html(respon.view);
        }).fail(function(e) {
            view.html('<h4 class="text-center text-danger mt-5">Gagal mengambil data...</h4>');
        });
    }

    $(function() {
        loadData();
    });
</script>

<?= $this->endSection() ?>