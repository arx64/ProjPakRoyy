<?php
// Konfigurasi database
include 'config.php';

// Ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Cari user di database
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($koneksi, $sql);
$user = mysqli_fetch_assoc($result);

if ($user) {
    // Verifikasi password
    if (password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['id_user'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        // echo "Login berhasil! <a href='dashboard.php'>Masuk ke dashboard</a>";
        header("Location: index.php");
    } else {
        echo "Password salah!";
    }
} else {
    echo "Username tidak ditemukan!";
}
