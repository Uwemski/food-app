@props(['title' => 'Dashboard'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Sidebar + Content wrapper -->
    <div class="flex">

        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white min-h-screen hidden md:block">
            <div class="p-6 font-bold text-xl">
                Admin Panel
            </div>

            <nav class="px-4 space-y-2">
                <a href="#" class="block px-3 py-2 rounded hover:bg-gray-800">Dashboard</a>
                <a href="#" class="block px-3 py-2 rounded hover:bg-gray-800">Users</a>
                <a href="#" class="block px-3 py-2 rounded hover:bg-gray-800">Products</a>
                <a href="#" class="block px-4 py-2 rounded hover:bg-gray-100">Orders</a>
                <a href="#" class="block px-4 py-2 rounded hover:bg-gray-100">Settings</a>
            </nav>
        </aside>

        <!-- Main content -->
        <main class="flex-1 p-6">
            {{ $slot }}
        </main>

    </div>

</body>
</html>
