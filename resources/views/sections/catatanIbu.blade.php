<div class="max-w-4xl mx-auto px-6 py-16">

    <div class="flex justify-between mb-6 py-4">
        <h1 class="text-2xl font-bold">Catatan Ibu Pintar</h1>
        <a href="{{ route('notes.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">+ Tambah Catatan</a>
    </div>

    @foreach ($notes as $note)
    <div class="bg-white shadow rounded p-4 mb-4">

        <h3 class="font-bold text-lg">{{ $note->food_menu }}</h3>

        <p class="text-sm text-gray-600">Makanan dihabiskan: {{ $note->food_consumed }}</p>

        @if ($note->photo)
            <img src="{{ asset('storage/'.$note->photo) }}" class="w-32 mt-2 rounded">
        @endif

        <table class="w-full mt-3 border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">Makanan</th>
                    <th class="p-2 border">URT</th>
                    <th class="p-2 border">Gizi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($note->items as $i)
                <tr>
                    <td class="p-2 border">{{ $i['makanan'] }}</td>
                    <td class="p-2 border">{{ $i['urt'] }}</td>
                    <td class="p-2 border">{{ $i['gizi'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    @endforeach

</div>