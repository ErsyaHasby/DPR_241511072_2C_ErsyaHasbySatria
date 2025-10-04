<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= site_url('admin/dashboard') ?>">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Anggota DPR</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="btn btn-danger" href="<?= site_url('logout') ?>">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1>Selamat Datang, <?= session()->get('nama_lengkap') ?>!</h1>
        <p>Ini adalah halaman dashboard untuk Administrator.</p>
        <a href="<?= site_url('admin/anggota') ?>" class="btn btn-primary">Kelola Data Anggota DPR</a>
        <a href="<?= site_url('admin/komponen-gaji') ?>" class="btn btn-success">Kelola Komponen Gaji</a>
    </div>
</body>

</html>