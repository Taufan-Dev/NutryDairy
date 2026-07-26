{{--
    Infografis: Yuk, Pahami Label Gizi
    Sumber materi: Kemenkes RI (Buku KIA 2022, Pedoman Gizi Seimbang 2016)
--}}
<section class="mb-12 space-y-6">

    {{-- ===== HERO FOTO ===== --}}
    <figure class="overflow-hidden rounded-2xl border border-gray-200 bg-white">
        <img src="{{ asset('storage/education_contents/label-gizi.png') }}"
             alt="Infografis Yuk, Pahami Label Gizi"
             class="w-full h-auto" loading="eager">
    </figure>

    {{-- ===== JUDUL ===== --}}
    <header class="rounded-2xl bg-emerald-600 px-6 py-7 text-white">
        <p class="text-xs font-semibold uppercase tracking-wider text-emerald-100">Edukasi Gizi</p>
        <h2 class="mt-1 text-2xl font-bold sm:text-3xl">Yuk, Pahami Label Gizi</h2>
        <p class="mt-1 text-emerald-50">Panduan membaca label gizi agar dapat memilih makanan sehat bagi keluarga.</p>
    </header>

    {{-- ===== 1. APA ITU ===== --}}
    <div class="rounded-xl border border-gray-200 bg-white p-5 sm:p-6">
        <x-infografis.section-header title="Apa itu label gizi?" icon="fa-solid fa-circle-info" color="emerald" number="1" />
        <p class="mt-4 text-gray-700">
            Informasi yang wajib tercantum pada kemasan makanan, berisi
            <strong>nilai nutrisi dan komposisi bahan</strong>. Tujuannya membantu konsumen
            membuat pilihan yang lebih sehat saat membeli makanan.
        </p>
    </div>

    {{-- ===== 2. MENGAPA PENTING ===== --}}
    <div class="rounded-xl border border-gray-200 bg-white p-5 sm:p-6">
        <x-infografis.section-header title="Mengapa penting?" icon="fa-solid fa-circle-question" color="emerald" number="2" />
        <div class="mt-4 grid gap-3 sm:grid-cols-2">
            @php
            $manfaat = [
                ['fa-solid fa-shield',      'Membantu memilih makanan yang sehat dan seimbang.'],
                ['fa-solid fa-heart-pulse', 'Mencegah penyakit tidak menular: obesitas, diabetes, hipertensi, dan jantung.'],
                ['fa-solid fa-users',        'Melindungi kesehatan keluarga, terutama anak.'],
                ['fa-solid fa-wallet',       'Lebih sesuai dengan kebutuhan dan anggaran.'],
            ];
            @endphp
            @foreach ($manfaat as $m)
                <div class="flex items-start gap-3">
                    <span class="grid h-9 w-9 shrink-0 place-items-center rounded-lg bg-emerald-100 text-emerald-700">
                        <i class="{{ $m[0] }}"></i>
                    </span>
                    <p class="pt-1 text-sm text-gray-700">{{ $m[1] }}</p>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ===== 3. MENGENAL INFORMASI ===== --}}
    <div class="rounded-xl border border-gray-200 bg-white p-5 sm:p-6">
        <x-infografis.section-header title="Informasi pada label gizi" icon="fa-solid fa-list-ol" color="emerald" number="3" subtitle="Enam komponen penting yang perlu diperhatikan" />
        <div class="mt-4 grid gap-3 sm:grid-cols-2">
            @php
            $komponen = [
                ['Takaran Saji',            'Jumlah makanan untuk satu kali makan.'],
                ['Jumlah Sajian per Kemasan','Berapa kali produk dapat dikonsumsi.'],
                ['Energi Total',            'Jumlah energi (kalori) dalam satu takaran saji.'],
                ['Zat Gizi Makro',          'Lemak total, lemak jenuh, protein, karbohidrat total, gula, dan serat.'],
                ['Zat Gizi Mikro',          'Natrium, vitamin, serta mineral lain yang dibutuhkan tubuh.'],
                ['Persen AKG (%AKG)',       'Persentase kontribusi zat gizi terhadap kebutuhan gizi harian.'],
            ];
            @endphp
            @foreach ($komponen as $i => $k)
                <div class="flex items-start gap-3 rounded-lg border border-gray-100 p-3">
                    <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-emerald-600 text-xs font-bold text-white">{{ $i + 1 }}</span>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">{{ $k[0] }}</p>
                        <p class="text-sm text-gray-500">{{ $k[1] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <p class="mt-3 text-xs text-gray-400">*AKG: Angka Kecukupan Gizi berdasarkan kebutuhan energi 2.150 kkal.</p>
    </div>

    {{-- ===== 4. DI MANA MENEMUKAN ===== --}}
    <div class="rounded-xl border border-gray-200 bg-white p-5 sm:p-6">
        <x-infografis.section-header title="Di mana menemukan label gizi" icon="fa-solid fa-magnifying-glass" color="emerald" number="4" />
        <div class="mt-4 grid grid-cols-2 gap-3 sm:grid-cols-3">
            @php
            $produk = [
                ['fa-solid fa-cookie-bite', 'Makanan Ringan',     'Keripik, biskuit'],
                ['fa-solid fa-bottle-water','Minuman Kemasan',    'Jus, teh, soda'],
                ['fa-solid fa-bowl-food',   'Makanan Instan',     'Mie instan'],
                ['fa-solid fa-candy-cane',  'Cokelat & Permen',   'Cokelat, permen'],
                ['fa-solid fa-mug-hot',     'Produk Susu',        'Susu, yogurt'],
                ['fa-solid fa-wheat-awn',   'Sereal Instan',      'Sereal, sarapan instan'],
            ];
            @endphp
            @foreach ($produk as $p)
                <div class="flex items-center gap-3 rounded-lg border border-gray-100 p-3">
                    <i class="{{ $p[0] }} text-lg text-emerald-600"></i>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">{{ $p[1] }}</p>
                        <p class="text-xs text-gray-500">{{ $p[2] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ===== 5. CONTOH & CARA MEMBACA ===== --}}
    <div class="rounded-xl border border-gray-200 bg-white p-5 sm:p-6">
        <x-infografis.section-header title="Contoh label gizi dan cara membacanya" icon="fa-solid fa-table-list" color="emerald" number="5" />

        <div class="mt-4 grid gap-5 lg:grid-cols-2">
            {{-- Tabel contoh --}}
            <div class="overflow-hidden rounded-lg border border-gray-200">
                <div class="bg-gray-800 px-4 py-2 text-center text-xs font-bold uppercase tracking-wide text-white">
                    Informasi Nilai Gizi
                </div>
                <div class="bg-gray-50 px-4 py-2 text-xs text-gray-500">
                    Takaran Saji <strong class="text-gray-800">30 g</strong> &nbsp;&middot;&nbsp; Sajian per Kemasan <strong class="text-gray-800">3</strong>
                </div>
                <table class="w-full text-sm">
                    <tbody class="divide-y divide-gray-100">
                        @php
                        $rows = [
                            ['Energi Total', '150 kkal', '7%'],
                            ['Energi dari Lemak', '60 kkal', '—'],
                            ['Lemak Total', '6 g', '9%'],
                            ['Lemak Jenuh', '2 g', '10%'],
                            ['Protein', '3 g', '6%'],
                            ['Karbohidrat Total', '20 g', '7%'],
                            ['Gula', '6 g', '12%'],
                            ['Serat Pangan', '2 g', '8%'],
                            ['Natrium', '120 mg', '5%'],
                        ];
                        @endphp
                        @foreach ($rows as $r)
                            <tr class="{{ in_array(trim($r[0]), ['Lemak Jenuh','Gula','Natrium']) ? 'bg-rose-50/50' : '' }}">
                                <td class="px-4 py-1.5 font-medium text-gray-700">{{ $r[0] }}</td>
                                <td class="px-4 py-1.5 text-right text-gray-800">{{ $r[1] }}</td>
                                <td class="px-4 py-1.5 text-right font-semibold text-gray-400">{{ $r[2] }}</td>
                            </tr>
                        @endforeach
                        <tr><td class="bg-gray-50 px-4 py-1.5 text-xs text-gray-500" colspan="3">Vit. A 10% &middot; Vit. C 10% &middot; Kalsium 15% &middot; Zat Besi 8%</td></tr>
                    </tbody>
                </table>
            </div>

            {{-- Langkah membaca --}}
            <ol class="space-y-2">
                @php
                $langkah = [
                    ['Cek takaran saji', 'Ketahui ukuran satu sajian agar tidak salah hitung.'],
                    ['Lihat jumlah sajian', 'Berapa kali produk dapat dikonsumsi.'],
                    ['Perhatikan energi total', 'Bandingkan kalori dengan kebutuhan harian.'],
                    ['Periksa zat gizi makro', 'Pilih yang rendah lemak jenuh, gula, dan natrium.'],
                    ['Cek zat gizi mikro', 'Pilih produk dengan vitamin dan mineral.'],
                    ['Gunakan %AKG', 'Anggap rendah bila di bawah 5%, tinggi bila di atas 20%.'],
                ];
                @endphp
                @foreach ($langkah as $i => $l)
                    <li class="flex items-start gap-3">
                        <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-emerald-600 text-xs font-bold text-white">{{ $i + 1 }}</span>
                        <p class="text-sm text-gray-700"><strong class="text-gray-900">{{ $l[0] }}.</strong> {{ $l[1] }}</p>
                    </li>
                @endforeach
            </ol>
        </div>

        <div class="mt-4 flex items-start gap-3 rounded-lg border-l-4 border-amber-400 bg-amber-50 px-4 py-3 text-sm text-amber-900">
            <i class="fa-solid fa-lightbulb text-amber-500"></i>
            <p><strong>Contoh:</strong> Satu sajian (30 g) mengandung lemak jenuh 2 g atau 10% AKG, berarti 10% kebutuhan lemak jenuh harian telah terpenuhi hanya dari 30 g produk ini.</p>
        </div>

        <div class="mt-3 flex items-center gap-3 rounded-lg bg-rose-600 px-4 py-3 text-sm font-medium text-white">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <p>Semakin rendah lemak jenuh, gula, dan natrium, semakin baik untuk kesehatan.</p>
        </div>
    </div>

    {{-- ===== 6. TIPS ===== --}}
    <div class="rounded-xl border border-gray-200 bg-white p-5 sm:p-6">
        <x-infografis.section-header title="Tips membaca label gizi" icon="fa-solid fa-lightbulb" color="emerald" number="6" />
        <ul class="mt-4 space-y-2">
            @php
            $tips = [
                'Bandingkan produk sejenis dan pilih yang lebih rendah lemak jenuh, gula, serta natrium.',
                'Perhatikan takaran saji; nilai gizi tertera berlaku per sajian, bukan per kemasan.',
                'Manfaatkan %AKG: rendah untuk gula, garam, dan lemak jenuh; tinggi untuk serat, protein, serta vitamin.',
            ];
            @endphp
            @foreach ($tips as $t)
                <li class="flex items-start gap-3 text-sm text-gray-700">
                    <i class="fa-solid fa-check mt-0.5 text-emerald-600"></i>
                    <span>{{ $t }}</span>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- ===== 7. BATASI ===== --}}
    <div class="rounded-xl border border-gray-200 bg-white p-5 sm:p-6">
        <x-infografis.section-header title="Batasi zat gizi berikut" icon="fa-solid fa-triangle-exclamation" color="rose" number="7" subtitle="Batas konsumsi per hari" />
        <div class="mt-4 grid gap-3 sm:grid-cols-3">
            @php
            $batas = [
                ['fa-solid fa-droplet',    'Lemak Jenuh',     'Kurang dari 20 g/hari',     'Meningkatkan risiko penyakit jantung.'],
                ['fa-solid fa-cube',       'Gula',            'Kurang dari 50 g/hari',     'Risiko obesitas, diabetes, dan gigi berlubang.'],
                ['fa-solid fa-mortar-pestle','Natrium (Garam)','Kurang dari 2.000 mg/hari','Dapat meningkatkan tekanan darah.'],
            ];
            @endphp
            @foreach ($batas as $b)
                <div class="rounded-lg border border-rose-100 p-4">
                    <i class="{{ $b[0] }} text-2xl text-rose-600"></i>
                    <p class="mt-2 text-sm font-bold text-gray-900">{{ $b[1] }}</p>
                    <p class="text-base font-bold text-rose-600">{{ $b[2] }}</p>
                    <p class="mt-1 text-xs text-gray-500">{{ $b[3] }}</p>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ===== 8. PILIH YANG LEBIH SEHAT ===== --}}
    <div class="rounded-xl border border-gray-200 bg-white p-5 sm:p-6">
        <x-infografis.section-header title="Pilih yang lebih sehat" icon="fa-solid fa-scale-balanced" color="emerald" number="8" />
        <div class="mt-4 grid gap-3 sm:grid-cols-2">
            <div class="rounded-lg border border-rose-200 p-4">
                <p class="flex items-center gap-2 text-sm font-semibold text-rose-600"><i class="fa-solid fa-circle-xmark"></i> Kurang Sehat</p>
                <p class="mt-1 text-sm text-gray-600">Keripik A dan Yogurt A — tinggi lemak jenuh, gula, serta natrium.</p>
            </div>
            <div class="rounded-lg border border-emerald-300 p-4">
                <p class="flex items-center gap-2 text-sm font-semibold text-emerald-700"><i class="fa-solid fa-circle-check"></i> Lebih Sehat</p>
                <p class="mt-1 text-sm text-gray-600">Keripik B dan Yogurt B — lebih rendah lemak dan gula, lebih tinggi protein.</p>
            </div>
        </div>
    </div>

    {{-- ===== SUMBER ===== --}}
    <footer class="rounded-xl bg-gray-50 px-6 py-4 text-xs text-gray-500">
        <p class="font-semibold text-gray-600">Sumber Materi</p>
        <p>Kementerian Kesehatan RI (2022). Buku KIA — Kesehatan Ibu dan Anak.</p>
        <p>Kementerian Kesehatan RI (2016). Pedoman Gizi Seimbang.</p>
    </footer>
</section>
