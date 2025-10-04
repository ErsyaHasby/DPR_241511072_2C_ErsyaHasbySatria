<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2><?= esc($title) ?></h2>
        <hr>

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
                    <p class="text-muted">Pilih anggota terlebih dahulu untuk melihat komponen gaji yang tersedia.</p>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Data Penggajian</button>
            <a href="<?= site_url('admin/dashboard') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <script>
        // Data komponen gaji dari PHP
        const semuaKomponenGaji = <?= json_encode($komponen_gaji) ?>;

        const selectAnggota = document.getElementById('id_anggota');
        const containerKomponen = document.getElementById('komponen-gaji-container');

        selectAnggota.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const jabatanAnggota = selectedOption.getAttribute('data-jabatan');

            // Kosongkan container
            containerKomponen.innerHTML = '';

            if (!jabatanAnggota) {
                containerKomponen.innerHTML = '<p class="text-muted">Pilih anggota terlebih dahulu.</p>';
                return;
            }

            // Filter komponen yang sesuai
            const komponenTersedia = semuaKomponenGaji.filter(komponen => {
                return komponen.jabatan === jabatanAnggota || komponen.jabatan === 'Semua';
            });

            if (komponenTersedia.length === 0) {
                containerKomponen.innerHTML = '<p>Tidak ada komponen gaji yang sesuai untuk jabatan ini.</p>';
                return;
            }

            // Tampilkan sebagai checkbox
            komponenTersedia.forEach(komponen => {
                const div = document.createElement('div');
                div.className = 'form-check';

                const input = document.createElement('input');
                input.type = 'checkbox';
                input.className = 'form-check-input';
                input.name = 'id_komponen_gaji[]';
                input.value = komponen.id_komponen_gaji;
                input.id = 'komponen_' + komponen.id_komponen_gaji;

                const label = document.createElement('label');
                label.className = 'form-check-label';
                label.htmlFor = 'komponen_' + komponen.id_komponen_gaji;
                label.textContent = komponen.nama_komponen;

                div.appendChild(input);
                div.appendChild(label);
                containerKomponen.appendChild(div);
            });
        });
    </script>
</body>

</html>