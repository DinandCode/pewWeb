<?php
include '../../config/koneksi.php'; // Koneksi ke database

// Ambil query pencarian dari request
$keyword = isset($_GET['q']) ? $_GET['q'] : '';

if (!empty($keyword)) {
    // Query untuk mencari produk berdasarkan nama
    $query = "SELECT p.nama_produk, p.harga, p.deskripsi, p.gambar, k.nama_kedai 
              FROM produk p 
              JOIN kedai k ON p.kedai_id = k.id 
              WHERE p.nama_produk LIKE ?";

    $stmt = $conn->prepare($query);
    $likeKeyword = '%' . $keyword . '%';
    $stmt->bind_param('s', $likeKeyword);
    $stmt->execute();
    $result = $stmt->get_result();

    $produk = [];
    while ($row = $result->fetch_assoc()) {
        $produk[] = $row;
    }

    // Kembalikan hasil dalam format JSON
    echo json_encode($produk);
} else {
    echo json_encode([]);
}

$conn->close(); // Tutup koneksi
?>
