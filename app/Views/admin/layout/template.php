<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= (isset($title)) ? esc($title) : 'Admin Panel' ?> - Gaji DPR</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('css/admin_style.css') ?>">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= site_url('admin/dashboard') ?>"><i class="fas fa-landmark"></i> Admin Gaji
                DPR</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('admin/anggota') ?>"><i class="fas fa-users"></i>
                            Anggota</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('admin/komponen-gaji') ?>"><i
                                class="fas fa-list-alt"></i> Komponen Gaji</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('admin/penggajian') ?>"><i
                                class="fas fa-money-bill-wave"></i> Penggajian</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <span class="navbar-text me-3">
                        Halo, <b><?= session()->get('nama_lengkap') ?></b>!
                    </span>
                    <a href="<?= site_url('logout') ?>" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i>
                        Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="container">
        <?= $this->renderSection('content') ?>
    </main>

    <footer class="footer mt-auto py-3">
        <div class="container text-center">
            <span class="text-muted">Proyek UTS © <?= date('Y') ?> | Dibuat dengan Penuh Semangat</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>