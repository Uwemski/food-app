<header class="bg-white shadow px-6 py-4 flex justify-between items-center">
    <div class="md:hidden">
        <button onclick="toggleSidebar()" class="text-gray-600">
            ☰
        </button>
    </div>

    <h1 class="text-lg font-semibold">
        Dashboard
    </h1>

    <div class="flex items-center gap-3">
        <span class="text-sm text-gray-600">Admin</span>
        <img src="https://i.pravatar.cc/40" class="rounded-full" />
    </div>
</header>

<script>
    function toggleSidebar() {
        document.getElementById('mobileSidebar').classList.toggle('hidden');
    }
</script>
