<section class="max-w-6xl mx-auto px-6 py-16">
    <h2 class="text-4xl font-bold mb-8">
        {{ ucfirst($category) }} Gizi
    </h2>

    <div class="grid md:grid-cols-3 gap-6">
        @foreach ($contents as $item)
        <a href="{{ route('article.detail', $item->slug) }}"
           class="block bg-white rounded-xl shadow hover:shadow-lg transition">
            <img src="{{ asset('storage/' . $item->thumbnail) }}"
                 class="w-full h-40 object-cover rounded-t-xl">
            <div class="p-4">
                <h3 class="text-lg font-semibold mb-1">{{ $item->title }}</h3>
                <p class="text-gray-600 text-sm">{{ Str::limit(strip_tags($item->content), 80) }}</p>
            </div>
        </a>
        @endforeach
    </div>
</section>