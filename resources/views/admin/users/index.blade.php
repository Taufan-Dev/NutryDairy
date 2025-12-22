@extends('admin.layout.app-layout')

@section('title', 'Dashboard')

@push('css')
@endpush

@push('scripts')
@endpush

@section('content')
    <div class="max-w-6xl mx-auto mt-24 px-4">

        <h1 class="text-2xl font-bold mb-6">Manajemen User</h1>

        @if (session('error'))
            <div class="mb-4 flex items-center gap-2 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <i class="fas fa-circle-exclamation"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if (session('success'))
            <div class="mb-4 flex items-center gap-2 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                <i class="fas fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <table class="w-full border text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-3 py-2">Nama</th>
                    <th class="border px-3 py-2">Email</th>
                    <th class="border px-3 py-2">Role</th>
                    <th class="border px-3 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="border px-3 py-2">{{ $user->name }}</td>
                        <td class="border px-3 py-2">{{ $user->email }}</td>
                        <td class="border px-3 py-2 capitalize">{{ $user->role }}</td>
                        <td class="border px-3 py-2 space-x-2">
                            <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600">Edit</a>

                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Hapus user?')" class="text-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $users->links() }}
        </div>

    </div>
@endsection
