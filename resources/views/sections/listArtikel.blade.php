<section class="max-w-7xl mx-auto px-6 py-16">
    <h2 class="text-5xl font-bold  mb-6 bg-gradient-to-r from-sky-500 to-purple-600 bg-clip-text text-transparent">
        Artikel Terbaru
    </h2>

    <!-- Wrapper scroll -->
    <div id="artikel-scroll"
        class="flex space-x-6 overflow-x-auto pb-4 cursor-grab scroll-smooth select-none">

        <!-- Artikel 1 -->
        <article class="min-w-[280px] bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
            <img src="https://source.unsplash.com/400x250/?nutrition" alt="Artikel 1" class="w-full h-48 object-cover">
            <div class="p-4">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Pentingnya Sarapan Bergizi</h3>
                <p class="text-gray-600 text-sm">Kenali manfaat sarapan sehat bagi pertumbuhan dan energi anak.</p>
            </div>
        </article>

        <!-- Artikel 2 -->
        <article class="min-w-[280px] bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
            <img src="https://source.unsplash.com/400x250/?healthy-food" alt="Artikel 2" class="w-full h-48 object-cover">
            <div class="p-4">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Cara Mudah Mengenalkan Sayur</h3>
                <p class="text-gray-600 text-sm">Trik agar balita suka sayur tanpa paksaan dan tetap ceria.</p>
            </div>
        </article>

        <!-- Artikel 3 -->
        <article class="min-w-[280px] bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
            <img src="https://source.unsplash.com/400x250/?kids-meal" alt="Artikel 3" class="w-full h-48 object-cover">
            <div class="p-4">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Menu Seimbang untuk Balita</h3>
                <p class="text-gray-600 text-sm">Kombinasi karbo, protein, dan sayur untuk tumbuh kembang optimal.</p>
            </div>
        </article>

        <!-- Artikel 4 -->
        <article class="min-w-[280px] bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
            <img src="https://source.unsplash.com/400x250/?vitamins" alt="Artikel 4" class="w-full h-48 object-cover">
            <div class="p-4">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Vitamin Penting untuk Anak</h3>
                <p class="text-gray-600 text-sm">Ketahui jenis vitamin yang penting dalam masa pertumbuhan.</p>
            </div>
        </article>

        <!-- Artikel 5 -->
        <article class="min-w-[280px] bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
            <img src="https://source.unsplash.com/400x250/?fruits" alt="Artikel 5" class="w-full h-48 object-cover">
            <div class="p-4">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Buah Favorit Balita</h3>
                <p class="text-gray-600 text-sm">Buah kaya serat dan vitamin yang cocok untuk si kecil.</p>
            </div>
        </article>

    </div>
</section>

<script>
    // Script drag-to-scroll
    const scrollContainer = document.getElementById('artikel-scroll');
    let isDown = false;
    let startX;
    let scrollLeft;

    scrollContainer.addEventListener('mousedown', (e) => {
        isDown = true;
        scrollContainer.classList.add('cursor-grabbing');
        startX = e.pageX - scrollContainer.offsetLeft;
        scrollLeft = scrollContainer.scrollLeft;
    });

    scrollContainer.addEventListener('mouseleave', () => {
        isDown = false;
        scrollContainer.classList.remove('cursor-grabbing');
    });

    scrollContainer.addEventListener('mouseup', () => {
        isDown = false;
        scrollContainer.classList.remove('cursor-grabbing');
    });

    scrollContainer.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - scrollContainer.offsetLeft;
        const walk = (x - startX) * 2; // kecepatan scroll
        scrollContainer.scrollLeft = scrollLeft - walk;
    });
</script>