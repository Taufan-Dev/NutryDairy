{{--
    Infografis: Isi Piringku Untuk Batita
    Sumber materi: Kemenkes RI (Pedoman Gizi Seimbang 2016, Buku KIA 2022)
--}}
<section class="mb-12 space-y-6">

    {{-- ===== HERO FOTO ===== --}}
    <figure class="overflow-hidden rounded-2xl border border-gray-200 bg-white">
        <img src="{{ asset('storage/education_contents/isi-piringku-balita.png') }}"
             alt="Infografis Isi Piringku Untuk Batita"
             class="w-full h-auto" loading="eager">
    </figure>

    {{-- ===== JUDUL ===== --}}
    <header class="rounded-2xl bg-teal-600 px-6 py-7 text-white">
        <p class="text-xs font-semibold uppercase tracking-wider text-teal-100">Edukasi Gizi</p>
        <h2 class="mt-1 text-2xl font-bold sm:text-3xl">Isi Piringku Untuk Batita</h2>
        <p class="mt-1 text-teal-50">Panduan komposisi porsi seimbang untuk anak usia 2–5 tahun.</p>
    </header>

    {{-- ===== DIAGRAM PIRING ===== --}}
    <div class="rounded-xl border border-gray-200 bg-white p-5 sm:p-6">
        <x-infografis.section-header title="Komposisi isi piringku" icon="fa-solid fa-chart-pie" color="teal" />

        <div class="mt-5 flex flex-col items-center gap-6 lg:flex-row lg:justify-center">
            {{-- Piring --}}
            <div class="relative shrink-0">
                <div class="grid h-48 w-48 place-items-center rounded-full shadow-sm ring-1 ring-gray-200"
                     style="background: conic-gradient(#f97316 0% 35%, #ef4444 35% 70%, #22c55e 70% 100%);">
                    <div class="grid h-20 w-20 place-items-center rounded-full bg-white text-center">
                        <span class="text-xs font-semibold leading-tight text-teal-700">Isi<br>Piringku</span>
                    </div>
                </div>
            </div>

            {{-- Legenda --}}
            <div class="w-full max-w-sm space-y-3">
                @php
                $segmen = [
                    ['#f97316', '35%', 'Makanan Pokok',          'Sumber energi utama.'],
                    ['#ef4444', '35%', 'Protein Hewani & Nabati','Membangun jaringan tubuh.'],
                    ['#22c55e', '30%', 'Sayur & Buah',           'Sumber vitamin dan serat.'],
                ];
                @endphp
                @foreach ($segmen as $s)
                    <div class="flex items-center gap-3 rounded-lg border border-gray-100 p-3">
                        <span class="h-4 w-4 shrink-0 rounded-full" style="background: {{ $s[0] }};"></span>
                        <div>
                            <p class="text-sm font-bold text-gray-900">{{ $s[1] }} &middot; {{ $s[2] }}</p>
                            <p class="text-xs text-gray-500">{{ $s[3] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ===== APA ITU + PMBA ===== --}}
    <div class="grid gap-4 lg:grid-cols-2">
        <div class="rounded-xl border border-gray-200 bg-white p-5 sm:p-6">
            <x-infografis.section-header title="Apa itu isi piringku" icon="fa-solid fa-circle-info" color="teal" />
            <p class="mt-4 text-gray-700">
                Panduan makan seimbang dari Kementerian Kesehatan agar anak memperoleh gizi
                <strong>lengkap, proporsional, dan beragam</strong> untuk tumbuh kembang yang optimal.
            </p>
        </div>
        <div class="rounded-xl border border-gray-200 bg-white p-5 sm:p-6">
            <x-infografis.section-header title="Untuk PMBA (6–23 bulan)" icon="fa-solid fa-baby" color="teal" subtitle="Komposisi khusus bayi dan batita muda" />
            <div class="mt-4 space-y-2">
                @php
                $pmba = [
                    ['35%','Makanan Pokok',  'Nasi, kentang, ubi, singkong, sagu', 'text-orange-700'],
                    ['30%','Protein Hewani', 'Daging, telur, ayam, ikan, hati',    'text-rose-700'],
                    ['10%','Protein Nabati', 'Tempe, tahu, kacang-kacangan',       'text-amber-700'],
                    ['25%','Sayur & Buah',   'Bayam, brokoli, pepaya, mangga',     'text-emerald-700'],
                ];
                @endphp
                @foreach ($pmba as $p)
                    <div class="flex items-center gap-3 rounded-lg border border-gray-100 px-3 py-2">
                        <span class="text-base font-bold {{ $p[3] }}">{{ $p[0] }}</span>
                        <div>
                            <span class="text-sm font-semibold text-gray-900">{{ $p[1] }}</span>
                            <span class="text-sm text-gray-500"> &mdash; {{ $p[2] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ===== RINCIAN KELOMPOK ===== --}}
    <div class="rounded-xl border border-gray-200 bg-white p-5 sm:p-6">
        <x-infografis.section-header title="Rincian kelompok makanan" icon="fa-solid fa-bowl-food" color="teal" />
        <div class="mt-4 grid gap-3 sm:grid-cols-3">
            @php
            $kelompok = [
                ['fa-solid fa-bowl-rice',   'Makanan Pokok',          'Nasi, kentang, ubi, jagung, singkong', 'Sumber energi untuk bermain dan belajar.', 'text-orange-700'],
                ['fa-solid fa-fish',        'Protein Hewani & Nabati','Ikan, telur, ayam, daging, tahu, kacang','Membangun jaringan tubuh dan mencegah anemia.', 'text-rose-700'],
                ['fa-solid fa-carrot',      'Sayur & Buah',           'Bayam, wortel, brokoli, pepaya, jeruk', 'Sumber vitamin dan mineral untuk daya tahan tubuh.', 'text-emerald-700'],
            ];
            @endphp
            @foreach ($kelompok as $k)
                <div class="rounded-lg border border-gray-100 p-4">
                    <i class="{{ $k[0] }} text-2xl {{ $k[4] }}"></i>
                    <p class="mt-2 text-sm font-bold text-gray-900">{{ $k[1] }}</p>
                    <p class="mt-1 text-xs text-gray-500">{{ $k[2] }}</p>
                    <p class="mt-2 text-sm font-medium text-gray-700">{{ $k[3] }}</p>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ===== JANGAN LUPA ===== --}}
    <div class="rounded-xl border border-gray-200 bg-white p-5 sm:p-6">
        <x-infografis.section-header title="Jangan lupa" icon="fa-solid fa-bell" color="teal" subtitle="Kebiasaan sehat setiap hari" />
        <div class="mt-4 grid grid-cols-2 gap-3 sm:grid-cols-4">
            @php
            $lupa = [
                ['fa-solid fa-glass-water','Minum air putih'],
                ['fa-solid fa-soap',       'Cuci tangan sebelum dan sesudah makan'],
                ['fa-solid fa-leaf',       'Makan makanan yang beragam'],
                ['fa-solid fa-users',      'Makan bersama keluarga'],
            ];
            @endphp
            @foreach ($lupa as $l)
                <div class="flex flex-col items-start gap-2 rounded-lg border border-gray-100 p-4">
                    <i class="{{ $l[0] }} text-xl text-teal-600"></i>
                    <p class="text-sm font-medium text-gray-700">{{ $l[1] }}</p>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ===== KESALAHAN vs SEBAIKNYA ===== --}}
    <div class="rounded-xl border border-gray-200 bg-white p-5 sm:p-6">
        <x-infografis.section-header title="Kesalahan dan yang sebaiknya dilakukan" icon="fa-solid fa-scale-balanced" color="teal" />
        <div class="mt-4 grid gap-4 sm:grid-cols-2">
            <div>
                <p class="flex items-center gap-2 text-sm font-bold text-rose-600"><i class="fa-solid fa-xmark"></i> Kesalahan</p>
                <ul class="mt-2 space-y-2">
                    @php $salah = ['Memaksa anak menghabiskan makanan','Menu monoton tanpa variasi','Makan sambil bermain gawai','Memberi camilan manis berlebihan']; @endphp
                    @foreach ($salah as $s)
                        <li class="flex items-start gap-2 text-sm text-gray-700"><i class="fa-solid fa-xmark mt-0.5 text-rose-500"></i><span>{{ $s }}</span></li>
                    @endforeach
                </ul>
            </div>
            <div>
                <p class="flex items-center gap-2 text-sm font-bold text-emerald-700"><i class="fa-solid fa-check"></i> Sebaiknya</p>
                <ul class="mt-2 space-y-2">
                    @php $benar = ['Biarkan anak mengatur porsinya','Variasikan menu, warna, dan tekstur','Ciptakan suasana makan yang tenang','Sediakan camilan sehat dan bergizi']; @endphp
                    @foreach ($benar as $b)
                        <li class="flex items-start gap-2 text-sm text-gray-700"><i class="fa-solid fa-check mt-0.5 text-emerald-600"></i><span>{{ $b }}</span></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    {{-- ===== PESAN UTAMA ===== --}}
    <div class="rounded-2xl bg-teal-600 p-6 text-white">
        <p class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-teal-100"><i class="fa-solid fa-quote-left"></i> Pesan Utama</p>
        <p class="mx-auto mt-3 max-w-2xl text-lg font-medium leading-relaxed">
            Orang tua menentukan apa, kapan, dan di mana makanan diberikan. Anak menentukan apakah
            dan berapa banyak makanan yang akan dimakan.
        </p>
    </div>

    {{-- ===== SUMBER ===== --}}
    <footer class="rounded-xl bg-gray-50 px-6 py-4 text-xs text-gray-500">
        <p class="font-semibold text-gray-600">Sumber Materi</p>
        <p>Kementerian Kesehatan RI (2016). Pedoman Gizi Seimbang.</p>
        <p>Kementerian Kesehatan RI (2022). Buku KIA — Kesehatan Ibu dan Anak.</p>
    </footer>
</section>
