<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<h1>Ubah Anggota DPR</h1>
<form method="post" action="/anggota/update/<?= $anggota['id_anggota'] ?>">
    <div class="mb-3">
        <label class="form-label">Nama Depan</label>
        <input type="text" name="nama_depan" class="form-control"
            value="<?= old('nama_depan', $anggota['nama_depan']) ?>" required>
    </div>
    <!-- Field lain sama seperti create, isi value dari $anggota -->
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="/anggota" class="btn btn-secondary">Kembali</a>
</form>
<?= $this->endSection() ?>