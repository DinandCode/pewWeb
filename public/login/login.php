<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/CafungE/public/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-md">
            <h1 class="text-2xl font-bold mb-6 text-center">Login</h1>
            <form id="loginForm" class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="Masukkan email" required>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="Masukkan password" required>
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white w-full py-2 rounded-lg hover:bg-blue-600">Login</button>
                </div>
            </form>
            <div id="errorMessage" class="text-red-500 text-sm mt-4 hidden">Email atau password salah!</div>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', async function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            try {
        const response = await fetch('../../config/login.php', {
            method: 'POST',
            body: formData
        });

        const data = await response.json();
        if (data.status === 'success') {
            window.location.href = data.redirect;
        } else {
            document.getElementById('errorMessage').textContent = data.message;
            document.getElementById('errorMessage').classList.remove('hidden');
        }
    } catch (error) {
        console.error('Error:', error);
        document.getElementById('errorMessage').textContent = 'Terjadi kesalahan, coba lagi!';
        document.getElementById('errorMessage').classList.remove('hidden');
    }
        });
    </script>
</body>
</html>
