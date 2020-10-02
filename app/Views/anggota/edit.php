<div class="col-md-6">
    <div class="card ">
        <div class="card-header">
            <h5 class="card-title">Edit Anggota</h5>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Perbesar" data-card-widget="maximize"><i class="fas fa-expand"></i>
                </button>
                <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Sembunyikan" data-card-widget="remove" onclick="loadData()"><i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form action="">
                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="nama" id="nama" value="<?= $user->nama ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="email" id="email" value="<?= $user->email ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nohp" class="col-sm-4 col-form-label">No HP</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="nohp" id="nohp" value="<?= $user->no_hp ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kelamin" class="col-sm-4 col-form-label">Kelamin</label>
                    <div class="col-sm-8">
                        <select name="kelamin" id="kelamin" class="form-control">
                            <option value="">Pilih kelamin</option>
                            <option value="L" <?= ($user->kelamin == 'L' ? 'selected' : null) ?>>Laki - Laki</option>
                            <option value="P" <?= ($user->kelamin == 'P' ? 'selected' : null) ?>>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-sm-4 col-form-label">Status</label>
                    <div class="icheck-success d-inline col-sm-8">
                        <input type="checkbox" id="status" name="status" <?= ($user->status == 1 ? 'checked' : null) ?>>
                        <label for="status">Aktif
                        </label>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>