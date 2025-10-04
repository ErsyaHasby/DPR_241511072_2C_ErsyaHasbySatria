<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale-1.0">
    <title><?= (isset($title)) ? esc($title) : 'Info Publik' ?> - Gaji DPR</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('css/public_style.css') ?>">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="<?= site_url('penggajian-publik') ?>"><i class="fas fa-balance-scale"></i>
                Transparansi DPR</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#publicNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="publicNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('anggota-publik') ?>">Data Anggota</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('penggajian-publik') ?>">Data Penggajian</a>
                    </li>
                </ul>
                <?php if (session()->get('isLoggedIn') && session()->get('role') === 'Public'): ?>
                    <span class="navbar-text me-3">Halo, <?= session()->get('nama_lengkap') ?>!</span>
                    <a href="<?= site_url('logout') ?>" class="btn btn-outline-light">Logout</a>
                <?php else: ?>
                    <a href="<?= site_url('login') ?>" class="btn btn-light">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <main class="container">
        <?= $this->renderSection('content') ?>
    </main>

    <footer class="footer mt-auto py-3">
        <div class="container text-center">
            <span class="text-muted">Informasi Publik © <?= date('Y') ?></span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>