<?php
session_start();

include 'midtrans.php';
include '../../config/koneksi.php'; // Koneksi ke database

// Ambil data produk secara acak
$query = "SELECT p.nama_produk, p.harga, p.deskripsi, p.gambar, k.nama_kedai 
          FROM produk p 
          JOIN kedai k ON p.kedai_id = k.id 
          ORDER BY RAND() LIMIT 8"; // Ambil 8 produk secara acak

$result = $conn->query($query);

$produk = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $produk[] = $row;
    }
} else {
    echo "Tidak ada produk ditemukan.";
}

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


$conn->close(); // Tutup koneksi


?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafe Ungu</title>
    <link rel="stylesheet" href="/public/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-ln7_50fVY1DIdwBX"></script>

</head>

<body class="bg-gray-100 font-poppins relative">
    <!-- Overlay for Sidebar -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden" onclick="toggleSidebar()"></div>

    <div class="relative flex">
        <!-- Sidebar -->
        <div id="sidebar"
            class="fixed top-0 right-0 w-64 lg:w-72 bg-white h-full p-8 shadow-lg transform translate-x-full transition-transform duration-300 z-50">
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
                <div class="text-center text-gray-500">
                    <i class="fas fa-shopping-cart text-6xl mb-4"></i>
                    <p>Belum Ada Pesanan</p>
                </div>
                <button class="w-full px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded-full mt-4">
                    Proses Pembayaran
                </button>
    </div>
    </form>


    <!-- Main Content -->
    <div id="main-content" class="w-full lg:w-[calc(100%-0px)] p-4 sm:p-8 transition-all duration-300">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row items-center justify-between mb-8 gap-4">
            <div class="text-center sm:text-left">
                <h1 class="text-3xl sm:text-4xl font-bold text-purple-700">Cafe Ungu</h1>
                <p class="text-gray-500">Universitas Amikom Purwokerto</p>
            </div>
            <div class="flex items-center gap-2">
                <input id="search-bar" type="text" placeholder="Cari warung atau makanan di sini"
                    class="flex-1 px-4 py-2 border rounded-full w-full sm:w-72 lg:w-96" />
                <button class="px-4 py-2 bg-purple-700 hover:bg-purple-800 text-white rounded-full">
                    <i class="fas fa-search"></i>
                </button>
                <button onclick="toggleSidebar()"
                    class="px-4 py-2 bg-purple-700 hover:bg-purple-800 text-white rounded-full">
                    <i class="fas fa-shopping-cart"></i>
                </button>
            </div>
        </div>

        <!-- Welcome Banner -->
        <div id="banner" class="bg-purple-700 text-white text-right py-4 px-6 sm:px-2 rounded-lg mb-10 relative">
            <img id="icon-cafung" src="/public/asset/logoCafung.jpg" alt="Logo"
                class="w-30 sm:w-36 h-28 sm:h-36 rounded-full absolute -top-5 left-[-20px] border-4 border-white object-cover">
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
        <div id="snap-container"></div>
        <h3 class="text-xl font-semibold mb-4">Makanan</h3>
            <div id="product-grid" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                <?php if (!empty($produk)): ?>
                    <?php foreach ($produk as $item): ?>
                        <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg">
                            <img src="/public/asset/<?php echo htmlspecialchars($item['gambar']); ?>" alt="Makanan"
                                class="w-full h-32 object-cover rounded-lg mb-4" />
                            <h4 class="text-lg font-semibold"><?php echo htmlspecialchars($item['nama_produk']); ?></h4>
                            <p class="text-gray-500"><?php echo htmlspecialchars($item['deskripsi']); ?></p>
                            <div class="mt-4">
                                <span class="text-purple-700 font-bold">Rp
                                    <?php echo number_format($item['harga'], 0, ',', '.'); ?></span>
                                <button
                                    onclick="tambahPesanan('<?php echo htmlspecialchars($item['nama_produk']); ?>', <?php echo $item['harga']; ?>)"
                                    class="px-4 py-2 bg-green-500 text-white rounded-full w-full">
                                    Tambah
                                </button>
                            </div>
    
    
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Tidak ada produk yang tersedia.</p>
                <?php endif; ?>
            </div>

     


        <script>


            // cari makanan
            const searchBar = document.getElementById('search-bar');
            const productGrid = document.getElementById('product-grid');
            const allProductsHTML = productGrid.innerHTML; // Simpan HTML asli produk

            searchBar.addEventListener('input', function () {
                const query = searchBar.value.toLowerCase().trim(); // Ambil nilai pencarian dan ubah ke huruf kecil
                if (query === '') {
                    productGrid.innerHTML = allProductsHTML; // Tampilkan semua produk jika input kosong
                    return;
                }

                const filteredProducts = [...productGrid.children].filter(product => {
                    const productName = product.querySelector('h4').textContent.toLowerCase(); // Ambil nama produk
                    return productName.includes(query); // Filter produk berdasarkan query
                });

                productGrid.innerHTML = ''; // Kosongkan grid produk
                filteredProducts.forEach(product => productGrid.appendChild(product)); // Tambahkan produk yang cocok
            });

            // tambah pesanan 
            let pesanan = [];
            function tambahPesanan(namaProduk, harga) {

                pesanan.push({ nama: namaProduk, harga: harga });
                Swal.fire({
                    title: 'Berhasil!',
                    text: `Produk "${namaProduk}" berhasil ditambahkan ke keranjang!`,
                    icon: 'success',
                    confirmButtonText: 'OK',
                    timer: 1500,
                    timerProgressBar: true,
                });

                updateSidebar();
            }
            function hapusPesanan(index) {
                pesanan.splice(index, 1);

                Swal.fire({
                    title: 'Pesanan Dihapus!',
                    text: 'Pesanan berhasil dihapus dari keranjang.',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    timer: 1500,
                    timerProgressBar: true,
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


            function updateSidebar() {
                const listPesananContainer = document.querySelector('.text-center.text-gray-500');
                const totalButton = document.querySelector('.w-full.bg-purple-500');

                listPesananContainer.innerHTML = '';

                if (pesanan.length === 0) {
                    listPesananContainer.innerHTML = `
                <i class="fas fa-shopping-cart text-6xl mb-4"></i>
                <p>Belum Ada Pesanan</p>
            `;
                    totalButton.textContent = 'Silahkan Pilih Pesanan';
                    return;
                }

                let totalHarga = 0;
                const ul = document.createElement('ul');
                ul.classList.add('mb-4', 'text-left');
                pesanan.forEach((item, index) => {
                    const li = document.createElement('li');
                    li.classList.add('flex', 'justify-between', 'items-center', 'border-b', 'pb-2', 'mb-2');
                    li.innerHTML = `
                <div>
                    <input name="pesanan[]" class="text-lg font-semibold" value="${item.nama}">

                    <span class="block text-gray-500 text-sm">Rp ${item.harga.toLocaleString()}</span>
                </div>
                <button 
                    class="text-red-500 hover:text-red-700 text-sm"
                    onclick="hapusPesanan(${index})">
                    Hapus
                </button>
            `;
                    ul.appendChild(li);
                    totalHarga += item.harga;
                });
                listPesananContainer.appendChild(ul);
                document.getElementById('total-harga').value = totalHarga;
                totalButton.textContent = `Total: Rp ${totalHarga.toLocaleString()}`;
            }

            function toggleSidebar() {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('overlay');
                sidebar.classList.toggle('translate-x-full');
                overlay.classList.toggle('hidden');
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