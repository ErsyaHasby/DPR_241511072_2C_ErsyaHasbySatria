<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h4>Data Penggajian Anggota DPR</h4>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <form action="<?= site_url('admin/penggajian') ?>" method="get" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" name="keyword" placeholder="Cari berdasarkan nama anggota..."
                    value="<?= esc($keyword ?? '') ?>">
                <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i> Cari</button>
            </div>
        </form>

        <a href="<?= site_url('admin/penggajian/tambah') ?>" class="btn btn-primary mb-3"><i class="fas fa-plus"></i>
            Tambah Penggajian</a>

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
                                <td><?= esc(trim($item['gelar_depan'] . ' ' . $item['nama_depan'] . ' ' . $item['nama_belakang'] . ' ' . $item['gelar_belakang'])) ?>
                                </td>
                                <td><?= esc($item['jabatan']) ?></td>
                                <td><b>Rp <?= number_format($item['take_home_pay'] ?? 0, 0, ',', '.') ?></b></td>
                                <td class="text-center">
                                    <a href="<?= site_url('admin/penggajian/detail/' . $item['id_anggota']) ?>"
                                        class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                    <a href="<?= site_url('admin/penggajian/edit/' . $item['id_anggota']) ?>"
                                        class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                    <form action="<?= site_url('admin/penggajian/delete/' . $item['id_anggota']) ?>"
                                        method="post" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin hapus semua data gaji anggota ini?');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-danger"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>