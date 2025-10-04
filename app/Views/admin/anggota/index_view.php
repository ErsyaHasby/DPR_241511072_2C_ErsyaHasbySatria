<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h4><?= esc($title) ?></h4>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <form action="<?= site_url('admin/anggota') ?>" method="get" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" name="keyword"
                    placeholder="Cari berdasarkan Nama, Jabatan, atau ID..." value="<?= esc($keyword ?? '') ?>">
                <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i> Cari</button>
            </div>
        </form>

        <a href="<?= site_url('admin/anggota/tambah') ?>" class="btn btn-primary mb-3"><i class="fas fa-plus"></i>
            Tambah Anggota</a>

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
                                    <?= esc(trim($item['gelar_depan'] . ' ' . $item['nama_depan'] . ' ' . $item['nama_belakang'] . ' ' . $item['gelar_belakang'])) ?>
                                </td>
                                <td><?= esc($item['jabatan']) ?></td>
                                <td><?= esc($item['status_pernikahan']) ?></td>
                                <td><?= esc($item['jumlah_anak']) ?></td>
                                <td class="text-center">
                                    <a href="<?= site_url('admin/anggota/edit/' . $item['id_anggota']) ?>"
                                        class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                    <form action="<?= site_url('admin/anggota/delete/' . $item['id_anggota']) ?>" method="post"
                                        class="d-inline" onsubmit="return confirm('Yakin ingin hapus?');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-danger"><i
                                                class="fas fa-trash-alt"></i></button>
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
    </div>
</div>
<?= $this->endSection() ?>