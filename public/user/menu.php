<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafe Ungu</title>
    <link rel="stylesheet" href="/public/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 font-poppins relative">
    <!-- Overlay for Sidebar -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden" onclick="toggleSidebar()"></div>

    <div class="relative flex">
        <!-- Sidebar -->
        <div id="sidebar" class="fixed top-0 right-0 w-64 lg:w-72 bg-white h-full p-8 shadow-lg transform translate-x-full transition-transform duration-300 z-50">
            <h3 class="text-xl font-semibold mb-4">Pesanan Saya</h3>
            <div class="text-center text-gray-500">
                <i class="fas fa-shopping-cart text-6xl mb-4"></i>
                <p>Belum Ada Pesanan</p>
            </div>
            <button class="w-full px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded-full mt-4">
                Silahkan Pilih Pesanan
            </button>
        </div>

        <!-- Main Content -->
        <div id="main-content" class="w-full lg:w-[calc(100%-0px)] p-4 sm:p-8 transition-all duration-300">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row items-center justify-between mb-8 gap-4">
                <div class="text-center sm:text-left">
                    <h1 class="text-3xl sm:text-4xl font-bold text-purple-700">Cafe Ungu</h1>
                    <p class="text-gray-500">Universitas Amikom Purwokerto</p>
                </div>
                <div class="flex items-center gap-2">
                    <input type="text" placeholder="Cari warung atau makanan di sini" class="flex-1 px-4 py-2 border rounded-full w-full sm:w-72 lg:w-96" />
                    <button class="px-4 py-2 bg-purple-700 hover:bg-purple-800 text-white rounded-full">
                        <i class="fas fa-search"></i>
                    </button>
                    <button onclick="toggleSidebar()" class="px-4 py-2 bg-purple-700 hover:bg-purple-800 text-white rounded-full">
                        <i class="fas fa-shopping-cart"></i>
                    </button>
                </div>
            </div>

            <!-- Welcome Banner -->
            <div id="banner" class="bg-purple-700 text-white text-right py-4 px-6 sm:px-2 rounded-lg mb-10 relative">
                <img id="icon-cafung" src="/public/asset/logoCafung.jpg" alt="Logo" class="w-30 sm:w-36 h-28 sm:h-36 rounded-full absolute -top-5 left-[-20px] border-4 border-white object-cover">
                <h2 class="text-lg sm:text-xl lg:text-4xl sm:mx-1 lg:mx-8 font-bold">
                    Selamat Datang di Cafe Ungu <br> Universitas Amikom Purwokerto
                </h2>
            </div>

            <!-- Navigation Buttons -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 justify-items-center mb-6">
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

            <!-- Daftar Makanan -->
            <h3 class="text-xl font-semibold mb-4">Makanan</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg">
                    <img src="https://via.placeholder.com/150" alt="Makanan" class="w-full h-32 object-cover rounded-lg mb-4" />
                    <h4 class="text-lg font-semibold">Ayam Geprek</h4>
                    <p class="text-gray-500">Ayam, sambal, lalapan</p>
                    <div class="mt-4">
                        <span class="text-purple-700 font-bold">Rp 20.000</span>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg">
                    <img src="https://via.placeholder.com/150" alt="Makanan" class="w-full h-32 object-cover rounded-lg mb-4" />
                    <h4 class="text-lg font-semibold">Pentol Bakar</h4>
                    <p class="text-gray-500">Pentol, saus kacang</p>
                    <div class="mt-4">
                        <span class="text-purple-700 font-bold">Rp 20.000</span>
                    </div>
                </div>
            </div>

            <!-- Daftar Minuman -->
            <h3 class="text-xl font-semibold mt-8 mb-4">Minuman</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg">
                    <img src="https://via.placeholder.com/150" alt="Minuman" class="w-full h-32 object-cover rounded-lg mb-4" />
                    <h4 class="text-lg font-semibold">Es Teh</h4>
                    <p class="text-gray-500">Teh segar dengan es</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg">
                    <img src="https://via.placeholder.com/150" alt="Minuman" class="w-full h-32 object-cover rounded-lg mb-4" />
                    <h4 class="text-lg font-semibold">Kopi Susu</h4>
                    <p class="text-gray-500">Kopi dengan susu segar</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.toggle('translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>
</body>
</html>
