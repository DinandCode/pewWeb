<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan</title>
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body>
<div class="flex flex-col lg:flex-row h-screen">
        <!-- Sidebar -->
        <div class="flex flex-col justify-between border-e bg-gray-50 w-full lg:w-64 lg:static fixed inset-0 z-40 overflow-y-auto lg:overflow-visible transition-transform transform -translate-x-full lg:translate-x-0" id="sidebar">
            <div class="px-4 py-6">
                <div class="grid h-10 w-32 place-content-center rounded-lg ">
                    <img src="/public/asset/logoCafung.jpg" class="w-1/2 rounded-full" alt="">
                </div>
                <ul class="mt-6 space-y-1">
                    <li>
                        <a href="kelola.php" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700">Kelola Produk</a>
                    </li>
                    <li>
                        <a href="pesanan.php" class="block rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700">Pesanan</a>
                    </li>
                    <li>
                        <a href="laporan.php" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700">Laporan Penjualan</a>
                    </li>
                    <li>
                        <a href="setting.php" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700">Pengaturan</a>
                    </li>
                    <li>
                        <form action="#">
                            <a href="/CafungE/public/login/login.php" type="submit" class="w-full text-center rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700">Logout</a>
                        </form>
                    </li>
                </ul>
            </div>
            <div class="sticky inset-x-0 bottom-0 border-t border-gray-100">
                <a href="#" class="flex items-center gap-2 bg-white p-4 hover:bg-gray-50">
                    <img alt="" src="https://images.unsplash.com/photo-1600486913747-55e5470d6f40?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80" class="h-10 w-10 rounded-full object-cover" />
                    <div>
                        <p class="text-xs">
                            <strong class="block font-medium">Admin Penjual</strong>
                            <span>admin@penjualan.com</span>
                        </p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <button class="lg:hidden bg-blue-500 text-white px-4 py-2 rounded-lg mb-4" onclick="toggleSidebar()">Menu</button>
            <h1 class="text-2xl font-bold mb-4">Pesanan</h1>
            <div class="overflow-x-auto">
                <table class="w-full bg-white shadow-lg rounded-lg">
                    <thead>
                        <tr class="bg-gray-700 text-white">
                            <th class="p-4">#</th>
                            <th class="p-4">Nama Pembeli</th>
                            <th class="p-4">Pesanan</th>
                            <th class="p-4">Total Harga</th>
                            <th class="p-4">Status</th>
                            <th class="p-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td class="p-4">1</td>
                            <td class="p-4">John Doe</td>
                            <td class="p-4">2 Nasi Goreng, 1 Es Teh</td>
                            <td class="p-4">Rp 50.000</td>
                            <td class="p-4 text-yellow-600">Menunggu</td>
                            <td class="p-4 flex flex-wrap gap-2">
                                <button class="bg-green-500 text-white px-4 py-1 rounded-lg hover:bg-green-600 transition">Konfirmasi</button>
                                <button class="bg-red-500 text-white px-4 py-1 rounded-lg hover:bg-red-600 transition">Batalkan</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }
    </script>
</body>
</html>
