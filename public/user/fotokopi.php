<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fotokopi - Cafe Ungu</title>
    <link rel="stylesheet" href="/CafungE/public/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .container {
            max-width: 768px;
            margin: 0 auto;
            padding: 20px;
        }

        .btn {
            background-color: #6b46c1;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #553c9a;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .input-group select, .input-group input[type="number"], .input-group input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }
    </style>
</head>
<body class="bg-gray-100">
   

        <!-- Main Content -->
        <div id="main-content" class="w-full lg:w-[calc(100%-0px)] p-8">
            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center">
                    <div class="ml-4">
                        <a href="index.php" class="btn-back">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>
                
                
            </div>

            <!-- Welcome Banner -->
            <div id="banner" class="bg-purple-700 text-white text-right py-4 px-6 pr-2 w-15 pl-15 rounded-lg mb-8 relative mx-auto">
                <img id="icon-cafung" src="/CafungE/public/asset/logoCafung.jpg" alt="" class="w-44 h-44 rounded-full absolute top-[-30px] left-[-20px] border-4 border-white">
                <h2 id="selamatDatang" class="text-2xl lg:text-4xl px-10 font-semibold">Selamat Datang di Cafe Ungu <br> Universitas Amikom Purwokerto</h2>
            </div >

          

            <!-- Form Fotokopi -->
            <div class="container">
                <h3 class="text-xl font-semibold mb-4">Fotokopi</h3>
                <p class="text-gray-500 mb-6">Unggah file Anda dan pilih detail fotokopi.</p>
                <form id="fotokopiForm">
                    <!-- Unggah File -->
                    <div class="input-group">
                        <label for="fileUpload">Unggah File</label>
                        <input type="file" id="fileUpload" name="fileUpload" accept=".pdf,.doc,.docx" required>
                        <small class="text-gray-500">Format yang didukung: PDF, DOC, DOCX</small>
                    </div>

                    <!-- Pilih Jenis Kertas -->
                    <div class="input-group">
                        <label for="paperType">Jenis Kertas</label>
                        <select id="paperType" name="paperType" required>
                            <option value="">Pilih jenis kertas</option>
                            <option value="A4">A4</option>
                            <option value="A3">A3</option>
                            <option value="Legal">Legal</option>
                        </select>
                    </div>

                    <!-- Jumlah Salinan -->
                    <div class="input-group">
                        <label for="copies">Jumlah Salinan</label>
                        <input type="number" id="copies" name="copies" min="1" value="1" required>
                    </div>

                    <!-- Tombol Submit -->
                    <button type="submit" class="btn w-full">Pesan Fotokopi</button>
                </form>
            </div>
        </div>
    </div>

    <script>
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
    </script>
</body>
</html>
