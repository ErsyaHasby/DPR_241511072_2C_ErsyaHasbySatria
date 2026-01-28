<?php
/**
 * Tool untuk Generate Password Hash dan Update Database
 */

// Generate password hash untuk admin123
$password = 'admin123';
$hash = password_hash($password, PASSWORD_BCRYPT);

echo "<h2>Password Hash Generator</h2>";
echo "<p><strong>Password:</strong> " . htmlspecialchars($password) . "</p>";
echo "<p><strong>Hash:</strong> <code>" . htmlspecialchars($hash) . "</code></p>";

echo "<hr>";
echo "<h3>Copy SQL ini dan jalankan di phpMyAdmin (tab SQL):</h3>";
echo "<textarea style='width:100%; height:150px; font-family:monospace;'>";
echo "USE dpr_gaji_db;\n\n";
echo "UPDATE users SET password = '" . $hash . "' WHERE username = 'admin';\n";
echo "UPDATE users SET password = '" . $hash . "' WHERE username = 'user';\n\n";
echo "SELECT username, role, 'Password Updated!' as status FROM users;";
echo "</textarea>";

echo "<hr>";
echo "<h3>Atau klik tombol di bawah untuk auto-update:</h3>";

// Auto update jika ada parameter
if (isset($_GET['update'])) {
    // Koneksi database
    $conn = new mysqli('localhost', 'root', '', 'dpr_gaji_db');

    if ($conn->connect_error) {
        die("<div style='color:red'>Koneksi gagal: " . $conn->connect_error . "</div>");
    }

    // Update password
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");

    // Update admin
    $username = 'admin';
    $stmt->bind_param("ss", $hash, $username);
    $stmt->execute();

    // Update user
    $username = 'user';
    $stmt->bind_param("ss", $hash, $username);
    $stmt->execute();

    echo "<div style='color:green; font-weight:bold; padding:10px; background:#d4edda; border:1px solid #c3e6cb;'>";
    echo "✅ Password berhasil di-update!<br>";
    echo "Username: admin | Password: admin123<br>";
    echo "Username: user | Password: admin123<br>";
    echo "<br><a href='login' style='color:blue;'>Klik di sini untuk login</a>";
    echo "</div>";

    $stmt->close();
    $conn->close();
} else {
    echo "<a href='?update=1' style='display:inline-block; padding:10px 20px; background:#007bff; color:white; text-decoration:none; border-radius:5px;'>UPDATE PASSWORD SEKARANG</a>";
}

echo "<hr>";
echo "<p><a href='login'>← Kembali ke Login</a></p>";

