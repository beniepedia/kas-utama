<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>
<?php

$jatuhtempo = date("Y-m-d");


?>


<section class="content">
    <div class="container-fluid">
        <form action="<?= site_url(service('uri')->getSegment(1, 0) . '/tambah') ?>" method="post">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="anggota" class="col-sm-4 col-form-label">Anggota</label>
                                <div class="col-sm-8">
                                    <select name="pengguna[]" multiple="multiple" id="anggota" style="width:100%;" class="select2bs4 form-control">
                                        <option value="all">Semua anggota
                                            <div class="badge badge-primary"><?= count($anggota); ?></div>
                                        </option>
                                        <?php foreach ($anggota as $a) : ?>
                                            <option value="<?= $a->id_pengguna ?>"><?= ucfirst($a->nama) ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="iuran" class="col-sm-4 col-form-label">Jenis Iuran</label>
                                <div class="col-sm-8">
                                    <select name="jenis_iuran" id="iuran" class="select2bs4 form-control" style="width:100%;">
                                        <?php foreach ($kategori as $k) : ?>
                                            <option value="<?= $k->id_kategori ?>"><?= ucfirst($k->nama_kategori) ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="float-right">
                        <button class="btn btn-primary">Simpan</button>
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
        </form>
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

        $("#iuran").select2();

        $('#anggota').select2({
            placeholder: 'Pilih anggota',
            allowClear: true
        });

    });
</script>
<?= $this->endSection() ?>