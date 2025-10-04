<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h4>Daftar Komponen Gaji & Tunjangan</h4>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <a href="<?= site_url('admin/komponen-gaji/tambah') ?>" class="btn btn-primary mb-3"><i class="fas fa-plus"></i>
            Tambah Komponen</a>

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
                                <td class="text-center">
                                    <a href="<?= site_url('admin/komponen-gaji/edit/' . $item['id_komponen_gaji']) ?>"
                                        class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                    <form action="<?= site_url('admin/komponen-gaji/delete/' . $item['id_komponen_gaji']) ?>"
                                        method="post" class="d-inline" onsubmit="return confirm('Yakin ingin hapus?');">
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