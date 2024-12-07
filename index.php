<?php
session_start();
include 'config.php'; // Koneksi ke database

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header('Location: login.html');
    exit;
}

// Ambil data produk dari database
$sql = "SELECT * FROM produk";
$result = mysqli_query($koneksi, $sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 20px;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card img {
            object-fit: cover;
            height: 200px;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
        }

        .btn-cart {
            background-color: #4caf50;
            color: white;
        }

        .btn-cart:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">E-Commerce Blockchain</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Hi, <?= htmlspecialchars($_SESSION['username']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Kontainer Produk -->
    <div class="container">
        <h1 class="text-center my-4">Daftar Produk</h1>
        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card">
                        <img src="https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//101/MTA-3390895/sunlight_-sunlight-jeruk-nipis-sabun-cuci-piring--755-ml-_full02.jpg" alt="Produk Image" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['nama_produk']); ?></h5>
                            <p class="card-text">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></p>
                            <a href="detail_produk.php?id=<?= $row['id']; ?>" class="btn btn-primary btn-sm">Detail</a>
                            <a href="beli_produk.php?id=<?= $row['id']; ?>" class="btn btn-cart btn-sm"><i class="bi bi-cart"></i> Beli</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Link Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>