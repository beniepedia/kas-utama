<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card p-0">
                    <!-- <div class="card-header">
                        <div class="card-title">Tambah jenis pos</div>
                    </div> -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Nama pos</th>
                                    <td width="30">:</td>
                                    <td><input type="text" class="form-control form-control-sm"></td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <td width="30">:</td>
                                    <td><input type="text" class="form-control form-control-sm"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="py-2 float-right">
                            <button class="btn btn-default">Tambah</button>
                        </div>

                    </div>
                </div>
            </div>
        </div> <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?= $this->endSection() ?>