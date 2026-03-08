<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Mini Aplikasi</title>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    </head>
    <body class="bg-gray-100 flex items-center justify-center min-h-screen">
        <div class="bg-white shadow-lg p-4 w-96">
            <h2 class="text-2xl font-bold mb-4 text-center text-gray-600">Autentikasi Masuk</h2>

            <?php if (!empty($error)){ ?>
                <div class="mb-4 p-3 bg-red-100 border border-red-300 text-red-700 text-sm">
                    <?= $error; ?>
                </div>
            <?php } ?>

            <form method="POST">
                <div class="mb-2">
                    <label class="block text-gray-600 mb-1">E-Mail</label>
                    <input type="email" name="email" class="w-full border p-2 focus:outline-none focus:ring focus:border-blue-300" required autofocus />
                </div>
                <div class="mb-3">
                    <label class="block text-gray-600 mb-1">Password</label>
                    <input type="password" name="password" class="w-full border p-2 focus:outline-none focus:ring focus:border-blue-300" required autofocus />
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-2 hover:bg-blue-700">
                    Login
                </button>
            </form>
        </div>
    </body>
</html>