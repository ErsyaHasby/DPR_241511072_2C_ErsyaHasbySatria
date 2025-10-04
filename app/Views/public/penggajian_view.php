<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Transparansi Gaji DPR</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('anggota-publik') ?>">Data Anggota</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= site_url('penggajian-publik') ?>">Data Penggajian</a>
                    </li>
                </ul>
                <a href="<?= site_url('login') ?>" class="btn btn-light">Login</a>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <h2><?= esc($title) ?></h2>
        <p>Berikut adalah rekapitulasi pendapatan bulanan (Take Home Pay) setiap anggota.</p>
        <hr>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Jabatan</th>
                        <th>Take Home Pay (Bulanan)</th>
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
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data penggajian.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>