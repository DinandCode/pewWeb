
<?php

include 'koneksi.php'; // Sesuaikan path ke file koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $kedai_id = isset($_COOKIE['kedai_id']) ? intval($_COOKIE['kedai_id']) : 0;
    if (!$kedai_id) {
        die("Parameter kedai_id tidak valid.");
    }   
    $nama_produk = htmlspecialchars($_POST['nama_produk']);
    $harga = intval($_POST['harga_produk']);
    $stok = intval($_POST['stok_produk']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);

    // Query untuk menyimpan data produk
    $query = "INSERT INTO produk (kedai_id,nama_produk, harga, stok, deskripsi) VALUES ($kedai_id,'$nama_produk', '$harga', '$stok', '$deskripsi')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Produk berhasil ditambahkan.',
                        showConfirmButton: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                        
                            window.location.href = '../public/penjual/kelola.php';
                        }
                    });
                });
              </script>";
    } else {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Gagal menambahkan produk: " . mysqli_error($conn) . "',
                        showConfirmButton: true
                    });
                });
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="/CafungE/public/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <!-- Container Form -->
    <div class="bg-white w-full max-w-lg rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-semibold text-center text-purple-700 mb-4">Tambah Produk</h2>

        <!-- Form Input -->
        <form method="POST">
        <!-- Nama Produk -->
            <div class="mb-4">
                <label for="nama_produk" class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
                <input type="text" id="nama_produk" name="nama_produk" placeholder="Contoh: Nasi Goreng" 
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none" required>
            </div>

            <!-- Harga Produk -->
            <div class="mb-4">
                <label for="harga_produk" class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                <input type="number" id="harga_produk" name="harga_produk" placeholder="Contoh: 20000" 
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none" required>
            </div>

            <!-- Stok Produk -->
            <div class="mb-4">
                <label for="stok_produk" class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
                <input type="number" id="stok_produk" name="stok_produk" placeholder="Contoh: 50" 
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none" required>
            </div>

            <!-- Deskripsi Produk -->
            <div class="mb-4">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="3" placeholder="Contoh: Nasi goreng spesial dengan ayam dan telur" 
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none"></textarea>
            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-purple-700 text-white font-semibold rounded-lg hover:bg-purple-600 focus:outline-none">
                    Tambah Produk
                </button>
            </div>
        </form>
    </div>
</body>
</html>



