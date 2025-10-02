<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<h1>Tambah Anggota DPR</h1>
<form method="post" action="/anggota/store">
    <div class="mb-3">
        <label class="form-label">Nama Depan</label>
        <input type="text" name="nama_depan" class="form-control" value="<?= old('nama_depan') ?>" required>
        <?php if (session()->getFlashdata('errors.nama_depan')): ?>
            <div class="text-danger"><?= session()->getFlashdata('errors.nama_depan') ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama Belakang</label>
        <input type="text" name="nama_belakang" class="form-control" value="<?= old('nama_belakang') ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Gelar Depan</label>
        <input type="text" name="gelar_depan" class="form-control" value="<?= old('gelar_depan') ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Gelar Belakang</label>
        <input type="text" name="gelar_belakang" class="form-control" value="<?= old('gelar_belakang') ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Jabatan</label>
        <select name="jabatan" class="form-control" required>
            <option value="">Pilih Jabatan</option>
            <option value="Ketua" <?= old('jabatan') === 'Ketua' ? 'selected' : '' ?>>Ketua</option>
            <option value="Wakil Ketua" <?= old('jabatan') === 'Wakil Ketua' ? 'selected' : '' ?>>Wakil Ketua</option>
            <option value="Anggota" <?= old('jabatan') === 'Anggota' ? 'selected' : '' ?>>Anggota</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Status Pernikahan</label>
        <select name="status_pernikahan" class="form-control" required>
            <option value="">Pilih Status</option>
            <option value="Kawin" <?= old('status_pernikahan') === 'Kawin' ? 'selected' : '' ?>>Kawin</option>
            <option value="Belum Kawin" <?= old('status_pernikahan') === 'Belum Kawin' ? 'selected' : '' ?>>Belum Kawin
            </option>
            <option value="Cerai Hidup" <?= old('status_pernikahan') === 'Cerai Hidup' ? 'selected' : '' ?>>Cerai Hidup
            </option>
            <option value="Cerai Mati" <?= old('status_pernikahan') === 'Cerai Mati' ? 'selected' : '' ?>>Cerai Mati
            </option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Jumlah Anak</label>
        <input type="number" name="jumlah_anak" class="form-control" value="<?= old('jumlah_anak', 0) ?>" min="0">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="/anggota" class="btn btn-secondary">Kembali</a>
</form>
<?= $this->endSection() ?>