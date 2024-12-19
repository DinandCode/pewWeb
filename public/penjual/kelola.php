
<?php

include '../../config/koneksi.php';

$kedai_id = intval($_COOKIE['kedai_id']); 
$query = "SELECT * FROM produk WHERE kedai_id = $kedai_id";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk</title>
    <link rel="stylesheet" href="/CafungE/public/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="flex flex-col justify-between border-e bg-gray-50 w-64">
            <div class="px-4 py-6">
                <div class="grid h-10 w-32 place-content-center rounded-lg">
                    <img src="/public/asset/logoCafung.jpg" class=" w-1/2 rounded-full " alt="">
                </div>
                <ul class="mt-6 space-y-1">
                    
                    <li>
                        <a href="kelola.php" class="block rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700">Kelola Produk</a>
                    </li>
                    <li>
                        <a href="pesanan.php" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700">Pesanan</a>
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
            <h1 class="text-2xl font-bold mb-4">Kelola Produk</h1>
            <a href="tambah_produk.php" class="bg-blue-500 text-white px-4 py-2 rounded-lg mb-4 ">Tambah Produk</a>
            <table class="w-full bg-white mt-5 shadow-md rounded-lg">
            <thead class="bg-gray-700 text-white">
                <tr>
                    <th class="p-4">#</th>
                    <th class="p-4">Nama Produk</th>
                    <th class="p-4">Harga</th>
                    <th class="p-4">Stok</th>
                    <th class="p-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "
                    <tr class='border-b'>
                        <td class='p-4'>{$no}</td>
                        <td class='p-4'>{$row['nama_produk']}</td>
                        <td class='p-4'>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                        <td class='p-4'>{$row['stok']}</td>
                        <td class='p-4'>
                            <a href='edit_produk.php?id={$row['id']}&kedai_id=$kedai_id' class='bg-green-500 text-white px-3 py-1 rounded'>Edit</a>
                            <a href='hapus_produk.php?id={$row['id']}&kedai_id=$kedai_id' class='bg-red-500 text-white px-3 py-1 rounded'>Hapus</a>
                        </td>
                    </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
        </div>
    </div>
</body>
</html>
