@extends('admin.layout.app-layout')

@section('title', 'Tambah Konten Edukasi')

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
        <h1 class="text-2xl font-bold mb-4">Tambah Konten Edukasi</h1>

        @error('thumbnail')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <form id="educationForm" action="{{ route('education_contents.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="font-semibold">Judul</label>
                <input type="text" name="title" value="{{ old('title') }}" class="w-full border rounded p-2" required>
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

            <!-- Video URL -->
            <div id="videoField" style="display:none;">
                <label class="font-semibold">Video URL</label>
                <input type="text" name="media_url" class="w-full border rounded p-2"
                    placeholder="https://youtube.com/... atau link MP4">
            </div>

            <!-- Konten Artikel -->
            <div id="contentField">
                <label class="font-semibold">Isi Artikel</label>
                <div id="editor" class="bg-white border rounded"></div>
                <!-- Gunakan input hidden biasa, lebih reliable -->
                <input type="hidden" name="content" id="contentInput">
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                Simpan
            </button>
        </form>
    </div>

    <!-- Script langsung di sini, bukan di push -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <script>
        // Jangan tunggu DOMContentLoaded karena sudah di akhir content
        (function() {
            console.log('Script loaded');
            
            // Inisialisasi elemen
            const mediaTypeSelect = document.getElementById('mediaType');
            const videoField = document.getElementById('videoField');
            const contentField = document.getElementById('contentField');
            const form = document.getElementById('educationForm');
            const contentInput = document.getElementById('contentInput');

            console.log('Elements:', {
                mediaTypeSelect,
                videoField,
                contentField,
                form,
                contentInput
            });

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

            console.log('Quill initialized:', quill);

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
                console.log('Content HTML:', htmlContent);
                console.log('Content Length:', htmlContent.length);
                console.log('Input name:', contentInput.name);
                console.log('Input value length:', contentInput.value.length);
                console.log('Input value preview:', contentInput.value.substring(0, 100));
                
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
                
                console.log('Form submitting with content length:', contentInput.value.length);
                return true;
            };

            console.log('All event listeners attached');
        })();
    </script>
@endsection