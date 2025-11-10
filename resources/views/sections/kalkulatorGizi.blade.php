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
        <img
            src="/image/page/2.png"
            alt="NutriDairy illustration"
            class="h-auto md:h-[400px] w-1/2 md:w-auto" />
        <div class="pb-12">
            <h2
                class="lg:text-3xl text-2xl text-primary font-semibold italic mb-6 mt-14 text-center md:text-left">
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

    <h2
        class="lg:text-3xl text-2xl text-primary font-semibold italic text-center mt-14">
        Isi Data Berikut Ini
    </h2>

    <section class="flex items-center justify-center py-10">
        <form
            class="p-6 rounded-lg border-primary border-2 w-full max-w-4xl flex flex-col md:flex-row gap-6">
            <div class="w-full md:w-1/2">
                <label class="block text-lg font-medium text-gray-900">Upload Foto Anak</label>
                <div
                    class="relative w-full h-64 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center cursor-pointer overflow-hidden mt-2">
                    <img
                        id="preview"
                        class="absolute w-full h-full object-cover hidden" />
                    <div class="flex flex-col items-center text-gray-400">
                        <svg
                            class="w-16 h-16 mb-2"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M7 16l-4-4m0 0l4-4m-4 4h16M15 12h5"></path>
                        </svg>
                        <span>Klik untuk unggah foto anak</span>
                    </div>
                </div>
                <p class="pt-3 text-sm text-red-600">
                    * Upload 1 foto anak yang jelas untuk analisis visual
                </p>
            </div>

            <div class="w-full md:w-1/2">
                <label class="block text-sm font-medium text-gray-700">Lingkar Lengan Atas (cm)</label>
                <input
                    type="number"
                    class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:outline-none"
                    placeholder="Masukkan lingkar lengan atas" />

                <label class="block text-sm font-medium text-gray-700 mt-4">Berat Badan (kg)</label>
                <input
                    type="number"
                    class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:outline-none"
                    placeholder="Masukkan berat badan" />

                <label class="block text-sm font-medium text-gray-700 mt-4">Tinggi Badan (cm)</label>
                <input
                    type="number"
                    class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:outline-none"
                    placeholder="Masukkan tinggi badan" />

                <button
                    type="submit"
                    class="mt-6 w-full bg-white border-primary border-2 text-primary py-2 rounded-lg hover:bg-primary hover:text-white">
                    Hitung Status Gizi
                </button>
            </div>
        </form>
    </section>
</main>
