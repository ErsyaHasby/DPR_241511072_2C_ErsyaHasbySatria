<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah Komponen Gaji</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Formulir Tambah Komponen Gaji</h2>
        <hr>

        <?php $errors = session()->getFlashdata('errors'); ?>
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Terdapat Kesalahan!</h4>
                <hr>
                <p class="mb-0">
                    <?php foreach ($errors as $error): ?>
                        <?= esc($error) ?><br>
                    <?php endforeach ?>
                </p>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('admin/komponen-gaji/simpan') ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="nama_komponen" class="form-label">Nama Komponen <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nama_komponen" id="nama_komponen"
                    value="<?= old('nama_komponen') ?>" required>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select class="form-select" name="kategori" id="kategori" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Gaji Pokok" <?= old('kategori') == 'Gaji Pokok' ? 'selected' : '' ?>>Gaji Pokok
                            </option>
                            <option value="Tunjangan Melekat" <?= old('kategori') == 'Tunjangan Melekat' ? 'selected' : '' ?>>Tunjangan Melekat</option>
                            <option value="Tunjangan Lain" <?= old('kategori') == 'Tunjangan Lain' ? 'selected' : '' ?>>
                                Tunjangan Lain</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Berlaku untuk Jabatan <span
                                class="text-danger">*</span></label>
                        <select class="form-select" name="jabatan" id="jabatan" required>
                            <option value="">Pilih Jabatan</option>
                            <option value="Semua" <?= old('jabatan') == 'Semua' ? 'selected' : '' ?>>Semua</option>
                            <option value="Ketua" <?= old('jabatan') == 'Ketua' ? 'selected' : '' ?>>Ketua</option>
                            <option value="Wakil Ketua" <?= old('jabatan') == 'Wakil Ketua' ? 'selected' : '' ?>>Wakil
                                Ketua</option>
                            <option value="Anggota" <?= old('jabatan') == 'Anggota' ? 'selected' : '' ?>>Anggota</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nominal" class="form-label">Nominal (Rp) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="nominal" id="nominal"
                            value="<?= old('nominal') ?>" required step="any">
                    </div>
                    <div class="mb-3">
                        <label for="satuan" class="form-label">Satuan <span class="text-danger">*</span></label>
                        <select class="form-select" name="satuan" id="satuan" required>
                            <option value="">Pilih Satuan</option>
                            <option value="Bulan" <?= old('satuan') == 'Bulan' ? 'selected' : '' ?>>Bulan</option>
                            <option value="Hari" <?= old('satuan') == 'Hari' ? 'selected' : '' ?>>Hari</option>
                            <option value="Periode" <?= old('satuan') == 'Periode' ? 'selected' : '' ?>>Periode</option>
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Komponen</button>
            <a href="<?= site_url('admin/dashboard') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>

</html>