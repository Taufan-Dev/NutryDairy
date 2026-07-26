{{--
    Infografis: Praktik Pemberian Makan Anak
    Sumber materi: Kemenkes RI (Buku KIA 2022, Pedoman Gizi Seimbang 2016)
--}}
<section class="mb-12 space-y-6">

    {{-- ===== HERO FOTO ===== --}}
    <figure class="overflow-hidden rounded-2xl border border-gray-200 bg-white">
        <img src="{{ asset('storage/education_contents/pemberian-makan-anak.png') }}"
             alt="Infografis Praktik Pemberian Makan Anak"
             class="w-full h-auto" loading="eager">
    </figure>

    {{-- ===== JUDUL ===== --}}
    <header class="rounded-2xl bg-sky-600 px-6 py-7 text-white">
        <p class="text-xs font-semibold uppercase tracking-wider text-sky-100">Edukasi Gizi</p>
        <h2 class="mt-1 text-2xl font-bold sm:text-3xl">Praktik Pemberian Makan Anak</h2>
        <p class="mt-1 text-sky-50">Pemberian makan yang tepat mendukung tumbuh kembang anak secara optimal.</p>
    </header>

    {{-- ===== MENGAPA PENTING ===== --}}
    <div class="rounded-xl border border-gray-200 bg-white p-5 sm:p-6">
        <x-infografis.section-header title="Mengapa penting?" icon="fa-solid fa-circle-question" color="sky" />
        <div class="mt-4 grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
            @php
            $why = [
                ['fa-solid fa-chart-line', 'Pertumbuhan optimal'],
                ['fa-solid fa-shield',     'Mencegah stunting dan kekurangan gizi'],
                ['fa-solid fa-utensils',   'Membangun pola makan sehat sejak dini'],
                ['fa-solid fa-heart-pulse','Meningkatkan daya tahan tubuh'],
            ];
            @endphp
            @foreach ($why as $w)
                <div class="flex items-start gap-3">
                    <span class="grid h-9 w-9 shrink-0 place-items-center rounded-lg bg-sky-100 text-sky-700">
                        <i class="{{ $w[0] }}"></i>
                    </span>
                    <p class="pt-1 text-sm font-medium text-gray-700">{{ $w[1] }}</p>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ===== 1. APA ITU ===== --}}
    <div class="rounded-xl border border-gray-200 bg-white p-5 sm:p-6">
        <x-infografis.section-header title="Apa itu praktik pemberian makan anak" icon="fa-solid fa-circle-info" color="sky" number="1" />
        <p class="mt-4 text-gray-700">
            Cara memberikan makan kepada anak <strong>sesuai kebutuhan dan usianya</strong> — meliputi
            pemilihan jenis makanan, waktu, porsi, dan cara penyajian — agar kebutuhan gizi terpenuhi
            dan anak dapat tumbuh berkembang secara optimal.
        </p>
    </div>

    {{-- ===== 2. PANDUAN BERDASARKAN USIA ===== --}}
    <div class="rounded-xl border border-gray-200 bg-white p-5 sm:p-6">
        <x-infografis.section-header title="Panduan berdasarkan usia" icon="fa-solid fa-calendar-days" color="sky" number="2" />
        <div class="mt-4 grid gap-3 sm:grid-cols-2">
            @php
            $usia = [
                ['fa-solid fa-baby',         '0–6 Bulan',   'ASI Eksklusif',                 'Hanya ASI, tanpa makanan atau minuman lain.'],
                ['fa-solid fa-bowl-food',    '6–8 Bulan',   'Mulai MP-ASI',                 'Dua sampai tiga kali sehari, tekstur lembut.'],
                ['fa-solid fa-utensils',     '9–11 Bulan',  'MP-ASI + Makan Keluarga',      'Tiga sampai empat kali sehari, ditambah makan keluarga, tekstur lebih padat.'],
                ['fa-solid fa-users',        '12–23 Bulan', 'Menu Keluarga',                'Tiga sampai empat kali sehari, ditambah selingan, variasi tekstur dan ukuran.'],
            ];
            @endphp
            @foreach ($usia as $u)
                <div class="flex items-start gap-3 rounded-lg border border-gray-100 p-4">
                    <i class="{{ $u[0] }} mt-0.5 text-xl text-sky-600"></i>
                    <div>
                        <p class="text-sm font-bold text-gray-900">{{ $u[1] }}</p>
                        <p class="text-sm font-semibold text-sky-700">{{ $u[2] }}</p>
                        <p class="text-sm text-gray-500">{{ $u[3] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ===== 3. RESPONSIVE FEEDING ===== --}}
    <div class="rounded-xl border border-gray-200 bg-white p-5 sm:p-6">
        <x-infografis.section-header title="Enam prinsip responsive feeding" icon="fa-solid fa-hand-holding-heart" color="sky" number="3" subtitle="Memberi makan dengan penuh kasih dan responsif" />
        <div class="mt-4 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
            @php
            $prinsip = [
                'Bersabar dan tidak memaksa',
                'Mengenali tanda lapar dan kenyang',
                'Menciptakan suasana makan yang nyaman',
                'Menghindari televisi dan gawai saat makan',
                'Memberi kesempatan anak makan sendiri',
                'Memberikan pujian atas usaha anak',
            ];
            @endphp
            @foreach ($prinsip as $i => $p)
                <div class="flex items-start gap-3 rounded-lg border border-gray-100 p-3">
                    <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-sky-600 text-xs font-bold text-white">{{ $i + 1 }}</span>
                    <p class="text-sm text-gray-700">{{ $p }}</p>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ===== 4. MENGATASI SULIT MAKAN ===== --}}
    <div class="rounded-xl border border-gray-200 bg-white p-5 sm:p-6">
        <x-infografis.section-header title="Cara mengatasi anak sulit makan" icon="fa-solid fa-utensils" color="sky" number="4" />
        <ul class="mt-4 grid gap-2 sm:grid-cols-2">
            @php
            $sulit = [
                'Variasikan menu agar lebih menarik',
                'Manfaatkan variasi warna makanan',
                'Sajikan dalam porsi kecil',
                'Hindari memaksa anak makan',
                'Terapkan jadwal makan yang teratur',
                'Jadilah contoh kebiasaan makan sehat',
            ];
            @endphp
            @foreach ($sulit as $s)
                <li class="flex items-start gap-3 text-sm text-gray-700">
                    <i class="fa-solid fa-check mt-0.5 text-sky-600"></i>
                    <span>{{ $s }}</span>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- ===== 5. KESALAHAN vs SOLUSI ===== --}}
    <div class="rounded-xl border border-gray-200 bg-white p-5 sm:p-6">
        <x-infografis.section-header title="Kesalahan yang sering dilakukan orang tua" icon="fa-solid fa-people-arrows" color="sky" number="5" />
        <div class="mt-4 grid gap-4 sm:grid-cols-2">
            <div>
                <p class="flex items-center gap-2 text-sm font-bold text-rose-600"><i class="fa-solid fa-xmark"></i> Kesalahan</p>
                <ul class="mt-2 space-y-2">
                    @php $salah = ['Memaksa anak menghabiskan makanan','Mengalihkan perhatian dengan mainan atau gawai','Memberi makan berlebihan','Mengancam atau menuduh saat makan']; @endphp
                    @foreach ($salah as $s)
                        <li class="flex items-start gap-2 text-sm text-gray-700"><i class="fa-solid fa-xmark mt-0.5 text-rose-500"></i><span>{{ $s }}</span></li>
                    @endforeach
                </ul>
            </div>
            <div>
                <p class="flex items-center gap-2 text-sm font-bold text-emerald-700"><i class="fa-solid fa-check"></i> Solusi</p>
                <ul class="mt-2 space-y-2">
                    @php $benar = ['Mendampingi anak dan makan bersama','Menciptakan suasana tenang tanpa layar','Menyajikan porsi sesuai kebutuhan','Memberikan pujian atas usaha anak']; @endphp
                    @foreach ($benar as $b)
                        <li class="flex items-start gap-2 text-sm text-gray-700"><i class="fa-solid fa-check mt-0.5 text-emerald-600"></i><span>{{ $b }}</span></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    {{-- ===== 6. PESAN UTAMA ===== --}}
    <div class="rounded-2xl bg-sky-600 p-6 text-white">
        <p class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-sky-100"><i class="fa-solid fa-quote-left"></i> Pesan Utama</p>
        <p class="mx-auto mt-3 max-w-2xl text-lg font-medium leading-relaxed">
            Orang tua menentukan apa, kapan, dan di mana makanan diberikan. Anak menentukan apakah
            dan berapa banyak makanan yang akan dimakan.
        </p>
    </div>

    {{-- ===== SUMBER ===== --}}
    <footer class="rounded-xl bg-gray-50 px-6 py-4 text-xs text-gray-500">
        <p class="font-semibold text-gray-600">Sumber Materi</p>
        <p>Kementerian Kesehatan RI (2022). Buku KIA — Kesehatan Ibu dan Anak.</p>
        <p>Kementerian Kesehatan RI (2016). Pedoman Gizi Seimbang.</p>
    </footer>
</section>
