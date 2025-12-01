@extends('admin.layout.app-layout')

@section('title', 'Tambah Soal')

@section('content')
<div class="p-6 max-w-3xl mx-auto">

    <h1 class="text-2xl font-bold mb-4">Tambah Soal</h1>

    <form method="POST" action="{{ route('quizzes.store') }}" class="space-y-4">
        @csrf

        <div>
            <label class="font-semibold">Pilih Materi</label>
            <select name="education_content_id" class="w-full border p-2 rounded">
                @foreach ($contents as $c)
                    <option value="{{ $c->id }}">{{ $c->title }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="font-semibold">Tipe Soal</label>
            <select name="type" class="w-full border p-2 rounded">
                <option value="pretest">Pretest</option>
                <option value="posttest">Posttest</option>
            </select>
        </div>

        <div>
            <label class="font-semibold">Pertanyaan</label>
            <textarea name="question" class="w-full border p-2 rounded"></textarea>
        </div>

        <div>
            <label class="font-semibold">Pilihan Jawaban</label>
            
            <div id="option-wrapper" class="space-y-2">
                <input type="text" name="options[]" class="w-full border p-2 rounded" placeholder="Pilihan 1">
                <input type="text" name="options[]" class="w-full border p-2 rounded" placeholder="Pilihan 2">
            </div>

            <button type="button" onclick="addOption()" class="mt-2 px-3 py-1 bg-green-600 text-white rounded">
                + Tambah Pilihan
            </button>
        </div>

        <div>
            <label class="font-semibold">Jawaban Benar</label>
            <input type="text" name="answer" class="w-full border p-2 rounded">
        </div>

        <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
    </form>
</div>

<script>
function addOption() {
    const wrapper = document.getElementById('option-wrapper');
    const input = document.createElement('input');
    input.type = "text";
    input.name = "options[]";
    input.className = "w-full border p-2 rounded";
    input.placeholder = "Pilihan tambahan";
    wrapper.appendChild(input);
}
</script>
@endsection
