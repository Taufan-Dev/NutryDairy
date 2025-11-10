<section class="container mx-auto grid xl:grid-cols-4 gap-10 pt-26 xl:px-16 md:px-5 px-3">
    <!-- Artikel Utama -->
    <div class="xl:col-span-3 h-[280px] md:h-[350px] xl:h-[450px] relative z-10 flex items-end rounded-xl overflow-hidden bg-cover bg-center after:content-[''] after:absolute after:inset-0 after:bg-black/40 after:-z-10 p-4 md:p-10"
        style="background-image: url('https://i.pinimg.com/736x/14/ad/31/14ad3171038b99261210a9fbe6785d41.jpg');">

        <div class="w-full max-w-3xl">
            <h6 class="text-sky-500 font-semibold text-sm md:text-base mb-1 md:mb-3">
                Kategori Artikel
            </h6>
            <a href="#">
                <h2 class="text-white font-bold text-xl md:text-2xl xl:text-3xl leading-snug">
                    Judul Artikel Utama yang Menarik dan Informatif
                </h2>
            </a>
            <p class="text-gray-200 mt-3 text-sm leading-relaxed hidden xl:block">
                Deskripsi singkat artikel utama yang memberikan gambaran isi konten dan menarik minat pembaca untuk membaca lebih lanjut.
            </p>
        </div>
    </div>

    <!-- Video Samping (Hanya tampil di XL) -->
    <div class="hidden xl:block">
        <div class="w-full h-full max-w-[245px] mx-auto">
            <video class="w-full h-full rounded-lg shadow-lg object-cover" autoplay muted loop>
                <source src="https://v1.pinimg.com/videos/mc/720p/5f/fb/b3/5ffbb3be23d853129a1bd0597c45e41b.mp4" type="video/mp4" />
            </video>
        </div>
    </div>
</section>

<section class="container mx-auto mt-10 xl:px-20 md:px-10 px-3">
    <hr class="my-10 border-sky-500" />
    <div class="grid xl:grid-cols-4 gap-10 mt-10">
        <div class="xl:col-span-3 md:w-auto w-[95%]">

            <!-- Artikel 1 -->
            <div class="md:grid md:grid-cols-5 items-center xl:gap-10 md:gap-5 md:mb-5 mb-16">
                <div class="md:col-span-2">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=800&q=80"
                        class="w-full h-[250px] rounded-xl object-cover" />
                </div>
                <div class="md:col-span-3 md:mt-0 mt-3">
                    <p class="text-sky-500 font-semibold">Lifestyle</p>

                    <a href="#">
                        <h3 class="text-xl font-bold mb-3 text-gray-900">
                            Tips Hidup Sehat di Era Modern
                        </h3>
                    </a>
                    <p class="text-gray-800 xl:text-base text-justify md:text-sm text-[12px]">
                        Artikel ini membahas cara menjaga kesehatan tubuh dan pikiran di tengah kesibukan sehari-hari, termasuk pentingnya olahraga dan nutrisi seimbang.
                    </p>

                    <div class="mt-5 lg:flex gap-10">
                        <p class="flex gap-2 text-sm text-gray-800 items-center">
                            <i class="fa-regular fa-calendar"></i>
                            <span>Senin, 10 November 2025</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Artikel 2 -->
            <div class="md:grid md:grid-cols-5 items-center xl:gap-10 md:gap-5 md:mb-5 mb-16">
                <div class="md:col-span-2">
                    <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80"
                        class="w-full h-[250px] rounded-xl object-cover" />
                </div>
                <div class="md:col-span-3 md:mt-0 mt-3">
                    <p class="text-sky-500 font-semibold">Travel</p>

                    <a href="#">
                        <h3 class="text-xl font-bold mb-3 text-gray-900">
                            Jelajahi Keindahan Alam Nusantara
                        </h3>
                    </a>
                    <p class="text-gray-800 xl:text-base text-justify md:text-sm text-[12px]">
                        Indonesia memiliki banyak tempat menakjubkan untuk dijelajahi, mulai dari pantai eksotis hingga pegunungan hijau yang memanjakan mata.
                    </p>

                    <div class="mt-5 lg:flex gap-10">
                        <p class="flex gap-2 text-sm text-gray-800 items-center">
                            <i class="fa-regular fa-calendar"></i>
                            <span>Selasa, 11 November 2025</span>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Pagination -->
    <div class="flex justify-center mt-10 mb-10">
        <ul class="inline-flex items-center gap-2 -space-x-px text-sm">
            <!-- Tombol Sebelumnya -->
            <li>
                <a href="#"
                    class="flex items-center justify-center px-3 h-8 leading-tight rounded-l-md bg-gray-300 text-gray-500 cursor-not-allowed">
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            </li>

            <!-- Nomor Halaman -->
            <li>
                <a href="#"
                    class="flex items-center justify-center px-3 h-8 rounded-md text-white bg-sky-500">
                    1
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center justify-center px-3 h-8 rounded-md bg-gray-200 text-gray-900 hover:bg-sky-700 hover:text-white">
                    2
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center justify-center px-3 h-8 rounded-md bg-gray-200 text-gray-900 hover:bg-sky-700 hover:text-white">
                    3
                </a>
            </li>

            <!-- Tombol Berikutnya -->
            <li>
                <a href="#"
                    class="flex items-center justify-center px-3 h-8 leading-tight rounded-r-md bg-gray-200 text-gray-900 hover:bg-sky-700 hover:text-white">
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            </li>
        </ul>
    </div>
</section>