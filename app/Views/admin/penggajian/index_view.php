<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2><?= esc($title) ?></h2>
        <hr>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <a href="<?= site_url('admin/penggajian/tambah') ?>" class="btn btn-primary mb-3">Tambah Penggajian Baru</a>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Jabatan</th>
                        <th>Take Home Pay (Bulanan)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($penggajian) && is_array($penggajian)): ?>
                        <?php $no = 1; ?>
                        <?php foreach ($penggajian as $item): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <?= esc(trim($item['gelar_depan'] . ' ' . $item['nama_depan'] . ' ' . $item['nama_belakang'] . ' ' . $item['gelar_belakang'])) ?>
                                </td>
                                <td><?= esc($item['jabatan']) ?></td>
                                <td><b>Rp <?= number_format($item['take_home_pay'] ?? 0, 0, ',', '.') ?></b></td>
                                <td>
                                <td>
                                    <a href="<?= site_url('admin/penggajian/detail/' . $item['id_anggota']) ?>"
                                        class="btn btn-sm btn-info">Detail</a>
                                    <a href="<?= site_url('admin/penggajian/edit/' . $item['id_anggota']) ?>"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                                </td>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data penggajian.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <a href="<?= site_url('admin/dashboard') ?>" class="btn btn-secondary">Kembali ke Dashboard</a>
    </div>
</body>

</html>