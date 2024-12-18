<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan</title>
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body>
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="flex flex-col justify-between border-e bg-gray-50 w-64">
            <div class="px-4 py-6">
                <div class="grid h-10 w-32 place-content-center rounded-lg ">
                    <img src="/public/asset/logoCafung.jpg" class="w-1/2 rounded-full" alt="">
                </div>
                <ul class="mt-6 space-y-1">
                    <li>
                        <a href="dashboard.html" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700">Dashboard</a>
                    </li>
                    <li>
                        <a href="kelola.html" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700">Kelola Produk</a>
                    </li>
                    <li>
                        <a href="pesanan.html" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700">Pesanan</a>
                    </li>
                    <li>
                        <a href="laporan.html" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700">Laporan Penjualan</a>
                    </li>
                    <li>
                        <a href="setting.html" class="block rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700">Pengaturan</a>
                    </li>
                    <li>
                        <form action="#">
                            <a href="/CafungE/public/login/login.html" type="submit" class="w-full rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700">Logout</a>
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
            <h1 class="text-2xl font-bold mb-4">Pengaturan</h1>
            <div class="bg-white shadow-lg rounded-lg p-4">
                <h2 class="text-lg font-semibold mb-4">Pengaturan Akun</h2>
                <form class="space-y-4">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" id="nama" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="Masukkan nama" value="Admin Penjual">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="Masukkan email" value="admin@penjualan.com">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" id="password" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="Masukkan password baru">
                    </div>
                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
