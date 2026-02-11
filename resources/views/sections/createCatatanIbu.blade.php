<div class="max-w-3xl mx-auto p-6 py-16">

    <h1 class="text-2xl font-bold mb-6 py-4">Tambah Catatan Ibu Pintar</h1>

    @error('photo')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
    
    <form method="POST" action="{{ route('notes.store') }}" enctype="multipart/form-data" x-data="{ items: [{ makanan: '', urt: '', gizi: '' }] }">
        @csrf

        <div class="mb-4">
            <label class="font-semibold">Menu Makan Hari Ini</label>
            <input type="text" name="food_menu" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="font-semibold">Makanan yang Dihabiskan</label>
            <input type="text" name="food_consumed" class="w-full border p-2 rounded" required>
        </div>

        <h3 class="mt-6 text-lg font-bold">Detail Makanan</h3>

        <!-- Dynamic Items -->
        <template x-for="(item, index) in items" :key="index">
            <div class="grid grid-cols-3 gap-4 mt-3">

                <input type="text" :name="'items[' + index + '][makanan]'" class="border p-2 rounded"
                    placeholder="Makanan" x-model="item.makanan" required>

                <input type="text" :name="'items[' + index + '][urt]'" class="border p-2 rounded" placeholder="URT"
                    x-model="item.urt" required>

                <input type="text" :name="'items[' + index + '][gizi]'" class="border p-2 rounded" placeholder="Gizi"
                    x-model="item.gizi" required>

            </div>
        </template>

        <button type="button" class="mt-3 px-3 py-1 bg-green-600 text-white rounded"
            @click="items.push({ makanan: '', urt: '', gizi: '' })">
            + Tambah Baris
        </button>

        <div class="mt-6">
            <label class="font-semibold">Upload Foto Makanan</label>
            <input type="file" name="photo" class="w-full border p-2 mt-2 rounded">
        </div>

        <div class="mt-6">
            <label class="font-semibold">Keluhan Ibu</label>
            <textarea name="keluhan" class="w-full border p-2 rounded" rows="4" placeholder="Tuliskan keluhan ibu jika ada..."></textarea>
        </div>

        <button class="mt-6 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Simpan Catatan
        </button>

    </form>
</div>
