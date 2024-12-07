<?php
// Pastikan sesi dimulai
session_start();
include 'config.php'; // Koneksi ke database

// Periksa apakah sesi login ada
if (!isset($_SESSION['username'])) {
    die("Anda harus login terlebih dahulu. <a href='login.html'>Login di sini</a>");
}

// Ambil username dari sesi
$username = $_SESSION['username'];

// Periksa apakah ID produk ada di URL
if (!isset($_GET['id'])) {
    die("Produk tidak ditemukan. <a href='index.php'>Kembali ke daftar produk</a>");
}

$id_produk = (int)$_GET['id']; // Pastikan ID adalah angka

// Ambil data produk dari database berdasarkan ID
$sql = "SELECT * FROM produk WHERE id = $id_produk";
$result = mysqli_query($koneksi, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Produk tidak ditemukan. <a href='index.php'>Kembali ke daftar produk</a>");
}

$produk = mysqli_fetch_assoc($result); // Ambil data produk
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Barang - E-Commerce Blockchain</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            margin-bottom: 20px;
            background-color: yellow;
            padding: 10px;
            border-radius: 10px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            width: 300px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
        }

        input {
            padding: 10px;
            font-size: 16px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <h2>Pesan Barang - <?= htmlspecialchars($produk['nama_produk']); ?></h2>
    <form action="enkripsi.php" method="post">
        <!-- Input username tersembunyi -->
        <input type="hidden" name="namaUser" value="<?php echo htmlspecialchars($username); ?>">

        <!-- Input nama barang tersembunyi -->
        <input type="hidden" name="namaBarang" value="<?= htmlspecialchars($produk['nama_produk']); ?>">

        <div class="form-group">
            <label for="hargaBarang">Harga Barang:</label>
            <input type="text" name="hargaBarang" id="hargaBarang" value="<?= htmlspecialchars($produk['harga']); ?>" readonly>
        </div>

        <div class="form-group">
            <label for="totalBarang">Total Barang:</label>
            <input type="number" name="totalBarang" id="totalBarang" min="1" required>
        </div>

        <button type="submit">Checkout!</button>
    </form>
</body>

</html>