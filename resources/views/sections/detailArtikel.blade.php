<section class="max-w-4xl mx-auto px-6 py-16">

    <h1 class="text-3xl font-bold mb-6">{{ $content->title }}</h1>

    <!-- === PRETEST === -->
    @if ($content->type === 'pengetahuan' && is_null($pretestResult?->score))
        <div x-data="{ openPretest: true }">

            <!-- Modal -->
            <div x-show="openPretest" class="fixed inset-0 z-50 bg-black bg-opacity-40 flex items-center justify-center"
                x-transition>

                <div class="bg-white rounded-xl shadow-lg w-full max-w-xl p-6" x-transition.scale>

                    <h2 class="text-xl font-semibold mb-4">Pretest</h2>

                    <form action="{{ route('article.pretest.submit', $content->id) }}" method="POST">
                        @csrf

                        @foreach ($pretestQuestions as $q)
                            <div class="mb-4">
                                <p class="font-medium text-gray-800">{{ $q->question }}</p>

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


    <!-- === KONTEN (ARTIKEL / VIDEO) === -->
    <div class="bg-white shadow p-6 rounded-xl mb-10">
        <h2 class="text-xl font-semibold mb-4">Materi</h2>

        @if ($content->media_type === 'video')
            <video controls class="w-full rounded">
                <source src="{{ $content->media_url }}" type="video/mp4">
            </video>
        @else
            <div class="prose max-w-none">
                {!! $content->content !!}
            </div>
        @endif
    </div>

    <!-- === POSTTEST === -->
    @if ($content->type === 'pengetahuan' && !is_null($pretestResult?->score) && is_null($posttestResult?->score))
        <div class="mt-6">
            <button x-data x-on:click="$dispatch('open-posttest')"
                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                Lanjut ke Posttest
            </button>
        </div>
    @endif

<div x-data="{ openPosttest: false }" 
     x-on:open-posttest.window="openPosttest = true">
    <div x-show="openPosttest"
         class="fixed inset-0 z-50 bg-black bg-opacity-40 flex items-center justify-center"
         x-transition>
        <div class="bg-white rounded-xl shadow-lg w-full max-w-xl p-6" x-transition.scale>
            <h2 class="text-xl font-semibold mb-4">Posttest</h2>

            <form action="{{ route('article.posttest.submit', $content->id) }}" method="POST">
                @csrf

                @foreach ($posttestQuestions as $q)
                    <div class="mb-4">
                        <p class="font-medium text-gray-800">{{ $q->question }}</p>

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
