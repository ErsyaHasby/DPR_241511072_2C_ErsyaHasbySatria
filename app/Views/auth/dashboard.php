<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Aplikasi Gaji DPR</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 p-4 text-white">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-lg font-bold">Aplikasi Gaji DPR</h1>
            <div>
                <span>Selamat datang, <?= session()->get('nama_depan') ?> <?= session()->get('nama_belakang') ?> (<?= $role ?>)</span>
                <a href="/auth/logout" class="ml-4 hover:underline">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container mx-auto mt-8">
        <h2 class="text-2xl font-bold mb-4">Dashboard</h2>
        <?php if ($role == 'Admin'): ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="/anggota" class="bg-white p-4 rounded shadow hover:bg-gray-50">Kelola Data Anggota DPR</a>
                <a href="/komponen" class="bg-white p-4 rounded shadow hover:bg-gray-50">Kelola Komponen Gaji</a>
                <a href="/penggajian" class="bg-white p-4 rounded shadow hover:bg-gray-50">Kelola Data Penggajian</a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="/anggota" class="bg-white p-4 rounded shadow hover:bg-gray-50">Lihat Data Anggota DPR</a>
                <a href="/penggajian" class="bg-white p-4 rounded shadow hover:bg-gray-50">Lihat Data Penggajian</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>