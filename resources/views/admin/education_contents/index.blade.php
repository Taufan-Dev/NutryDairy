@extends('admin.layout.app-layout')

@section('title', 'Konten Edukasi')

@section('content')
    <div class="p-6">
        <div class="flex justify-between mb-4">
            <h1 class="text-2xl font-bold">Konten Edukasi</h1>

            <a href="{{ route('education_contents.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">
                + Tambah Konten
            </a>
        </div>

        <table class="w-full bg-white shadow rounded">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">Judul</th>
                    <th class="p-3">Kategori</th>
                    <th class="p-3">Tipe</th>
                    <th class="p-3">Media</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contents as $item)
                    <tr class="border-t">
                        <td class="p-3">{{ $item->title }}</td>
                        <td class="p-3">{{ $item->category }}</td>
                        <td class="p-3 capitalize">{{ $item->type }}</td>
                        <td class="p-3">{{ $item->media_type }}</td>

                        <td class="p-3 flex gap-2">
                            <a href="{{ route('education_contents.edit', $item->id) }}"
                                class="px-2 py-1 bg-green-500 text-white rounded">Edit</a>

                            <form action="{{ route('education_contents.destroy', $item->id) }}" method="POST"
                                onsubmit="return confirm('Hapus konten ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="px-2 py-1 bg-red-600 text-white rounded">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $contents->links() }}
        </div>
    </div>
@endsection
