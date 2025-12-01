@extends('admin.layout.app-layout')

@section('title', 'Bank Soal')

@section('content')
<div class="p-6">

    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">Bank Soal</h1>

        <a href="{{ route('quizzes.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">
            + Tambah Soal
        </a>
    </div>

    <table class="w-full bg-white rounded shadow">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3">Konten</th>
                <th class="p-3">Jenis</th>
                <th class="p-3">Pertanyaan</th>
                <th class="p-3">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($quizzes as $q)
                <tr class="border-t">
                    <td class="p-3">{{ $q->educationContent->title }}</td>
                    <td class="p-3 capitalize">{{ $q->type }}</td>
                    <td class="p-3">{{ Str::limit($q->question, 60) }}</td>

                    <td class="p-3 flex gap-2">
                        <a href="{{ route('quizzes.edit', $q->id) }}" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</a>

                        <form method="POST" action="{{ route('quizzes.destroy', $q->id) }}"
                              onsubmit="return confirm('Hapus soal ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="px-2 py-1 bg-red-600 text-white rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $quizzes->links() }}
    </div>
</div>
@endsection
