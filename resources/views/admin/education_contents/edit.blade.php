@extends('admin.layout.app-layout')

@section('title', 'Tambah Konten Edukasi')

@section('content')
    <div class="p-6 max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Edit Konten Edukasi</h1>

        @error('thumbnail')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <form action="{{ route('education_contents.update', $educationContent->id) }}" method="POST"
            enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="font-semibold">Judul</label>
                <input type="text" name="title" class="w-full border rounded p-2" required
                    value="{{ $educationContent->title }}">
            </div>

            <div>
                <label class="font-semibold">Jenis Media</label>
                <select name="media_type" id="mediaType" class="w-full border rounded p-2" required>
                    <option value="article">Artikel (Teks)</option>
                    <option value="video">Video</option>
                </select>
            </div>

            <div>
                <select name="category" class="w-full border rounded p-2" required>
                    <option value="">-- Pilih Kategori --</option>

                    <option value="pemulihan-gizi">Pemulihan Gizi</option>
                    <option value="mpasi-kalori-tinggi">MPASI Kalori Tinggi</option>
                    <option value="peningkatan-berat-badan">Peningkatan Berat Badan</option>
                    <option value="mpasi-seimbang">MPASI Seimbang</option>
                    <option value="pola-makan-seimbang">Pola Makan Seimbang</option>
                    <option value="menu-harian">Menu Harian</option>
                    <option value="pencegahan-obesitas">Pencegahan Obesitas</option>
                    <option value="atur-porsi">Atur Porsi Makan</option>

                    <option value="stunting-berat">Stunting Berat</option>
                    <option value="mikronutrien">Mikronutrien</option>
                    <option value="tumbuh-kejar">Tumbuh Kejar</option>
                    <option value="pencegahan-stunting">Pencegahan Stunting</option>
                    <option value="menu-pertumbuhan">Menu Pertumbuhan</option>

                    <option value="rehabilitasi-gizi">Rehabilitasi Gizi</option>
                    <option value="peningkatan-gizi">Peningkatan Gizi</option>

                    <option value="diet-sehat-anak">Diet Sehat Anak</option>
                    <option value="aktivitas-fisik">Aktivitas Fisik Anak</option>
                    <option value="obesitas-anak">Obesitas Anak</option>
                    <option value="kurangi-gula">Kurangi Gula</option>

                    <option value="pertumbuhan-normal">Pertumbuhan Normal</option>
                </select>
            </div>

            <div>
                <label class="font-semibold">Thumbnail</label>
                <input type="file" name="thumbnail" class="w-full border rounded p-2">
            </div>

            <!-- Video URL (muncul ketika media_type = video) -->
            <div id="videoField" style="display:none;">
                <label class="font-semibold">Video URL</label>
                <input type="text" name="media_url" class="w-full border rounded p-2"
                    placeholder="https://youtube.com/... atau link MP4">
            </div>

            <!-- Konten Artikel -->
            <div id="contentField">
                <label class="font-semibold">Isi Artikel</label>
                <textarea name="content" class="w-full border rounded p-2 h-40"></textarea>
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                Simpan
            </button>
        </form>
    </div>

    <script>
        const mediaType = document.getElementById('mediaType');
        const videoField = document.getElementById('videoField');
        const contentField = document.getElementById('contentField');

        function updateFields() {
            if (mediaType.value === 'video') {
                videoField.style.display = 'block';
                contentField.style.display = 'none';
            } else {
                videoField.style.display = 'none';
                contentField.style.display = 'block';
            }
        }

        mediaType.addEventListener('change', updateFields);
        updateFields();
    </script>
@endsection
