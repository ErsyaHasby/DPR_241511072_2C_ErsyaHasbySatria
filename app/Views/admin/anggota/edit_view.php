<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-M">
    <title><?= esc($title) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Formulir Edit Data Anggota DPR</h2>
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

        <form action="<?= site_url('admin/anggota/update/' . $anggota['id_anggota']) ?>" method="post">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="gelar_depan" class="form-label">Gelar Depan</label>
                        <input type="text" class="form-control" name="gelar_depan" id="gelar_depan"
                            value="<?= esc($anggota['gelar_depan']) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="nama_depan" class="form-label">Nama Depan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama_depan" id="nama_depan"
                            value="<?= esc($anggota['nama_depan']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Jabatan <span class="text-danger">*</span></label>
                        <select class="form-select" name="jabatan" id="jabatan" required>
                            <option value="">Pilih Jabatan</option>
                            <option value="Ketua" <?= $anggota['jabatan'] == 'Ketua' ? 'selected' : '' ?>>Ketua</option>
                            <option value="Wakil Ketua" <?= $anggota['jabatan'] == 'Wakil Ketua' ? 'selected' : '' ?>>Wakil
                                Ketua</option>
                            <option value="Anggota" <?= $anggota['jabatan'] == 'Anggota' ? 'selected' : '' ?>>Anggota
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="gelar_belakang" class="form-label">Gelar Belakang</label>
                        <input type="text" class="form-control" name="gelar_belakang" id="gelar_belakang"
                            value="<?= esc($anggota['gelar_belakang']) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="nama_belakang" class="form-label">Nama Belakang <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama_belakang" id="nama_belakang"
                            value="<?= esc($anggota['nama_belakang']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="status_pernikahan" class="form-label">Status Pernikahan <span
                                class="text-danger">*</span></label>
                        <select class="form-select" name="status_pernikahan" id="status_pernikahan" required>
                            <option value="">Pilih Status</option>
                            <option value="Kawin" <?= $anggota['status_pernikahan'] == 'Kawin' ? 'selected' : '' ?>>Kawin
                            </option>
                            <option value="Belum Kawin" <?= $anggota['status_pernikahan'] == 'Belum Kawin' ? 'selected' : '' ?>>Belum Kawin</option>
                            <option value="Cerai Hidup" <?= $anggota['status_pernikahan'] == 'Cerai Hidup' ? 'selected' : '' ?>>Cerai Hidup</option>
                            <option value="Cerai Mati" <?= $anggota['status_pernikahan'] == 'Cerai Mati' ? 'selected' : '' ?>>Cerai Mati</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="jumlah_anak" class="form-label">Jumlah Anak <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="jumlah_anak" id="jumlah_anak"
                    value="<?= esc($anggota['jumlah_anak']) ?>" required min="0">
            </div>
            <button type="submit" class="btn btn-warning">Update Data</button>
            <a href="<?= site_url('admin/anggota') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>

</html>