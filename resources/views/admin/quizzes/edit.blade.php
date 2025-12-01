@extends('admin.layout.app-layout')

@section('title', 'Edit Soal')

@section('content')
<div class="p-6 max-w-3xl mx-auto">

    <h1 class="text-2xl font-bold mb-4">Edit Soal</h1>

    <form method="POST" action="{{ route('quizzes.update', $quiz->id) }}" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="font-semibold">Materi</label>
            <select name="education_content_id" class="w-full border p-2 rounded">
                @foreach ($contents as $c)
                    <option value="{{ $c->id }}" {{ $quiz->education_content_id == $c->id ? 'selected' : '' }}>
                        {{ $c->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="font-semibold">Tipe</label>
            <select name="type" class="w-full border p-2 rounded">
                <option value="pretest" {{ $quiz->type == 'pretest' ? 'selected' : '' }}>Pretest</option>
                <option value="posttest" {{ $quiz->type == 'posttest' ? 'selected' : '' }}>Posttest</option>
            </select>
        </div>

        <div>
            <label class="font-semibold">Pertanyaan</label>
            <textarea name="question" class="w-full border p-2 rounded">{{ $quiz->question }}</textarea>
        </div>

        <div>
            <label class="font-semibold">Pilihan Jawaban</label>

            <div id="option-wrapper" class="space-y-2">
                @foreach (json_decode($quiz->options) as $opt)
                    <input type="text" name="options[]" class="w-full border p-2 rounded" value="{{ $opt }}">
                @endforeach
            </div>

            <button type="button" onclick="addOption()" class="mt-2 px-3 py-1 bg-green-600 text-white rounded">
                + Tambah Pilihan
            </button>
        </div>

        <div>
            <label class="font-semibold">Jawaban Benar</label>
            <input type="text" name="answer" value="{{ $quiz->answer }}" class="w-full border p-2 rounded">
        </div>

        <button class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
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
