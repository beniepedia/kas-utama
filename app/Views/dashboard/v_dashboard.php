<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>
<?php helper('fungsi') ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 class="count"><?= ($total_kas_umum['jumlah'] ? indo_currency($total_kas_umum['jumlah']) : 'Rp. 0') ?></h3>
                        <p>Total KAS Masuk</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>53<sup style="font-size: 20px">%</sup></h3>

                        <p>Bounce Rate</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>44</h3>

                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>65</h3>

                        <p>Unique Visitors</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <hr>
        <figure class="highcharts-figure">
            <div id="grafik"></div>

        </figure>

        <hr>
        <div class="row">
            <div class="col-sm-6">
                dsadasdas
            </div>

            <!-- kalender -->
            <div class="col-sm-6">
                <!-- Calendar -->
                <div class="card bg-gradient-dark">
                    <div class="card-header border-0">

                        <h3 class="card-title">
                            <i class="far fa-calendar-alt"></i>
                            Kalender
                        </h3>
                        <!-- tools card -->
                        <div class="card-tools">
                            <!-- button with a dropdown -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                                    <i class="fas fa-bars"></i></button>
                                <div class="dropdown-menu float-right" role="menu">
                                    <a href="#" class="dropdown-item">Add new event</a>
                                    <a href="#" class="dropdown-item">Clear events</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item">View calendar</a>
                                </div>
                            </div>
                            <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body pt-0">
                        <!--The calendar -->
                        <div id="calendar" style="width: 100%"></div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
</section>
<!-- /.content -->

<script>
    function loadGrafik() {
        ajxGet('<?= site_url(service('uri')->getSegment(1, 0) . '/loadGrafik'); ?>').done((respon) => {

            console.log(respon.m);
            var bulan = [];
            var masuk = [];
            var keluar = [];

            var _bulan = [
                "Januari",
                "Februari",
                "Maret",
                "April",
                "Mei",
                "Juni",
                "Juli",
                "Agustus",
                "September",
                "Oktober",
                "November",
                "Desember",
            ];

            for (var i in respon.m) {
                bulan.push(_bulan[respon.m[i].bulan - 1]);
                masuk.push(respon.m[i].total);

            }

            for (var i in respon.p) {
                // bulan.push(_bulan[respon.m[i].bulan - 1]);
                keluar.push(respon.p[i].total);

            }

            var masuk = masuk.map(Number);
            var keluar = keluar.map(Number);


            Highcharts.chart('grafik', {
                chart: {
                    type: 'area'
                },
                title: {
                    text: 'Grafik pemasukan dan pengeluaran KAS UMUM'
                },
                subtitle: {
                    text: 'Source: Wikipedia.org'
                },
                xAxis: {
                    categories: bulan,
                    tickmarkPlacement: 'on',
                    title: {
                        enabled: true
                    }
                },
                yAxis: {
                    title: {
                        text: 'Jumlah'
                    },
                    labels: {
                        // formatter: function() {
                        //     return value;
                        // }
                    }
                },
                tooltip: {
                    split: false,
                    valueSuffix: ' '
                },
                plotOptions: {
                    area: {
                        stacking: 'normal',
                        lineColor: '#666666',
                        lineWidth: 1,
                        marker: {
                            lineWidth: 1,
                            lineColor: '#666666'
                        }
                    }
                },
                series: [{
                        name: 'Pemasukan',
                        data: masuk
                    },
                    {
                        name: 'Pengeluaran',
                        data: keluar
                    }
                ]
            });
        });
    }


    $(function() {
        $('#calendar').datetimepicker({
            format: 'L',
            inline: true
        });


        loadGrafik();

    });
</script>

<?= $this->endSection() ?>