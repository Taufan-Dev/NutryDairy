<section class="relative text-center py-24 h-[80vh] text-sekunder font-primary bg-cover bg-center"
    style="background-image: url('https://images.unsplash.com/photo-1502781252888-9143ba7f074e?auto=format&fit=crop&q=80&w=1600');">
    <div class="absolute inset-0 bg-black/70"></div>
    <div class="relative z-10">
        <h1 class="font-sekunder text-4xl my-5 text-gray-200">NutriDairy</h1>
        <p class="text-gray-200">
            membantu orang tua memantau status gizi balita dengan mudah,
            <br class="hidden md:inline" />
            melalui pengukuran sederhana dan hasil yang cepat,
            <br class="hidden md:inline" />
            demi tumbuh kembang anak yang sehat dan optimal.
        </p>
    </div>
</section>


<main class="xl:px-20 md:px-10 px-5 pt-10 container mx-auto">
    <section class="flex flex-col md:flex-row gap-3 md:gap-16 items-center">
        <img src="/image/page/2.png" alt="NutriDairy illustration" class="h-auto md:h-[400px] w-1/2 md:w-auto" />
        <div class="pb-12">
            <h2 class="lg:text-3xl text-2xl text-primary font-semibold italic mb-6 mt-14 text-center md:text-left">
                Apa Itu NutriDairy
            </h2>
            <p class="mb-3 text-sm lg:text-base text-gray-700 text-justify">
                Banyak orang tua masih kesulitan mengetahui apakah anak mereka memiliki
                status gizi yang ideal. Kurangnya informasi dan alat ukur sederhana
                membuat pemantauan tumbuh kembang anak menjadi tantangan.
            </p>
            <p class="mb-3 text-sm lg:text-base text-gray-700 text-justify">
                NutriDairy hadir untuk membantu memantau status gizi balita dengan
                mudah. Cukup masukkan lingkar lengan, berat badan, dan tinggi badan,
                sistem akan membantu menghitung serta memberikan informasi mengenai
                kondisi gizi anak Anda.
            </p>
            <p class="text-sm lg:text-base text-gray-700 text-justify">
                Dengan data sederhana, Anda dapat memahami apakah anak berada dalam
                kondisi gizi baik, kurang, atau berisiko. NutriDairy menjadi langkah
                awal dalam menjaga kesehatan dan masa depan si kecil.
            </p>
        </div>
    </section>

    <h2 class="lg:text-3xl text-2xl text-primary font-semibold italic text-center mt-14">
        Isi Data Berikut Ini
    </h2>

    <section class="flex items-center justify-center py-10">
        <form class="p-6 rounded-lg border-primary border-2 w-full max-w-4xl flex flex-col md:flex-row gap-6"
            method="POST" action="{{ route('measurements.store') }}">
            @csrf

            <div class="w-full">
                <label class="block text-sm font-medium text-gray-700">Nama Anak</label>
                <input type="text"
                    class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:outline-none"
                    placeholder="Nama Anak" name="name" />

                <label class="block text-sm font-medium text-gray-700 mt-4">Tanggal Lahir</label>
                <input type="date"
                    class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:outline-none"
                    name="birth_date" />

                <label class="block text-sm font-medium text-gray-700 mt-4">Tanggal Ukur</label>
                <input type="date"
                    class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:outline-none"
                    name="measured_at" />

                <label class="block text-sm font-medium text-gray-700 mt-4">Jenis Kelamin</label>
                <select
                    class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:outline-none"
                    name="gender">
                    <option value="" disabled selected>Pilih jenis kelamin</option>
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>

                <label class="block text-sm font-medium text-gray-700 mt-4">Berat Badan (kg)</label>
                <input type="number"
                    class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:outline-none"
                    placeholder="Masukkan berat badan" name="weight_kg" />

                <label class="block text-sm font-medium text-gray-700 mt-4">Tinggi Badan (cm)</label>
                <input type="number"
                    class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:outline-none"
                    placeholder="Masukkan tinggi badan" name="height_cm" />

                <button type="submit"
                    class="mt-6 w-full bg-white border-primary border-2 text-primary py-2 rounded-lg hover:bg-primary hover:text-white">
                    Hitung Status Gizi
                </button>
            </div>
        </form>
    </section>
    @if (session('result'))
        <section class="flex items-center justify-center py-10">
            <div id="result-card"
                class="bg-green-50 border border-green-300 text-gray-800 rounded-2xl shadow-lg p-6 w-full max-w-[900px]">

                <h2 class="text-xl font-bold text-green-800 mb-4">Hasil Pemeriksaan</h2>

                <p><strong>Nama:</strong> {{ session('result')['name'] }}</p>
                <p><strong>Jenis Kelamin:</strong> {{ session('result')['gender'] }}</p>
                <p><strong>Usia:</strong>
                    <strong>{{ session('result')['age_years'] }} Tahun</strong>,
                    <strong>{{ session('result')['age_months'] }} Bulan</strong>,
                    <strong>{{ session('result')['age_days'] }} Hari</strong>
                    (<strong>{{ session('result')['age_days_total'] }} Hari</strong>)
                </p>
                <p><strong>Tinggi Badan:</strong> {{ session('result')['height'] }} cm</p>
                <p><strong>Berat Badan:</strong> {{ session('result')['weight_gram'] }} gram atau
                    {{ session('result')['weight'] }} kg</p>

                <h3 class="mt-4 text-lg font-bold text-green-800">Hasil Status Gizi</h3>

                {{-- TABLE --}}
                <div class="overflow-x-auto mt-4">
                    <table class="table-auto w-full border-collapse text-sm border border-gray-400">
                        <thead>
                            <tr class="bg-green-300 text-gray-900">
                                <th class="border border-gray-400 px-3 py-2">Indeks</th>
                                <th class="border border-gray-400 px-3 py-2">Z-Score</th>
                                <th class="border border-gray-400 px-3 py-2">Status Gizi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- BB/U --}}
                            <tr>
                                <td class="border px-3 py-2 font-semibold text-center" rowspan="5">BB/U</td>
                                <td class="border px-3 py-2 text-center">{{ session('result')['zscore_bbu'] }}</td>
                                <td class="border px-3 py-2 text-center font-bold"
                                    style="background:{{ session('result')['color_bbu'] }};">
                                    {{ session('result')['status_bbu'] }}
                                </td>
                            </tr>

                            <tr>
                                <td class="border px-3 py-2" colspan="2">Keterangan:</td>
                            </tr>

                            <tr>
                                <td class="border px-3 py-2 text-center">L</td>
                                <td class="border px-3 py-2 text-center">{{ session('result')['L_bbu'] }}</td>
                            </tr>

                            <tr>
                                <td class="border px-3 py-2 text-center">M</td>
                                <td class="border px-3 py-2 text-center">{{ session('result')['M_bbu'] }}</td>
                            </tr>

                            <tr>
                                <td class="border px-3 py-2 text-center">S</td>
                                <td class="border px-3 py-2 text-center">{{ session('result')['S_bbu'] }}</td>
                            </tr>

                            <tr>
                                <td class="border px-3 py-2 font-semibold text-center" rowspan="6">TB/U</td>
                                <td class="border px-3 py-2 text-center">{{ session('result')['zscore_tbu'] }}</td>
                                <td class="border px-3 py-2 text-center font-bold"
                                    style="background:{{ session('result')['color_tbu'] }};">
                                    {{ session('result')['status_tbu'] }}
                                </td>
                            </tr>

                            <tr>
                                <td class="border px-3 py-2" colspan="2">Keterangan:</td>
                            </tr>

                            <tr>
                                <td class="border px-3 py-2 text-center">-1SD</td>
                                <td class="border px-3 py-2 text-center">{{ session('result')['SD1neg'] }}</td>
                            </tr>

                            <tr>
                                <td class="border px-3 py-2 text-center">SD0</td>
                                <td class="border px-3 py-2 text-center">{{ session('result')['SD0'] }}</td>
                            </tr>

                            <tr>
                                <td class="border px-3 py-2 text-center">+1SD</td>
                                <td class="border px-3 py-2 text-center">{{ session('result')['SD1'] }}</td>
                            </tr>

                            <tr>
                                <td class="border px-3 py-2 text-center">Simpangan Baku</td>
                                <td class="border px-3 py-2 text-center">{{ session('result')['simpanganBaku'] }}</td>
                            </tr>

                            {{-- BB/TB --}}
                            <tr>
                                <td class="border px-3 py-2 font-semibold text-center" rowspan="5">BB/TB</td>
                                <td class="border px-3 py-2 text-center">{{ session('result')['zscore_bbtb'] }}</td>
                                <td class="border px-3 py-2 text-center font-bold"
                                    style="background:{{ session('result')['color_bbtb'] }};">
                                    {{ session('result')['status_bbtb'] }}
                                </td>
                            </tr>

                            <tr>
                                <td class="border px-3 py-2" colspan="2">Keterangan:</td>
                            </tr>

                            <tr>
                                <td class="border px-3 py-2 text-center">L</td>
                                <td class="border px-3 py-2 text-center">{{ session('result')['L_bbtb'] }}</td>
                            </tr>

                            <tr>
                                <td class="border px-3 py-2 text-center">M</td>
                                <td class="border px-3 py-2 text-center">{{ session('result')['M_bbtb'] }}</td>
                            </tr>

                            <tr>
                                <td class="border px-3 py-2 text-center">S</td>
                                <td class="border px-3 py-2 text-center">{{ session('result')['S_bbtb'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <p class="mt-4 text-xs text-gray-600">
                    *Penentuan Zscore berdasarkan WHO Growth Standards. Penentuan Status Gizi sesuai Permenkes No 2
                    Tahun 2020.
                </p>

            </div>
        </section>
    @endif

    @if (session('result') && session('result')['recommendations']->count())
        <section class="py-10">
            <div class="bg-blue-50 border border-blue-300 rounded-2xl shadow-lg p-6 w-full max-w-[900px] mx-auto">

                <h2 class="text-xl font-bold text-blue-800 mb-4">
                    Rekomendasi Edukasi Untuk Anak Anda
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach (session('result')['recommendations'] as $item)
                        <a href="{{ route('article.detail', $item->slug) }}"
                            class="flex items-center gap-4 p-4 rounded-lg bg-white shadow hover:bg-blue-100 transition">

                            <!-- Thumbnail -->
                            <img src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : '/image/default-thumb.jpg' }}"
                                class="w-20 h-20 object-cover rounded-lg">

                            <div>
                                <h3 class="font-semibold text-gray-800">{{ $item->title }}</h3>
                                <p class="text-xs text-gray-500 capitalize">{{ $item->category }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>

                <p class="mt-4 text-xs text-gray-600">
                    *Rekomendasi berdasarkan status gizi anak Anda.
                </p>

            </div>
        </section>
    @endif

</main>
@if (session('result'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const el = document.getElementById("result-card");
            if (el) {
                setTimeout(() => {
                    el.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }, 300);
            }
        });
    </script>
@endif
