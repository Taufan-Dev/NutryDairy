<nav class="bg-white shadow-md fixed w-full z-10">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Kiri: Nama Aplikasi + Menu -->
            <div class="flex items-center space-x-8">
                <a href="#" class="text-xl font-bold text-sky-600">NutryDairy</a>
                <div class="hidden md:flex space-x-6">
                    <a href="#" class="relative text-gray-700 hover:text-sky-600 transition duration-300 group">
                        Home
                        <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-sky-500 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#" class="relative text-gray-700 hover:text-sky-600 transition duration-300 group">
                        Artikel
                        <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-sky-500 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#" class="relative text-gray-700 hover:text-sky-600 transition duration-300 group">
                        Kalkulator Gizi
                        <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-sky-500 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                </div>
            </div>

            <!-- Kanan: Profile + Logout -->
            <div class="hidden md:flex space-x-6 items-center">
                <a href="#" class="relative text-gray-700 hover:text-sky-600 transition duration-300 group">
                    Profile
                    <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-sky-500 transition-all duration-300 group-hover:w-full"></span>
                </a>
                <button class="bg-sky-500 hover:bg-sky-600 text-white px-4 py-1 rounded-lg transition duration-300">
                    Logout
                </button>
            </div>

            <!-- Tombol Hamburger -->
            <div class="md:hidden flex items-center">
                <button id="menu-btn" class="text-gray-700 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div id="menu" class="md:hidden hidden bg-white border-t border-gray-200">
        <div class="px-4 py-3 space-y-3">
            <a href="#" class="block relative text-gray-700 hover:text-sky-600 transition duration-300 group">
                Home
                <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-sky-500 transition-all duration-300 group-hover:w-full"></span>
            </a>
            <a href="#" class="block relative text-gray-700 hover:text-sky-600 transition duration-300 group">
                Artikel
                <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-sky-500 transition-all duration-300 group-hover:w-full"></span>
            </a>
            <a href="#" class="block relative text-gray-700 hover:text-sky-600 transition duration-300 group">
                Kalkulator Gizi
                <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-sky-500 transition-all duration-300 group-hover:w-full"></span>
            </a>
            <a href="#" class="block relative text-gray-700 hover:text-sky-600 transition duration-300 group">
                Profile
                <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-sky-500 transition-all duration-300 group-hover:w-full"></span>
            </a>
            <button class="w-full bg-sky-500 hover:bg-sky-600 text-white px-4 py-2 rounded-lg transition duration-300">
                Logout
            </button>
        </div>
    </div>
</nav>

<script>
    const menuBtn = document.getElementById('menu-btn');
    const menu = document.getElementById('menu');

    menuBtn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
</script>