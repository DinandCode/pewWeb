<?php
include '../../config/koneksi.php'; // Koneksi ke database

// Query untuk mengambil semua data dari tabel kedai
$query = "SELECT id, nama_kedai, pemilik, alamat, email FROM kedai";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kedai - Cafe Ungu</title>
    <link rel="stylesheet" href="/CafungE/public/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
<div class="relative flex">
        <!-- Sidebar -->
        <div id="sidebar" class="fixed top-0 right-0 w-64 lg:w-72 bg-white h-full p-8 shadow-lg hidden">
            <h3 class="text-xl font-semibold mb-4">Pesanan Saya</h3>
            <div class="text-center text-gray-500">
                <i class="fas fa-shopping-cart text-6xl mb-4"></i>
                <p>Belum Ada Pesanan</p>
            </div>
            <button class="w-full px-4 py-2 bg-purple-700 text-white rounded-full mt-4">
                Silahkan Pilih Pesanan
            </button>
        </div>

        <!-- Main Content -->
        <div id="main-content" class="w-full lg:w-[calc(100%-0px)] p-8">
            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center">
                    <div class="ml-4">
                        <h1 class="text-3xl lg:text-4xl font-bold text-purple-700">Cafe Ungu</h1>
                        <p class="text-gray-500">Universitas Amikom Purwokerto</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <input type="text" placeholder="Cari warung atau makanan disini" class="px-4 py-2 border rounded-full w-72 lg:w-96" />
                    <button class="ml-2 px-4 py-2 bg-purple-700 text-white rounded-full">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <div class="ml-4">
                    <button onclick="toggleSidebar()" class="px-4 py-2 bg-purple-700 text-white rounded-full">
                        <i class="fas fa-shopping-cart"></i>
                    </button>
                </div>
            </div>

            

<!-- Welcome Banner -->
<div id="banner" class="bg-purple-700 text-white text-right py-4 px-6 pr-2 w-15 pl-15 rounded-lg mb-8 relative mx-auto">
    <img id="icon-cafung" src="/CafungE/public/asset/logoCafung.jpg" alt="" class="w-44 h-44 rounded-full absolute top-[-30px] left-[-20px] border-4 border-white">
    <h2  id="selamatDatang" class="text-2xl lg:text-4xl px-10 font-semibold ">Selamat Datang di Cafe Ungu <br> Universitas Amikom Purwokerto</h2>
</div class="">
            <!-- Navigation Buttons -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-px justify-items-center mb-6">
                <a href="index.php" class="flex flex-col items-center text-purple-700">
                    <i class="fas fa-utensils text-3xl mb-1"></i>
                    <span>Beranda</span>
                </a>
                <a href="menu.php" class="flex flex-col items-center text-purple-700">
                    <i class="fas fa-coffee text-3xl mb-1"></i>
                    <span>Menu Baru</span>
                </a>
                <a href="warung.php" class="flex flex-col items-center text-purple-700">
                    <i class="fas fa-store text-3xl mb-1"></i>
                    <span>Warung</span>
                </a>
                
                <a href="fotokopi.php" class="flex flex-col items-center text-purple-700">
                    <i class="fas fa-box text-3xl mb-1"></i>
                    <span>Fotokopi</span>
                </a>
            </div>

    <!-- Container -->
    <div class="container mx-auto mt-8">
        
        <!-- Grid Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if (mysqli_num_rows($result) > 0) : ?>
                <?php while ($kedai = mysqli_fetch_assoc($result)) : ?>
                    <!-- Card -->
                    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                        <div class="mb-4">
                            <h2 class="text-lg font-bold text-gray-800"><?= htmlspecialchars($kedai['nama_kedai']); ?></h2>
                            <p class="text-sm text-gray-500">Pemilik: <?= htmlspecialchars($kedai['pemilik']); ?></p>
                        </div>
                        <div class="mb-4">
                            <p class="text-sm text-gray-700">
                                <i class="fas fa-map-marker-alt text-purple-600"></i> <?= htmlspecialchars($kedai['alamat']); ?>
                            </p>
                            <p class="text-sm text-gray-700">
                                <i class="fas fa-envelope text-purple-600"></i> <?= htmlspecialchars($kedai['email']); ?>
                            </p>
                        </div>
                        <a href="menu_warung.php?id=<?= $kedai['id']; ?>" class="block text-center text-purple-700 font-semibold mt-4 hover:text-purple-900">
                            Lihat Detail
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <p class="text-center col-span-full text-gray-500">Belum ada kedai yang tersedia.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
<script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const iconCafung = document.getElementById('icon-cafung');
            const banner=document.getElementById('banner');

            

            if (sidebar.classList.contains('hidden')) {
                sidebar.classList.remove('hidden');
                mainContent.style.width = "calc(100% - 18rem)"; // Menyesuaikan lebar konten
                iconCafung.classList.remove('w-44', 'h-44'); // Menghapus ukuran default
                iconCafung.classList.add('w-44', 'h-44'  );

                banner.style.width = "90%";
                banner.classList.add ('mb-12') // Sesuaikan lebar sesuai kebutuhan
                selamatDatang.style.fontSize = "2x1";
               
            } else {
                sidebar.classList.add('hidden');
                mainContent.style.width = "100%"; // Kembalikan ke ukuran penuh
                iconCafung.classList.remove('w-45', 'h-44'); // Menghapus ukuran saat sidebar muncul
                iconCafung.classList.add('w-44', 'h-44'); // Kembali ke ukuran default

                banner.style.width = "100%"; // Atur kembali ke nilai awal
                selamatDatang.style.fontSize = "4x1"; 
            }
        }
    </script>
</html>
