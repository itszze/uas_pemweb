<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- CDN TailwindCSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 antialiased">
    <div class="min-h-screen flex flex-col">
        {{-- Navbar --}}
        <nav class="bg-white border-b shadow py-4 px-6 flex justify-between items-center">
        <a href="/" class="text-xl font-bold text-blue-700">STUZEE</a>
        <div class="flex items-center gap-4">
                <span>👤 {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-red-600 hover:underline" type="submit">Logout</button>
                </form>
            </div>
        </nav>

        {{-- Content --}}
        <main class="flex-1">
            @yield('content')
        </main>

        {{-- Footer --}}
        <footer class="bg-white text-center text-sm py-4 border-t mt-6">
            &copy; {{ date('Y') }} To-Do App. All rights reserved.
        </footer>
    </div>
</body>
</html>
