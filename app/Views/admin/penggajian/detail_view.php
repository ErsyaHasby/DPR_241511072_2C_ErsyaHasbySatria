<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h4><?= esc($title) ?>: <?= esc($anggota['nama_depan']) ?></h4>
    </div>
    <div class="card-body">
        <h5>Data Anggota</h5>
        <table class="table table-sm table-borderless" style="width: auto;">
            <tr>
                <th>Nama Lengkap</th>
                <td>:
                    <?= esc(trim($anggota['gelar_depan'] . ' ' . $anggota['nama_depan'] . ' ' . $anggota['nama_belakang'] . ' ' . $anggota['gelar_belakang'])) ?>
                </td>
            </tr>
            <tr>
                <th>Jabatan</th>
                <td>: <?= esc($anggota['jabatan']) ?></td>
            </tr>
            <tr>
                <th>Status Pernikahan</th>
                <td>: <?= esc($anggota['status_pernikahan']) ?></td>
            </tr>
            <tr>
                <th>Jumlah Anak</th>
                <td>: <?= esc($anggota['jumlah_anak']) ?></td>
            </tr>
        </table>
        <hr>
        <h5>Rincian Gaji & Tunjangan</h5>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Komponen</th>
                    <th>Nominal</th>
                    <th>Satuan</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($detail_komponen as $komponen): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($komponen['nama_komponen']) ?></td>
                        <td>Rp <?= number_format($komponen['nominal'], 0, ',', '.') ?></td>
                        <td><?= esc($komponen['satuan']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot class="table-dark">
                <tr>
                    <th colspan="3" class="text-end">Total Take Home Pay (Bulanan)</th>
                    <th>Rp <?= number_format($take_home_pay, 0, ',', '.') ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="card-footer">
        <a href="<?= site_url('admin/penggajian') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i>
            Kembali</a>
    </div>
</div>
<?= $this->endSection() ?>