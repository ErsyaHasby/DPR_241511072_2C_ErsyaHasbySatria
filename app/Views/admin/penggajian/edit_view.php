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

            <button type="submit" class="btn btn-warning">Update Data Penggajian</button>
            <a href="<?= site_url('admin/penggajian') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <script>
        // Data dari PHP
        const jabatanAnggota = '<?= $anggota['jabatan'] ?>';
        const semuaKomponenGaji = <?= json_encode($semua_komponen_gaji) ?>;
        const currentKomponenIds = <?= json_encode($current_komponen_ids) ?>;
        const containerKomponen = document.getElementById('komponen-gaji-container');

        function renderKomponen() {
            containerKomponen.innerHTML = '';

            // Filter komponen yang sesuai
            const komponenTersedia = semuaKomponenGaji.filter(komponen => {
                return komponen.jabatan === jabatanAnggota || komponen.jabatan === 'Semua';
            });

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

                // Cek apakah komponen ini harus ter-centang
                if (currentKomponenIds.includes(komponen.id_komponen_gaji)) {
                    input.checked = true;
                }

                const label = document.createElement('label');
                label.className = 'form-check-label';
                label.htmlFor = 'komponen_' + komponen.id_komponen_gaji;
                label.textContent = komponen.nama_komponen;

                div.appendChild(input);
                div.appendChild(label);
                containerKomponen.appendChild(div);
            });
        }

        // Panggil fungsi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', renderKomponen);
    </script>
</body>

</html>