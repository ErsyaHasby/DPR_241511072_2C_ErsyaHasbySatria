<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h4><?= esc($title) ?></h4>
    </div>
    <div class="card-body">
        <form action="<?= site_url('admin/penggajian/update/' . $anggota['id_anggota']) ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label">Anggota DPR</label>
                <input type="text" class="form-control"
                    value="<?= esc($anggota['nama_depan'] . ' ' . $anggota['nama_belakang']) ?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Pilih Komponen Gaji Baru</label>
                <div id="komponen-gaji-container" class="border p-3 rounded" style="height: 250px; overflow-y: auto;">
                </div>
            </div>
            <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Update Penggajian</button>
            <a href="<?= site_url('admin/penggajian') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<script>
    const jabatanAnggota = '<?= $anggota['jabatan'] ?>';
    const semuaKomponenGaji = <?= json_encode($semua_komponen_gaji) ?>;
    const currentKomponenIds = <?= json_encode($current_komponen_ids) ?>;
    const containerKomponen = document.getElementById('komponen-gaji-container');

    function renderKomponen() {
        containerKomponen.innerHTML = '';
        const komponenTersedia = semuaKomponenGaji.filter(komponen => {
            return komponen.jabatan === jabatanAnggota || komponen.jabatan === 'Semua';
        });

        komponenTersedia.forEach(komponen => {
            const isChecked = currentKomponenIds.includes(komponen.id_komponen_gaji) ? 'checked' : '';
            const div = document.createElement('div');
            div.className = 'form-check';
            div.innerHTML = `
                <input class="form-check-input" type="checkbox" name="id_komponen_gaji[]" value="${komponen.id_komponen_gaji}" id="komponen_${komponen.id_komponen_gaji}" ${isChecked}>
                <label class="form-check-label" for="komponen_${komponen.id_komponen_gaji}">
                    ${komponen.nama_komponen}
                </label>
            `;
            containerKomponen.appendChild(div);
        });
    }
    document.addEventListener('DOMContentLoaded', renderKomponen);
</script>
<?= $this->endSection() ?>