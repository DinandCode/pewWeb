<?php
include '../../config/koneksi.php';

$id = intval($_GET['id']);
$kedai_id = intval($_GET['kedai_id']);

$query = "DELETE FROM produk WHERE id = $id AND kedai_id = $kedai_id";
if (mysqli_query($conn, $query)) {
    echo "<script>
            alert('Produk berhasil dihapus!');
            window.location.href = 'kelola.php';
          </script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
