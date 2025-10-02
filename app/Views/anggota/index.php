<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<h1>Data Anggota DPR</h1>
<?php if (session()->get('role') === 'Admin'): ?>
    <a href="/anggota/create" class="btn btn-primary mb-3">Tambah Anggota</a>
<?php endif; ?>
<form method="get" class="mb-3">
    <div class="input-group">
        <input type="text" name="keyword" class="form-control" placeholder="Cari nama/jabatan/ID">
        <button type="submit" class="btn btn-secondary">Cari</button>
    </div>
</form>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Gelar Depan</th>
            <th>Nama Depan</th>
            <th>Nama Belakang</th>
            <th>Gelar Belakang</th>
            <th>Jabatan</th>
            <th>Status Pernikahan</th>
            <th>Jumlah Anak</th>
            <?php if (session()->get('role') === 'Admin'): ?>
                <th>Aksi</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($anggota as $a): ?>
            <tr>
                <td><?= esc($a['id_anggota']) ?></td>
                <td><?= esc($a['gelar_depan']) ?: '-' ?></td>
                <td><?= esc($a['nama_depan']) ?></td>
                <td><?= esc($a['nama_belakang']) ?></td>
                <td><?= esc($a['gelar_belakang']) ?: '-' ?></td>
                <td><?= esc($a['jabatan']) ?></td>
                <td><?= esc($a['status_pernikahan']) ?></td>
                <td><?= esc($a['jumlah_anak']) ?></td>
                <?php if (session()->get('role') === 'Admin'): ?>
                    <td>
                        <!-- Aksi Ubah/Hapus diimplementasikan di commit berikutnya -->
                        <a href="/anggota/edit/<?= $a['id_anggota'] ?>" class="btn btn-warning btn-sm disabled">Ubah</a>
                        <form action="/anggota/delete/<?= $a['id_anggota'] ?>" method="post" style="display:inline;">
                            <button type="submit" class="btn btn-danger btn-sm disabled"
                                onclick="return confirmDelete()">Hapus</button>
                        </form>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection() ?>