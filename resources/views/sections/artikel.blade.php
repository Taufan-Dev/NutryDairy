<section class="min-h-screen flex items-center justify-center px-6 py-16">
    <div class="grid md:grid-cols-2 gap-8 justify-center">

        <!-- Pengetahuan Gizi -->
        <a href="{{ route('article.category', 'pengetahuan') }}"
            class="block bg-white shadow-lg rounded-xl overflow-hidden hover:shadow-xl transition">
            <img src="https://source.unsplash.com/800x500/?nutrition,health" class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="text-2xl font-semibold mb-2">Pengetahuan Gizi</h3>
                <p class="text-gray-600">
                    Berisi artikel, buku saku, dan bacaan gizi lainnya.
                </p>
            </div>
        </a>

        <!-- Keterampilan Gizi -->
        <a href="{{ route('article.category', 'keterampilan') }}"
            class="block bg-white shadow-lg rounded-xl overflow-hidden hover:shadow-xl transition">
            <img src="https://source.unsplash.com/800x500/?cooking,video" class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="text-2xl font-semibold mb-2">Keterampilan Gizi</h3>
                <p class="text-gray-600">
                    Berisi video edukasi terkait keterampilan gizi.
                </p>
            </div>
        </a>

    </div>
</section>
