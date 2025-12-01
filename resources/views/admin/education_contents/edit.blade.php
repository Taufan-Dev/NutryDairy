@extends('admin.layout.app-layout')

@section('title', 'Tambah Konten Edukasi')

@section('content')
    <div class="p-6 max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Edit Konten Edukasi</h1>

        <form action="{{ route('admin.education_contents.update', $educationContent->id) }}" method="POST"
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
                <label class="font-semibold">Kategori</label>
                <input type="text" name="category" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="font-semibold">Thumbnail</label>
                <input type="file" name="thumbnail" class="w-full border rounded p-2">
            </div>

            <!-- Video URL (muncul ketika media_type = video) -->
            <div id="videoField" style="display:none;">
                <label class="font-semibold">Video URL</label>
                <input type="text" name="video_url" class="w-full border rounded p-2"
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
