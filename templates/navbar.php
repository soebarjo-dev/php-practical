<div class="flex-1 flex flex-col">
    <header class="bg-white shadow p-2 flex justify-between">
        <h1 class="text-xl text-white">Sistem Aplikasi Mini</h1>
        <div class="relative">
            <button onclick="toggleDropdown()" class="flex items-center space-x-2 bg-gray-100 px-2 py-1 hover:bg-gray-200 focus:outline-none">
                <span class="text-gray-700 text-sm font-medium">
                    <?= current_user('name') ?>
                </span>
            </button>

            <div id="profileDropdown" class="hidden absolute right-0 mt-0.5 w-20 bg-gray-100 border border-gray-400">
                <a href="#" class="block p-1 hover:bg-gray-100 text-gray-700 text-sm">Profile</a>
                <a href="#" class="block p-1 hover:bg-gray-100 text-gray-700 text-sm">Keluar</a>
            </div>
        </div>
    </header>
    <main class="p-2">