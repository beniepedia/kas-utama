<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>
<?php

$jatuhtempo = date("Y-m-d");



// for ($i = 1; $i <= count($bulan); $i++) {
//     $tempo = date("Y-n-d", strtotime("+$i month", strtotime($jatuhtempo)));
//     echo $tempo . "<br>";
//     echo date("Y", strtotime($tempo)) . "<br>";
// }

?>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Isi jumlah iuran / bulan</label>
                            <input type="text" class="form-control bulanFlat">
                            <small class="text-muted">Isi form ini jika jumlah iuran perbulan flat / tetap</small>
                        </div>
                        <hr>
                        <?php
                        for ($i = 0; $i < 12; $i++) {
                            $tempo = date("Y-m-d", strtotime("+$i month", strtotime($jatuhtempo)));   ?>
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label"><?= $bulan[date("n", strtotime($tempo))] ?></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control bulan" name="<?= strtolower($bulan[date("n", strtotime($tempo))]) ?>">
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(function() {
        let bulan = $(".bulan");
        let bulanAll = $(".bulanFlat");

        bulan.mask("#.##0", {
            reverse: true,

        });

        bulanAll.mask("#.##0", {
            reverse: true,

        });

        bulanAll.keyup(function() {
            bulan.val(bulanAll.val());
        });
    });
</script>
<?= $this->endSection() ?>