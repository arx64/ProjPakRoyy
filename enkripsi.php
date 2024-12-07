<?php
session_start();
include 'config.php'; // Koneksi database

// Periksa apakah pengguna login
if (!isset($_SESSION['username'])) {
    die("Anda harus login terlebih dahulu. <a href='login.html'>Login di sini</a>");
}

// Ambil data dari form
$namaUser = $_POST['namaUser'];
$namaBarang = $_POST['namaBarang'];
$hargaBarang = $_POST['hargaBarang'];
$totalBarang = $_POST['totalBarang'];

if ($namaUser !== $_SESSION['username']) {
    echo "<script>alert(Hayoo, kamu bukan " . $_SESSION['username'] . "!);window.location.href = 'dashboard.php';</script>";
}
// Gabungkan data transaksi menjadi satu string
$dataTransaksi = $namaUser . '|' . $namaBarang . '|' . $hargaBarang . '|' . $totalBarang;

// Hash data transaksi dengan SHA-256
$hashTransaksi = hash('sha256', $dataTransaksi);

// Tampilkan hasil hash
echo "<h3>Data Transaksi:</h3>";
echo "Nama User: $namaUser <br>";
echo "Nama Barang: $namaBarang <br>";
echo "Harga Barang: $hargaBarang <br>";
echo "Total Barang: $totalBarang <br>";
echo "<h3>Hash SHA-256:</h3>";
echo $hashTransaksi;

// Simpan data ke database (contoh query untuk tabel transaksi)


$sql = "INSERT INTO transaksi (id_user, nama_barang, harga_barang, jumlah_barang, hash_transaksi) 
        VALUES ((SELECT id FROM users WHERE username = '$namaUser'), '$namaBarang', '$hargaBarang', '$totalBarang', '$hashTransaksi')";

if (mysqli_query($koneksi, $sql)) {
    // echo "<script>alert('Transaksi berhasil disimpan!');window.location.href = 'dashboard.php';</script>";
    echo "<script>
      alert('Transaksi berhasil disimpan!');
      setTimeout(function() {
        window.location.href = 'index.php';
      }, 2000); // 2000 milliseconds = 2 seconds
    </script>";
} else {
    echo "<br><br>Gagal menyimpan transaksi: " . mysqli_error($koneksi);
}
