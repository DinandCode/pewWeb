<?php
require __DIR__ . '/../../vendor/autoload.php'; // Path ke autoload Composer

use Google\Client;
use Google\Service\Drive;

// Inisialisasi Google Client
function getClient() {
   
    $client = new Google\Client();
    $client->setClientId('59316830799-9la0qkvpkkpu9ra998rs1c8u2s8egp7k.apps.googleusercontent.com');
    $client->setClientSecret('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');
    $client->refreshToken('1//04ANytfY0R4YNCgYIARAAGAQSNwF-L9IrIHYlgkkFbam5lyOzLseQK4al1AJM0OUw07IP8-1G7A7kS3pTh192OD5YssE3gHcgTy0');

    return $client;
}

// Proses Upload File
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fileUpload'])) {
    $client = getClient();
    $driveService = new Google\Service\Drive($client);

    // File yang diunggah
    $fileName = $_FILES['fileUpload']['name'];
    $fileTmpPath = $_FILES['fileUpload']['tmp_name'];

    $jenisKertas = $_POST['paperType'];
    $jumlahSalinan = $_POST['copies'];

    // Metadata File
    $fileMetadata = new Google\Service\Drive\DriveFile([
        'name' => $fileName
    ]);

    // Unggah File ke Google Drive
    $fileContent = file_get_contents($fileTmpPath);
    $file = $driveService->files->create($fileMetadata, [
        'data' => $fileContent,
        'mimeType' => $_FILES['fileUpload']['type'],
        'uploadType' => 'multipart'
    ]);

        echo "<script> 
        
        const waNumber = '6281944433862'; // Ganti dengan nomor WhatsApp tujuan
            const message = `Halo, saya ingin memesan fotokopi dengan rincian berikut:
- File:   $fileName;
- Jenis Kertas: $jenisKertas;
- Jumlah Salinan: $jumlahSalinan; `;

         

            // Encode pesan agar sesuai format URL
            const encodedMessage = encodeURIComponent(message);

            // Buat URL WhatsApp
            const waUrl = `https://wa.me/\${waNumber}?text=\${message}`;

            // Buka URL di tab baru
            window.location.href=waUrl;
        
        
        </script>";
} else {
    echo "Tidak ada file yang diunggah.";
}
?>
