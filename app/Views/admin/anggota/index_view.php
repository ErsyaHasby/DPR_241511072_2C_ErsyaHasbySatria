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

        <a href="<?= site_url('admin/anggota/tambah') ?>" class="btn btn-primary mb-3">Tambah Anggota Baru</a>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Jabatan</th>
                        <th>Status Pernikahan</th>
                        <th>Jumlah Anak</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($anggota) && is_array($anggota)): ?>
                        <?php $no = 1; ?>
                        <?php foreach ($anggota as $item): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <?= esc($item['gelar_depan'] . ' ' . $item['nama_depan'] . ' ' . $item['nama_belakang'] . ' ' . $item['gelar_belakang']) ?>
                                </td>
                                <td><?= esc($item['jabatan']) ?></td>
                                <td><?= esc($item['status_pernikahan']) ?></td>
                                <td><?= esc($item['jumlah_anak']) ?></td>
                                <td>
                                    <a href="<?= site_url('admin/anggota/edit/' . $item['id_anggota']) ?>"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <form action="<?= site_url('admin/anggota/delete/' . $item['id_anggota']) ?>" method="post"
                                        class="d-inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data anggota.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <a href="<?= site_url('admin/dashboard') ?>" class="btn btn-secondary">Kembali ke Dashboard</a>
    </div>
</body>

</html>