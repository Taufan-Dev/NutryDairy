<section class="min-h-screen flex items-center justify-center px-6 py-16">
    <div class="grid md:grid-cols-2 gap-8 justify-center">

        @php
            $pengetahuanItem = $pengetahuan->last();
            $keterampilanItem = $keterampilan->last();

            function youtubeThumbnail($url)
            {
                preg_match(
                    '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',
                    $url,
                    $match,
                );
                return isset($match[1]) ? "https://img.youtube.com/vi/{$match[1]}/hqdefault.jpg" : null;
            }
        @endphp

        <!-- Pengetahuan Gizi -->
        <a href="{{ route('article.category', 'pengetahuan') }}"
            class="block bg-white shadow-lg rounded-xl overflow-hidden hover:shadow-xl transition">
            <img src="{{ $pengetahuanItem && $pengetahuanItem->thumbnail
                ? asset('storage/' . $pengetahuanItem->thumbnail)
                : asset('assets/img/default-thumb.png') }}"
                class="w-full h-48 object-cover">
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
            <img src="{{ $keterampilanItem && $keterampilanItem->thumbnail
                ? $keterampilanItem->thumbnail
                : asset('assets/img/default-thumb.png') }}"
                class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="text-2xl font-semibold mb-2">Keterampilan Gizi</h3>
                <p class="text-gray-600">
                    Berisi video edukasi terkait keterampilan gizi.
                </p>
            </div>
        </a>

    </div>
</section>
