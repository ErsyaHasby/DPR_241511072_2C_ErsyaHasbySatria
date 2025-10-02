<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<h1>Selamat Datang, <?= session()->get('nama') ?></h1>
<p>Role: <?= session()->get('role') ?></p>
<p>Gunakan menu di atas untuk mengelola data.</p>
<?= $this->endSection() ?>