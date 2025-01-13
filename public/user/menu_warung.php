<?php

session_start();

include 'midtrans.php';
include '../../config/koneksi.php'; // Koneksi ke database


$kedai_id = isset($_GET['id']) ? intval($_GET['id']) : 0;


if ($kedai_id <= 0) {
    die("Kedai ID tidak valid.");
}

$query_kedai = "SELECT nama_kedai FROM kedai WHERE id = $kedai_id";
$result_kedai = mysqli_query($conn, $query_kedai);

if ($result_kedai && mysqli_num_rows($result_kedai) > 0) {
    $data_kedai = mysqli_fetch_assoc($result_kedai);
    $nama_kedai = $data_kedai['nama_kedai'];
} else {
    $nama_kedai = "Kedai Tidak Ditemukan";
}
$query_produk = "SELECT * FROM produk WHERE kedai_id = $kedai_id";
$result_produk = mysqli_query($conn, $query_produk);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_pemesan'];
    $nim = $_POST['nim_pemesan'];
    $hp = $_POST['hp_pemesan'];
    $pesanan = json_encode($_POST['pesanan']);
    $total_harga = $_POST['total_harga'];

    $params = array(
        'transaction_details' => array(
            'order_id' => rand(),
            'gross_amount' => $total_harga,
        ),
        'customer_details' => array(
            'first_name' => $nama,
            'phone' => $hp,
        ),
    );
    
    $snapToken = \Midtrans\Snap::getSnapToken($params);

    $_SESSION ['snapToken']=$snapToken;

    $query = "INSERT INTO pesanan (nama_pemesan, nim_pemesan, hp_pemesan, pesanan, total_harga, midtrans_id)
              VALUES ('$nama', '$nim', '$hp', '$pesanan', $total_harga, '$snapToken')";
    if ($conn->query($query) === TRUE) {
      
    } else {
        echo "Error: " . $conn->error;
    }
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Kedai</title>
    <link rel="stylesheet" href="/public/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="SB-Mid-client-ln7_50fVY1DIdwBX"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
        }

        /* Sidebar */
        #sidebar {
            transition: transform 0.3s ease-in-out;
        }

        /* Transisi layout */
        #main-content {
            transition: margin-right 0.3s ease-in-out, width 0.3s ease-in-out;
        }

        /* Gaya Kontainer */
        .menu-card {
            transition: transform 0.3s ease;
        }

        .menu-card:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="relative flex">
        <!-- Sidebar -->
        <div id="sidebar" class="fixed top-0 right-0 w-64 lg:w-72 bg-white h-full p-8 shadow-lg hidden">
            <h3 class="text-xl font-semibold mb-4">Pesanan Saya</h3>
            <form id="pembayaran" onsubmit="prosesPembayaran" method="POST">
                <div class="mb-4">
                    <label for="nama-pemesan" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input id="nama-pemesan" name="nama_pemesan" type="text" placeholder="Masukkan Nama"
                        class="w-full px-4 py-2 border rounded-lg mb-2">
                    <label for="nim-pemesan" class="block text-sm font-medium text-gray-700">NIM</label>
                    <input id="nim-pemesan" name="nim_pemesan" type="text" placeholder="Masukkan NIM"
                        class="w-full px-4 py-2 border rounded-lg mb-2">
                    <label for="hp-pemesan" class="block text-sm font-medium text-gray-700">No HP</label>
                    <input id="hp-pemesan" name="hp_pemesan" type="text" placeholder="Masukkan No HP"
                        class="w-full px-4 py-2 border rounded-lg">
                    <input id="total-harga" name="total_harga" type="hidden" value="">
                </div>
            <div id="pesanan-kosong" class="text-center text-gray-500">
                <i class="fas fa-shopping-cart text-6xl mb-4"></i>
                <p>Belum Ada Pesanan</p>
            </div>
            <ul id="list-pesanan" class="space-y-4 hidden"></ul>
            <button id="btn-selesaikan-pesanan" class="w-full px-4 py-2 bg-purple-700 text-white rounded-full mt-4">
                Selesaikan Pesanan
            </button>
        </form>


<!-- Popup Form -->
<div id="popup-pemesanan" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white w-96 p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold mb-4">Informasi Pemesan</h2>
        <form id="form-pemesanan">
            <div class="mb-4">
                <label for="nama-pemesan" class="block text-gray-700">Nama Pemesan</label>
                <input type="text" id="nama-pemesan" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="nim-pemesan" class="block text-gray-700">NIM</label>
                <input type="text" id="nim-pemesan" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <button type="button" onclick="konfirmasiPesanan()" class="w-full bg-green-500 text-white py-2 rounded-lg">
                Konfirmasi Pesanan
            </button>
        </form>
        <button onclick="tutupPopup()" class="text-red-500 mt-4 text-sm underline block text-center">
            Batal
        </button>
    </div>
</div>


        </div>

        <!-- Konten Utama -->
        <div id="main-content" class="w-full lg:w-[calc(100%-0px)] p-8">
            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl lg:text-4xl font-bold text-purple-700"><?= htmlspecialchars($nama_kedai) ?></h1>
            <div class="ml-4">
                    <button onclick="toggleSidebar()" class="px-4 py-2 bg-purple-700 text-white rounded-full">
                        <i class="fas fa-shopping-cart"></i>
                    </button>
                </div>
            </div>

            <!-- Banner -->
            <div class="bg-purple-700 text-white py-4 px-6 rounded-lg mb-8 text-center">
                <h2 class="text-2xl lg:text-3xl font-semibold">Cafe Ungu</h2>
            </div>

            <!-- Daftar Menu -->
            <div class="p-8">
        <!-- Header -->
        <h1 class="text-3xl font-bold mb-4 text-purple-700"><?= htmlspecialchars($nama_kedai) ?></h1>
        <h2 class="text-xl mb-4">Daftar Menu</h2>

        <!-- Daftar Menu -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if ($result_produk && mysqli_num_rows($result_produk) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result_produk)): ?>
                    <div class="menu-card bg-white rounded-lg shadow-md overflow-hidden p-4">
                        <img src="/public/asset/<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['nama_produk']) ?>" class="w-full h-40 object-cover mb-4">
                        <h3 class="text-lg font-semibold mb-2"><?= htmlspecialchars($row['nama_produk']) ?></h3>
                        <p class="text-gray-500 mb-2">Rp <?= number_format($row['harga'], 0, ',', '.') ?></p>
                        <button onclick="tambahPesanan('<?= htmlspecialchars($row['nama_produk']) ?>', <?= $row['harga'] ?>)" class="px-4 py-2 bg-green-500 text-white rounded-full w-full">
                            Tambah Pesanan
                        </button>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-gray-500">Belum ada menu tersedia.</p>
            <?php endif; ?>
        </div>
    </div>
        </div>
    </div>

    <script>

        
        // Fungsi Sidebar
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

        // Fungsi Tambah Pesanan
       // Fungsi Tambah Pesanan
let pesanan = [];

function tambahPesanan(namaMenu, harga) {
    pesanan.push({ nama: namaMenu, harga: harga });
    Swal.fire({
        title: 'Berhasil Ditambahkan!',
        text: `${namaMenu} telah ditambahkan ke keranjang.`,
        icon: 'success',
        confirmButtonText: 'OK',
        timer: 1500,
        timerProgressBar: true
    });
    updateSidebar();
}
function prosesPembayaran(event) {
                event.preventDefault();
                const nama = document.getElementById('nama-pemesan').value.trim();
                const nim = document.getElementById('nim-pemesan').value.trim();
                const hp = document.getElementById('hp-pemesan').value.trim();

                if (!nama || !nim || !hp) {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Harap lengkapi data pemesan!',
                        icon: 'error',
                        confirmButtonText: 'OK',
                    });
                    return;
                }

                // Data siap diproses
                const dataPesanan = {
                    namaPemesan: nama,
                    nimPemesan: nim,
                    hpPemesan: hp,
                    pesanan: pesanan,
                };

                console.log(dataPesanan); // Simpan data ke database di sini

                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Pesanan Anda telah diproses!',
                    icon: 'success',
                    confirmButtonText: 'OK',
                });

                // Reset data
                pesanan = [];
                updateSidebar();
                document.getElementById('pembayaran').submit();
            }

// Fungsi Hapus Pesanan
function hapusPesanan(index) {
    const itemDihapus = pesanan[index];
    pesanan.splice(index, 1); // Hapus item berdasarkan indeks

    Swal.fire({
        title: 'Pesanan Dihapus!',
        text: `${itemDihapus.nama} berhasil dihapus dari keranjang.`,
        icon: 'success',
        confirmButtonText: 'OK',
        timer: 1500,
        timerProgressBar: true
    });
    updateSidebar();
}

// Fungsi Update Sidebar
function updateSidebar() {
    const pesananKosong = document.getElementById('pesanan-kosong');
    const listPesanan = document.getElementById('list-pesanan');
    const btnSelesaikanPesanan = document.getElementById('btn-selesaikan-pesanan');
    let totalHarga = 0;

    // Periksa apakah ada item di array pesanan
    if (pesanan.length > 0) {
        pesananKosong.classList.add('hidden'); // Sembunyikan pesan "Belum Ada Pesanan"
        listPesanan.classList.remove('hidden'); // Tampilkan daftar pesanan
        listPesanan.innerHTML = ''; // Kosongkan daftar sebelumnya

        // Render ulang daftar pesanan
        pesanan.forEach((item, index) => {
            listPesanan.innerHTML += `
                <li class="flex justify-between items-center p-2 border-b">
                    <div>
                        <input name="pesanan[]" class="text-lg font-semibold" value="${item.nama}">

                        <span class="block text-gray-500 text-sm">Rp ${item.harga.toLocaleString()}</span>
                    </div>
                    <button 
                        class="text-red-500 hover:text-red-700 text-sm"
                        onclick="hapusPesanan(${index})">
                        Hapus
                    </button>
                </li>
            `;

            totalHarga += item.harga; // Tambahkan harga item ke total
        });
        document.getElementById('total-harga').value = totalHarga;


        // Perbarui teks tombol dengan total harga
        btnSelesaikanPesanan.textContent = `Selesaikan Pesanan - Total: Rp ${totalHarga.toLocaleString()}`;
        btnSelesaikanPesanan.classList.remove('hidden');
    } else {
        // Tampilkan pesan "Belum Ada Pesanan" jika array kosong
        pesananKosong.classList.remove('hidden');
        listPesanan.classList.add('hidden');

        // Reset teks tombol "Selesaikan Pesanan"
        btnSelesaikanPesanan.textContent = 'Selesaikan Pesanan';
        btnSelesaikanPesanan.classList.add('hidden');
    }
}


            
        
    </script>
     <?php if(isset($_SESSION['snapToken'])):?>
<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    window.snap.pay('<?=$_SESSION['snapToken']?>');
  </script>
  <?php
  session_destroy();
endif;
?>
</body>
</html>
