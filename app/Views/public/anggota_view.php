<?= $this->extend('public/layout/template') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h4><?= esc($title) ?></h4>
    </div>
    <div class="card-body">
        <p>Berikut adalah daftar anggota Dewan Perwakilan Rakyat Republik Indonesia periode saat ini.</p>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Jabatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($anggota) && is_array($anggota)): ?>
                        <?php $no = 1; ?>
                        <?php foreach ($anggota as $item): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc(trim($item['gelar_depan'] . ' ' . $item['nama_depan'] . ' ' . $item['nama_belakang'] . ' ' . $item['gelar_belakang'])) ?>
                                </td>
                                <td><?= esc($item['jabatan']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>