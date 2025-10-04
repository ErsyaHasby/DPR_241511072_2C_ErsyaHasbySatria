<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h4><?= esc($title) ?></h4>
    </div>
    <div class="card-body">
        <?php $errors = session()->getFlashdata('errors'); ?>
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger" role="alert">
                <p class="mb-0"><strong>Terdapat Kesalahan!</strong></p>
                <hr>
                <?php foreach ($errors as $error): ?>        <?= esc($error) ?><br><?php endforeach ?>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('admin/komponen-gaji/update/' . $komponen['id_komponen_gaji']) ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="nama_komponen" class="form-label">Nama Komponen <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nama_komponen" id="nama_komponen"
                    value="<?= esc($komponen['nama_komponen']) ?>" required>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select class="form-select" name="kategori" id="kategori" required>
                            <option value="Gaji Pokok" <?= $komponen['kategori'] == 'Gaji Pokok' ? 'selected' : '' ?>>Gaji
                                Pokok</option>
                            <option value="Tunjangan Melekat" <?= $komponen['kategori'] == 'Tunjangan Melekat' ? 'selected' : '' ?>>Tunjangan Melekat</option>
                            <option value="Tunjangan Lain" <?= $komponen['kategori'] == 'Tunjangan Lain' ? 'selected' : '' ?>>Tunjangan Lain</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Berlaku untuk Jabatan <span
                                class="text-danger">*</span></label>
                        <select class="form-select" name="jabatan" id="jabatan" required>
                            <option value="Semua" <?= $komponen['jabatan'] == 'Semua' ? 'selected' : '' ?>>Semua</option>
                            <option value="Ketua" <?= $komponen['jabatan'] == 'Ketua' ? 'selected' : '' ?>>Ketua</option>
                            <option value="Wakil Ketua" <?= $komponen['jabatan'] == 'Wakil Ketua' ? 'selected' : '' ?>>
                                Wakil Ketua</option>
                            <option value="Anggota" <?= $komponen['jabatan'] == 'Anggota' ? 'selected' : '' ?>>Anggota
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nominal" class="form-label">Nominal (Rp) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="nominal" id="nominal"
                            value="<?= esc($komponen['nominal']) ?>" required step="any">
                    </div>
                    <div class="mb-3">
                        <label for="satuan" class="form-label">Satuan <span class="text-danger">*</span></label>
                        <select class="form-select" name="satuan" id="satuan" required>
                            <option value="Bulan" <?= $komponen['satuan'] == 'Bulan' ? 'selected' : '' ?>>Bulan</option>
                            <option value="Hari" <?= $komponen['satuan'] == 'Hari' ? 'selected' : '' ?>>Hari</option>
                            <option value="Periode" <?= $komponen['satuan'] == 'Periode' ? 'selected' : '' ?>>Periode
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Update Komponen</button>
            <a href="<?= site_url('admin/komponen-gaji') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>