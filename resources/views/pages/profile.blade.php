@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto px-6 py-16">

    <h1 class="text-3xl font-bold mb-6">Profil Saya</h1>

    {{-- SUCCESS --}}
    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- VALIDATION ERRORS --}}
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('PATCH')

        <div>
            <label class="font-semibold">Nama</label>
            <input type="text" name="name"
                value="{{ old('name', $user->name) }}"
                class="w-full border p-2 rounded mt-1 @error('name') border-red-500 @enderror">
        </div>

        <div>
            <label class="font-semibold">Email</label>
            <input type="email" name="email"
                value="{{ old('email', $user->email) }}"
                class="w-full border p-2 rounded mt-1 @error('email') border-red-500 @enderror">
        </div>

        <hr class="my-4">

        <p class="text-gray-600 text-sm">
            Kosongkan password jika tidak ingin mengubah
        </p>

        <div>
            <label class="font-semibold">Password Baru</label>
            <input type="password" name="password"
                class="w-full border p-2 rounded mt-1 @error('password') border-red-500 @enderror">
        </div>

        <div>
            <label class="font-semibold">Konfirmasi Password</label>
            <input type="password" name="password_confirmation"
                class="w-full border p-2 rounded mt-1">
        </div>

        <button class="w-full bg-sky-500 hover:bg-sky-600 text-white py-2 rounded-lg">
            Simpan Perubahan
        </button>
    </form>

</div>
@endsection
