<style>
    .table-detail-kas th {
        background-color: dodgerblue;
        color: #fff;
    }
</style>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped table-detail-kas">
        <tbody>
            <tr>
                <th>Kode Kas</th>
                <td><?= $kas->kode_kas_umum ?></td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td><?= indo_daydate($kas->tanggal) ?></td>
            </tr>
            <tr>
                <th>Kategori</th>
                <td><?= ucfirst($kas->nama_kategori) ?></td>
            </tr>
            <tr>
                <th>Jenis Kas</th>
                <td><?= ($kas->jenis_kas == 'M' ? 'Pemasukan&nbsp;&nbsp;<i class="fas fa-arrow-up text-success"></i>' : 'Pengeluaran&nbsp;&nbsp;<i class="fas fa-arrow-down text-danger"></i>') ?></td>
            </tr>
            <tr>
                <th>Jumlah</td>
                <td><?= ($kas->jenis_kas == 'M' ? indo_currency($kas->masuk, true) : indo_currency($kas->keluar, true)) ?></td>
            </tr>
            <tr>
                <th>Keterangan</th>
                <td><?= $kas->keterangan ?></td>
            </tr>
            <tr>
                <th>Dibuat Oleh</th>
                <td><?= $kas->created_name . ' <div class="badge badge-success">' . $kas->created_level . '</div>' ?>
                </td>
            </tr>
            <tr>
                <th>Diubah Oleh</th>
                <td><?= $kas->updated_name . ' <div class="badge badge-success">' . $kas->updated_level . '</div>'  ?>
</div>
</td>
</tr>
</tbody>
</table>
</div>