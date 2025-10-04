<?= $this->extend('public/layout/template') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h4><?= esc($title) ?></h4>
    </div>
    <div class="card-body">
        <p>Berikut adalah rekapitulasi pendapatan bulanan (Take Home Pay) setiap anggota DPR.</p>
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
</div>
<?= $this->endSection() ?>