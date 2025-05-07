<?php
require_once 'config/database.php';

// Cek apakah admin sudah ada
$stmt = $pdo->query("SELECT COUNT(*) as count FROM users WHERE role = 'admin'");
$result = $stmt->fetch();
if ($result['count'] > 0) {
    die("Admin sudah ada!");
}

// Buat admin baru
$username = 'admin';
$password = password_hash('admin123', PASSWORD_DEFAULT);
$email = 'admin@example.com';
$full_name = 'Administrator';
$role = 'admin';

try {
    $stmt = $pdo->prepare("INSERT INTO users (username, password, email, full_name, role) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$username, $password, $email, $full_name, $role]);
    echo "Admin berhasil dibuat!<br>Username: admin<br>Password: admin123<br><a href='index.php'>Login di sini</a>";
} catch(PDOException $e) {
    die("Gagal membuat admin: " . $e->getMessage());
} 