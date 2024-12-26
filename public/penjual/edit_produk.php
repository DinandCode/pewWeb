<?php
include '../../config/koneksi.php';

$id = intval($_GET['id']);
$kedai_id = intval($_GET['kedai_id']);

// Ambil data produk berdasarkan ID
$query = "SELECT * FROM produk WHERE id = $id AND kedai_id = $kedai_id";
$result = mysqli_query($conn, $query);
$produk = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_produk = mysqli_real_escape_string($conn, $_POST['nama_produk']);
    $harga = floatval($_POST['harga']);
    $stok = intval($_POST['stok']);

    $update_query = "UPDATE produk SET nama_produk='$nama_produk', harga=$harga, stok=$stok WHERE id=$id AND kedai_id=$kedai_id";
    if (mysqli_query($conn, $update_query)) {
        echo "<script>
                alert('Produk berhasil diperbarui!');
                window.location.href = 'kelola.php';
              </script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Edit Produk</h1>
        <form method="POST" class="space-y-4">
            <div>
                <label for="nama_produk" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                <input type="text" name="nama_produk" id="nama_produk" 
                       value="<?= htmlspecialchars($produk['nama_produk'], ENT_QUOTES); ?>" 
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       required>
            </div>
            <div>
                <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                <input type="number" name="harga" id="harga" 
                       value="<?= htmlspecialchars($produk['harga'], ENT_QUOTES); ?>" 
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       required>
            </div>
            <div>
                <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
                <input type="number" name="stok" id="stok" 
                       value="<?= htmlspecialchars($produk['stok'], ENT_QUOTES); ?>" 
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       required>
            </div>
            <div class="flex justify-between mt-6">
                <a href="kelola.php" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Batal</a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>
