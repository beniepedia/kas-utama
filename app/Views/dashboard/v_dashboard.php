<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>
<!-- Main content -->

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 class="count"><?= indo_currency($kas->total_kas_masuk) ?></h3>
                        <p>Total pemasukan KAS UMUM</p>
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
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?= indo_currency($kas->total_kas_keluar) ?></h3>
                        <p>Total pengeluaran KAS UMUM</p>
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
        <div class="row">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool refresh" data-toggle="tooltip" title="Refresh" onclick="loadGrafik()"><i class="fas fa-sync-alt"></i></button>
                            <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Perkecil" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Perbesar" data-card-widget="maximize"><i class="fas fa-expand"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Sembunyikan" data-card-widget="remove"><i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="grafik"></div>

                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Kategori</div>
                    </div>
                    <div class="card-body">
                        <div id="kategori"></div>
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <div class="row">


            <!-- kalender -->
            <div class="col-sm-8">
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

            var bulan = [];
            var masuk = [];
            var keluar = [];
            var date = new Date();

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
            for (var i in respon.grafik) {
                bulan.push(_bulan[respon.grafik[i].bulan - 1]);
                masuk.push(respon.grafik[i].masuk);
                keluar.push(respon.grafik[i].keluar);
            }

            masuk = masuk.map(Number);
            keluar = keluar.map(Number);


            Highcharts.setOptions({
                lang: {
                    thousandsSep: ','
                }
            });
            Highcharts.chart('grafik', {

                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Grafik Pemasukan & Pengeluaran KAS UMUM Thn ' + date.getFullYear()
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    categories: bulan,
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Jumlah (Rp)'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>Rp {point.y:,.0f}</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Pemasukan',
                    data: masuk

                }, {
                    name: 'Pengeluaran',
                    data: keluar

                }]
            });

            var html = [];
            var max = 100;
            $.each(respon.kategori, function(i, v) {
                html += `<div class="progress-group">
                            ` + v.nama_kategori.toUpperCase() + `
                            <span class="float-right"><b>${v.total}</b>/100</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-` + (v.total <= 50 ? 'success' : (v.total > 85 ? 'danger' : 'warning')) + `" style="width: ` + v.total * 100 / max + `%"></div>
                            </div>
                        </div>`;
            });

            $("#kategori").html(html);
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