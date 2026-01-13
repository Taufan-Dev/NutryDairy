@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-16">

    <h1 class="text-3xl font-bold mb-8">Profil Saya</h1>

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

    <form method="POST" action="{{ route('profile.update') }}"
          enctype="multipart/form-data"
          class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @csrf
        @method('PATCH')

        {{-- LEFT: FOTO PROFIL --}}
        <div class="md:col-span-1 flex flex-col items-center text-center">
            <div class="w-40 h-40 rounded-full overflow-hidden border mb-4">
                <img
                    src="{{ $user->profile_pict
                        ? asset('storage/' . $user->profile_pict)
                        : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                    alt="Foto Profil"
                    class="w-full h-full object-cover">
            </div>

            <label class="font-semibold mb-2">Foto Profil</label>
            <input type="file" name="profile_pict"
                class="w-full text-sm border p-2 rounded
                @error('profile_pict') border-red-500 @enderror">
        </div>

        {{-- RIGHT: FORM --}}
        <div class="md:col-span-2 space-y-5">

            <div>
                <label class="font-semibold">Nama</label>
                <input type="text" name="name"
                    value="{{ old('name', $user->name) }}"
                    class="w-full border p-2 rounded mt-1
                    @error('name') border-red-500 @enderror">
            </div>

            <div>
                <label class="font-semibold">Email</label>
                <input type="email" name="email"
                    value="{{ old('email', $user->email) }}"
                    class="w-full border p-2 rounded mt-1
                    @error('email') border-red-500 @enderror">
            </div>

            <div>
                <label class="font-semibold">Nomor Telepon</label>
                <input type="text" name="phone"
                    value="{{ old('phone', $user->phone) }}"
                    class="w-full border p-2 rounded mt-1
                    @error('phone') border-red-500 @enderror">
            </div>

            <div>
                <label class="font-semibold">Alamat</label>
                <input type="text" name="address"
                    value="{{ old('address', $user->address) }}"
                    class="w-full border p-2 rounded mt-1
                    @error('address') border-red-500 @enderror">
            </div>

            <hr class="my-4">

            <p class="text-gray-600 text-sm">
                Kosongkan password jika tidak ingin mengubah
            </p>

            <div>
                <label class="font-semibold">Password Baru</label>
                <input type="password" name="password"
                    class="w-full border p-2 rounded mt-1
                    @error('password') border-red-500 @enderror">
            </div>

            <div>
                <label class="font-semibold">Konfirmasi Password</label>
                <input type="password" name="password_confirmation"
                    class="w-full border p-2 rounded mt-1">
            </div>

            <button
                class="w-full bg-sky-500 hover:bg-sky-600 text-white py-2 rounded-lg">
                Simpan Perubahan
            </button>
        </div>
    </form>

</div>
@endsection
