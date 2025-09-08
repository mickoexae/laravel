<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Task Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500">

    <div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-md">
        <!-- Judul -->
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">
            🔑 Login ke Task Manager
        </h2>

        <!-- Form -->
        <form method="POST" action="{{ url('/login') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" required autofocus
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- Error Message -->
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 px-4 py-2 rounded-lg text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Tombol Login -->
            <button type="submit"
                class="w-full bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-indigo-700 transition duration-200">
                Masuk
            </button>
        </form>

        <!-- Footer -->
        <p class="text-center text-sm text-gray-500 mt-6">
            © {{ date('Y') }} Task Manager. All rights reserved.
        </p>
    </div>

</body>
</html>
