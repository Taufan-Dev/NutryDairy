<section class="max-w-4xl mx-auto px-6 py-16">

    @php
    // Slug yang dirender sebagai infografis (bukan teks Quill biasa).
    $infografis = [
        'yuk-pahami-label-gizi'        => 'sections.infografis.label-gizi',
        'praktik-pemberian-makan-anak' => 'sections.infografis.pemberian-makan-anak',
        'isi-piringku-untuk-batita'    => 'sections.infografis.isi-piringku-batita',
    ];
    $isInfografis = isset($infografis[$content->slug]);
    @endphp

    @unless ($isInfografis)
        <h1 class="text-3xl font-bold mb-6">{{ $content->title }}</h1>
    @endunless

    <!-- === PRETEST === -->
    {{-- Hanya tampilkan pretest bila ada soal; jika tidak, konten langsung tampil. --}}
    @if (is_null($pretestResult?->score) && $pretestQuestions->isNotEmpty())
        <div x-data="{ openPretest: true }">

            <!-- Modal -->
            <div x-show="openPretest" class="fixed inset-0 z-50 bg-black bg-opacity-40 flex items-center justify-center"
                x-transition>

                <div class="bg-white rounded-xl shadow-lg w-full max-w-xl p-6 max-h-[80vh] overflow-y-auto"
                    x-transition.scale>

                    <h2 class="text-xl font-semibold mb-4">Pretest</h2>

                    <form action="{{ route('article.pretest.submit', $content->id) }}" method="POST">
                        @csrf

                        @foreach ($pretestQuestions as $q)
                            <div class="mb-4">
                                <p class="font-bold text-gray-800">{{ $loop->iteration }}. {{ $q->question }}</p>

                                @foreach ($q->options as $opt)
                                    <label class="block mt-1">
                                        <input type="radio" name="answers[{{ $q->id }}]"
                                            value="{{ $opt }}" required>
                                        {{ $opt }}
                                    </label>
                                @endforeach
                            </div>
                        @endforeach

                        <div class="mt-6 flex justify-end">
                            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                Submit Pretest
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        @php return; @endphp
    @endif
    <!-- END PRETEST -->

    <!-- === KONTEN (INFOGRAFIS / ARTIKEL / VIDEO) === -->
    @if ($isInfografis)
        @include($infografis[$content->slug])
    @else
    <div class="bg-white shadow p-6 rounded-xl mb-10">

        @if ($content->media_type === 'video')

            @php
                function youtubeId($url)
                {
                    preg_match(
                        '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',
                        $url,
                        $match,
                    );
                    return $match[1] ?? null;
                }

                $videoId = youtubeId($content->media_url);
            @endphp


            @if ($videoId)
                <a href="{{ $content->media_url }}" target="_blank"
                    class="relative block aspect-video bg-black rounded overflow-hidden">

                    <img src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg"
                        class="w-full h-full object-cover opacity-80">

                    <div class="absolute inset-0 flex items-center justify-center">
                        <svg class="w-20 h-20 text-white opacity-90" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z" />
                        </svg>
                    </div>

                    <span class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded">
                        Tonton di YouTube
                    </span>
                </a>
            @endif
        @else
            <div class="article-content ql-editor prose prose-lg max-w-none">
                {!! $content->content !!}
            </div>
        @endif
    </div>
    @endif

    <!-- === POSTTEST === -->
    @if ($content->type === 'pengetahuan' && $posttestQuestions->isNotEmpty() && !is_null($pretestResult?->score) && is_null($posttestResult?->score))
        <div class="mt-6">
            <button x-data x-on:click="$dispatch('open-posttest')"
                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                Lanjut ke Posttest
            </button>
        </div>
    @endif

    <div x-data="{ openPosttest: false }" x-on:open-posttest.window="openPosttest = true">
        <div x-show="openPosttest" class="fixed inset-0 z-50 bg-black bg-opacity-40 flex items-center justify-center"
            x-transition>
            <div class="bg-white rounded-xl shadow-lg w-full max-w-xl p-6 max-h-[80vh] overflow-y-auto"
                x-transition.scale>
                <h2 class="text-xl font-semibold mb-4">Posttest</h2>

                <form action="{{ route('article.posttest.submit', $content->id) }}" method="POST">
                    @csrf

                    @foreach ($posttestQuestions as $q)
                        <div class="mb-4">
                            <p class="font-bold text-gray-800">{{ $loop->iteration }}. {{ $q->question }}</p>

                            @foreach ($q->options as $opt)
                                <label class="block mt-1">
                                    <input type="radio" name="answers[{{ $q->id }}]"
                                        value="{{ $opt }}" required>
                                    {{ $opt }}
                                </label>
                            @endforeach
                        </div>
                    @endforeach

                    <div class="mt-6 flex justify-end">
                        <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            Selesai Posttest
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
