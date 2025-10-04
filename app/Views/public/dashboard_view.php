<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="#">Dashboard Publik</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('anggota-publik') ?>">Data Anggota</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('penggajian-publik') ?>">Data Penggajian</a>
                    </li>
                </ul>
                <span class="navbar-text me-3">
                    Selamat Datang, <?= session()->get('nama_lengkap') ?>!
                </span>
                <a href="<?= site_url('logout') ?>" class="btn btn-light">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Selamat Datang di Portal Transparansi Gaji DPR</h2>
        <p>Silakan pilih menu di atas untuk melihat informasi yang tersedia.</p>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Anggota DPR</h5>
                        <p class="card-text">Lihat daftar lengkap anggota Dewan Perwakilan Rakyat periode saat ini.</p>
                        <a href="<?= site_url('anggota-publik') ?>" class="btn btn-primary">Lihat Data Anggota</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Penggajian</h5>
                        <p class="card-text">Lihat rekapitulasi total pendapatan bulanan (Take Home Pay) setiap anggota.
                        </p>
                        <a href="<?= site_url('penggajian-publik') ?>" class="btn btn-success">Lihat Data Penggajian</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>