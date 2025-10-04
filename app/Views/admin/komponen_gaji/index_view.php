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

        <a href="<?= site_url('admin/komponen-gaji/tambah') ?>" class="btn btn-primary mb-3">Tambah Komponen Baru</a>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Komponen</th>
                        <th>Kategori</th>
                        <th>Jabatan</th>
                        <th>Nominal</th>
                        <th>Satuan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($komponen_gaji) && is_array($komponen_gaji)): ?>
                        <?php $no = 1; ?>
                        <?php foreach ($komponen_gaji as $item): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($item['nama_komponen']) ?></td>
                                <td><?= esc($item['kategori']) ?></td>
                                <td><?= esc($item['jabatan']) ?></td>
                                <td>Rp <?= number_format($item['nominal'], 0, ',', '.') ?></td>
                                <td><?= esc($item['satuan']) ?></td>
                                <td>
                                    <a href="<?= site_url('admin/komponen-gaji/edit/' . $item['id_komponen_gaji']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data komponen gaji.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <a href="<?= site_url('admin/dashboard') ?>" class="btn btn-secondary">Kembali ke Dashboard</a>
    </div>
</body>

</html>