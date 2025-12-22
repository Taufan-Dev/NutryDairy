@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-24 px-4">

    <h1 class="text-xl font-bold mb-4">Edit User</h1>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 px-4 py-2 rounded">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.users.update', $user) }}"
          class="bg-white border rounded-lg p-6 space-y-4">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full p-2 border rounded">

        <input type="email" value="{{ $user->email }}" disabled class="w-full p-2 border bg-gray-100">

        <select name="role" class="w-full p-2 border rounded">
            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
        </select>

        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full p-2 border rounded">

        <textarea name="address" class="w-full p-2 border rounded">{{ old('address', $user->address) }}</textarea>

        <button class="bg-sky-500 text-white px-4 py-2 rounded">
            Simpan
        </button>
    </form>

</div>
@endsection
