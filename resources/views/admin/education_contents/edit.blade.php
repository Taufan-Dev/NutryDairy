@extends('admin.layout.app-layout')

@section('title', 'Edit Konten Edukasi')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <style>
        .ql-editor {
            min-height: 300px;
        }
    </style>
@endpush

@section('content')
    <div class="p-6 max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Edit Konten Edukasi</h1>

        @error('thumbnail')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <form id="educationForm" action="{{ route('education_contents.update', $educationContent->id) }}" method="POST"
            enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="font-semibold">Judul</label>
                <input type="text" name="title" value="{{ old('title', $educationContent->title) }}" 
                       class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="font-semibold">Jenis Media</label>
                <select name="media_type" id="mediaType" class="w-full border rounded p-2" required>
                    <option value="article" {{ old('media_type', $educationContent->media_type) == 'article' ? 'selected' : '' }}>
                        Artikel (Teks)
                    </option>
                    <option value="video" {{ old('media_type', $educationContent->media_type) == 'video' ? 'selected' : '' }}>
                        Video
                    </option>
                </select>
            </div>

            <div>
                <label class="font-semibold">Kategori</label>
                <select name="category" class="w-full border rounded p-2" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="pemulihan-gizi" {{ old('category', $educationContent->category) == 'pemulihan-gizi' ? 'selected' : '' }}>Pemulihan Gizi</option>
                    <option value="mpasi-kalori-tinggi" {{ old('category', $educationContent->category) == 'mpasi-kalori-tinggi' ? 'selected' : '' }}>MPASI Kalori Tinggi</option>
                    <option value="peningkatan-berat-badan" {{ old('category', $educationContent->category) == 'peningkatan-berat-badan' ? 'selected' : '' }}>Peningkatan Berat Badan</option>
                    <option value="mpasi-seimbang" {{ old('category', $educationContent->category) == 'mpasi-seimbang' ? 'selected' : '' }}>MPASI Seimbang</option>
                    <option value="pola-makan-seimbang" {{ old('category', $educationContent->category) == 'pola-makan-seimbang' ? 'selected' : '' }}>Pola Makan Seimbang</option>
                    <option value="menu-harian" {{ old('category', $educationContent->category) == 'menu-harian' ? 'selected' : '' }}>Menu Harian</option>
                    <option value="pencegahan-obesitas" {{ old('category', $educationContent->category) == 'pencegahan-obesitas' ? 'selected' : '' }}>Pencegahan Obesitas</option>
                    <option value="atur-porsi" {{ old('category', $educationContent->category) == 'atur-porsi' ? 'selected' : '' }}>Atur Porsi Makan</option>
                    <option value="stunting-berat" {{ old('category', $educationContent->category) == 'stunting-berat' ? 'selected' : '' }}>Stunting Berat</option>
                    <option value="mikronutrien" {{ old('category', $educationContent->category) == 'mikronutrien' ? 'selected' : '' }}>Mikronutrien</option>
                    <option value="tumbuh-kejar" {{ old('category', $educationContent->category) == 'tumbuh-kejar' ? 'selected' : '' }}>Tumbuh Kejar</option>
                    <option value="pencegahan-stunting" {{ old('category', $educationContent->category) == 'pencegahan-stunting' ? 'selected' : '' }}>Pencegahan Stunting</option>
                    <option value="menu-pertumbuhan" {{ old('category', $educationContent->category) == 'menu-pertumbuhan' ? 'selected' : '' }}>Menu Pertumbuhan</option>
                    <option value="rehabilitasi-gizi" {{ old('category', $educationContent->category) == 'rehabilitasi-gizi' ? 'selected' : '' }}>Rehabilitasi Gizi</option>
                    <option value="peningkatan-gizi" {{ old('category', $educationContent->category) == 'peningkatan-gizi' ? 'selected' : '' }}>Peningkatan Gizi</option>
                    <option value="diet-sehat-anak" {{ old('category', $educationContent->category) == 'diet-sehat-anak' ? 'selected' : '' }}>Diet Sehat Anak</option>
                    <option value="aktivitas-fisik" {{ old('category', $educationContent->category) == 'aktivitas-fisik' ? 'selected' : '' }}>Aktivitas Fisik Anak</option>
                    <option value="obesitas-anak" {{ old('category', $educationContent->category) == 'obesitas-anak' ? 'selected' : '' }}>Obesitas Anak</option>
                    <option value="kurangi-gula" {{ old('category', $educationContent->category) == 'kurangi-gula' ? 'selected' : '' }}>Kurangi Gula</option>
                    <option value="pertumbuhan-normal" {{ old('category', $educationContent->category) == 'pertumbuhan-normal' ? 'selected' : '' }}>Pertumbuhan Normal</option>
                </select>
            </div>

            <div>
                <label class="font-semibold">Thumbnail</label>
                @if($educationContent->thumbnail)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $educationContent->thumbnail) }}" 
                             alt="Current thumbnail" 
                             class="w-32 h-32 object-cover rounded">
                        <p class="text-sm text-gray-600 mt-1">Thumbnail saat ini</p>
                    </div>
                @endif
                <input type="file" name="thumbnail" class="w-full border rounded p-2">
                <p class="text-sm text-gray-600 mt-1">Kosongkan jika tidak ingin mengubah thumbnail</p>
            </div>

            <!-- Video URL -->
            <div id="videoField" style="display:none;">
                <label class="font-semibold">Video URL</label>
                <input type="text" name="media_url" 
                       value="{{ old('media_url', $educationContent->media_url) }}"
                       class="w-full border rounded p-2"
                       placeholder="https://youtube.com/... atau link MP4">
            </div>

            <!-- Konten Artikel -->
            <div id="contentField">
                <label class="font-semibold">Isi Artikel</label>
                <div id="editor" class="bg-white border rounded"></div>
                <input type="hidden" name="content" id="contentInput">
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                Update
            </button>
        </form>
    </div>

    <!-- Script langsung di sini -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <script>
        (function() {
            console.log('Edit script loaded');
            
            // Inisialisasi elemen
            const mediaTypeSelect = document.getElementById('mediaType');
            const videoField = document.getElementById('videoField');
            const contentField = document.getElementById('contentField');
            const form = document.getElementById('educationForm');
            const contentInput = document.getElementById('contentInput');

            // Toggle field berdasarkan media type
            function updateFields() {
                if (mediaTypeSelect.value === 'video') {
                    videoField.style.display = 'block';
                    contentField.style.display = 'none';
                } else {
                    videoField.style.display = 'none';
                    contentField.style.display = 'block';
                }
            }

            mediaTypeSelect.addEventListener('change', updateFields);
            updateFields();

            // Inisialisasi Quill Editor
            const quill = new Quill('#editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline'],
                        ['link'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'header': [1, 2, 3, false] }],
                        ['clean']
                    ]
                },
                placeholder: 'Tulis konten artikel di sini...'
            });

            console.log('Quill initialized');

            // Load konten existing dari database
            @if($educationContent->content)
                quill.root.innerHTML = {!! json_encode($educationContent->content) !!};
                contentInput.value = {!! json_encode($educationContent->content) !!};
                console.log('Existing content loaded');
            @endif

            // Load old content jika ada validation error
            @if(old('content'))
                quill.root.innerHTML = {!! json_encode(old('content')) !!};
                contentInput.value = {!! json_encode(old('content')) !!};
                console.log('Old content loaded');
            @endif

            // Update input hidden setiap ada perubahan
            quill.on('text-change', function() {
                const html = quill.root.innerHTML;
                contentInput.value = html;
                console.log('Content updated, length:', html.length);
            });

            // Handle form submit
            form.onsubmit = function(e) {
                // Pastikan konten terupdate
                const htmlContent = quill.root.innerHTML;
                contentInput.value = htmlContent;
                
                console.log('=== FORM SUBMIT ===');
                console.log('Media Type:', mediaTypeSelect.value);
                console.log('Content Length:', htmlContent.length);
                console.log('Input value length:', contentInput.value.length);
                
                // Jika video, kosongkan content
                if (mediaTypeSelect.value === 'video') {
                    contentInput.value = '';
                    console.log('Video mode: content cleared');
                    return true;
                }
                
                // Validasi untuk artikel
                const textContent = quill.getText().trim();
                if (textContent.length === 0 || htmlContent.trim() === '<p><br></p>') {
                    alert('Konten artikel tidak boleh kosong!');
                    return false;
                }
                
                console.log('Form submitting...');
                return true;
            };

            console.log('All event listeners attached');
        })();
    </script>
@endsectio