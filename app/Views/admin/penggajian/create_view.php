<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h4>Form Tambah Data Penggajian</h4>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('admin/penggajian/simpan') ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="id_anggota" class="form-label">Pilih Anggota DPR <span class="text-danger">*</span></label>
                <select class="form-select" name="id_anggota" id="id_anggota" required>
                    <option value="">-- Pilih Anggota --</option>
                    <?php foreach ($anggota as $item): ?>
                        <option value="<?= $item['id_anggota'] ?>" data-jabatan="<?= $item['jabatan'] ?>">
                            <?= esc($item['nama_depan'] . ' ' . $item['nama_belakang']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_komponen_gaji" class="form-label">Pilih Komponen Gaji <span
                        class="text-danger">*</span></label>
                <div id="komponen-gaji-container" class="border p-3 rounded" style="height: 250px; overflow-y: auto;">
                    <p class="text-muted">Pilih anggota terlebih dahulu untuk melihat komponen gaji.</p>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Data</button>
            <a href="<?= site_url('admin/penggajian') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<script>
    const semuaKomponenGaji = <?= json_encode($komponen_gaji) ?>;
    const selectAnggota = document.getElementById('id_anggota');
    const containerKomponen = document.getElementById('komponen-gaji-container');

    selectAnggota.addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const jabatanAnggota = selectedOption.getAttribute('data-jabatan');
        containerKomponen.innerHTML = '';

        if (!jabatanAnggota) {
            containerKomponen.innerHTML = '<p class="text-muted">Pilih anggota terlebih dahulu.</p>';
            return;
        }

        const komponenTersedia = semuaKomponenGaji.filter(komponen => {
            return komponen.jabatan === jabatanAnggota || komponen.jabatan === 'Semua';
        });

        if (komponenTersedia.length === 0) {
            containerKomponen.innerHTML = '<p>Tidak ada komponen gaji yang sesuai untuk jabatan ini.</p>';
            return;
        }

        komponenTersedia.forEach(komponen => {
            const div = document.createElement('div');
            div.className = 'form-check';
            div.innerHTML = `
                <input class="form-check-input" type="checkbox" name="id_komponen_gaji[]" value="${komponen.id_komponen_gaji}" id="komponen_${komponen.id_komponen_gaji}">
                <label class="form-check-label" for="komponen_${komponen.id_komponen_gaji}">
                    ${komponen.nama_komponen}
                </label>
            `;
            containerKomponen.appendChild(div);
        });
    });
</script>
<?= $this->endSection() ?>