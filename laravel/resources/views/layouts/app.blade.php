<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow px-6 py-3 flex justify-between items-center">
        <!-- Brand -->
        <div>
            <a href="{{ url('/') }}" class="text-2xl font-bold text-blue-600">Task Manager</a>
        </div>

        <!-- Menu -->
        <div class="flex space-x-6">
            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('projects.index') }}" 
                       class="text-gray-700 hover:text-blue-600">Projects</a>
                    <a href="{{ route('tasks.index') }}" 
                       class="text-gray-700 hover:text-blue-600">Tasks</a>
                @endif
            @endauth
        </div>

        <!-- Auth Button -->
        <div>
            @auth
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" 
                            class="bg-red-500 text-white px-4 py-1 rounded-lg hover:bg-red-600">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" 
                   class="bg-blue-500 text-white px-4 py-1 rounded-lg hover:bg-blue-600">
                    Login
                </a>
            @endauth
        </div>
    </nav>

    <!-- Page Content -->
    <main class="p-6">
        @yield('content')
    </main>

</body>
</html>
