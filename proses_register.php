<?php
include 'config.php'; // Koneksi ke database
session_start();

// Ambil data dari form
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

// Validasi password
if ($password !== $confirmPassword) {
    die("Password tidak cocok. <a href='register.html'>Coba lagi</a>");
}

// Hash password sebelum disimpan ke database
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Simpan ke database
$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";
if (mysqli_query($koneksi, $sql)) {
    echo "Registrasi berhasil! <a href='login.html'>Login sekarang</a>";
} else {
    echo "Registrasi gagal: " . mysqli_error($koneksi);
}
