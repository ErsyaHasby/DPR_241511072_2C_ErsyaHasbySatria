<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card bg-light my-4">
                <div class="card-body text-center">
                    <h1 class="card-title">Selamat Datang, <?= session()->get('nama_lengkap') ?>!</h1>
                    <p class="card-text">Anda login sebagai **Administrator**. Gunakan menu navigasi di atas untuk
                        mengelola data sistem.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <i class="fas fa-users fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Anggota DPR</h5>
                    <p class="card-text">Kelola data master anggota dewan.</p>
                    <a href="<?= site_url('admin/anggota') ?>" class="btn btn-primary">Kelola Anggota</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <i class="fas fa-list-alt fa-3x text-success mb-3"></i>
                    <h5 class="card-title">Komponen Gaji</h5>
                    <p class="card-text">Kelola semua jenis gaji dan tunjangan.</p>
                    <a href="<?= site_url('admin/komponen-gaji') ?>" class="btn btn-success">Kelola Komponen</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <i class="fas fa-money-bill-wave fa-3x text-info mb-3"></i>
                    <h5 class="card-title">Penggajian</h5>
                    <p class="card-text">Kelola dan lihat rincian penggajian anggota.</p>
                    <a href="<?= site_url('admin/penggajian') ?>" class="btn btn-info">Kelola Penggajian</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>