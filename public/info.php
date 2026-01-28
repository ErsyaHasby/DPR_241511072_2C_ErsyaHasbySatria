<?php
// File test untuk memastikan PHP berjalan dengan baik
echo "<h1>✅ PHP Berjalan dengan Baik!</h1>";
echo "<p>PHP Version: " . PHP_VERSION . "</p>";
echo "<p>Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "</p>";
echo "<p>Script Filename: " . $_SERVER['SCRIPT_FILENAME'] . "</p>";
echo "<hr>";
echo "<h2>Links untuk Test:</h2>";
echo '<p><a href="index.php">Homepage (index.php)</a></p>';
echo '<p><a href="index.php/login">Login Page</a></p>';
echo '<p><a href="index.php/anggota-publik">Anggota Publik</a></p>';
echo '<p><a href="index.php/admin/dashboard">Admin Dashboard</a></p>';
