<?php
include '../../config/koneksi.php'; // Koneksi ke database

$kedai_id = intval($_COOKIE['kedai_id']); 
$query = "SELECT * FROM kedai"; // Query untuk mengambil semua data dari tabel kedai
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
    <title>Cafe Ungu</title>
    <link rel="stylesheet" href="/CafungE/public/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        #main-content {
            transition: margin-right 0.3s ease-in-out, width 0.3s ease-in-out;
        }

        #sidebar {
            transition: transform 0.3s ease-in-out;
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
            <h3 class="text-xl font-semibold mb-4">Daftar Kedai</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php while ($kedai = mysqli_fetch_assoc($result)) : ?>
                    <a href="/kedai/<?= htmlspecialchars($kedai['slug']); ?>" class="relative block bg-white rounded-lg shadow-lg overflow-hidden group">
                        <img src="<?= htmlspecialchars($kedai['gambar']); ?>" alt="<?= htmlspecialchars($kedai['nama_kedai']); ?>" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute top-4 left-4 bg-purple-700 text-white px-3 py-1 text-xs font-semibold rounded-full">
                            <?= htmlspecialchars($kedai['kategori']); ?>
                        </div>
                        <div class="p-4">
                            <h4 class="text-lg font-bold text-gray-800 group-hover:text-purple-700 transition-colors duration-300">
                                <?= htmlspecialchars($kedai['nama_kedai']); ?>
                            </h4>
                            <p class="text-sm text-gray-500"><?= htmlspecialchars($kedai['deskripsi']); ?></p>
                            <div class="mt-2 flex items-center text-purple-700 font-semibold text-sm">
                                <i class="fas fa-map-marker-alt mr-2"></i> Lokasi: <?= htmlspecialchars($kedai['lokasi']); ?>
                            </div>
                        </div>
                    </a>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');

            if (sidebar.classList.contains('hidden')) {
                sidebar.classList.remove('hidden');
                mainContent.style.width = "calc(100% - 18rem)";
            } else {
                sidebar.classList.add('hidden');
                mainContent.style.width = "100%";
            }
        }
    </script>
</body>
</html>
