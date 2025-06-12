<x-admin-layout>

    <!-- Title -->
    <x-slot name="title">
        Penggunaan Alat
    </x-slot>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>

    <form class="bg-white p-8 rounded shadow mb-5" method="POST" action="#" enctype="multipart/form-data">
        <div x-data="{ daftarAlat: [], alat_id: '', qty: 1 }">
            <!-- Tambah Alat -->
            <div class="mb-6">
                <label class="block font-semibold mb-2">Tambah Alat Yang Dipinjam</label>
                <div class="flex items-center gap-2 mb-2">
                    <select x-model="alat_id" class="border border-gray-300 px-4 py-2 rounded w-1/2">
                        <option value="" disabled selected>Pilih Alat</option>
                        @foreach ($alats as $alat)
                            <option value="{{ $alat->name }}">{{ $alat->name }}</option>
                        @endforeach
                    </select>
                    <input x-model="qty" type="number" min="1"
                        class="border border-gray-300 px-4 py-2 rounded w-20">
                    <button type="button"
                        @click="if (alat_id) { daftarAlat.push({ nama: alat_id, qty: qty }); alat_id=''; qty=1 }"
                        class="bg-blue-600 text-white px-4 py-2 rounded">+</button>
                </div>
                <ul class="list-decimal pl-5 space-y-1">
                    <template x-for="(item, index) in daftarAlat" :key="index">
                        <li x-text="`${item.nama} (Qty: ${item.qty})`"></li>
                    </template>
                </ul>
            </div>
        </div>

        <!-- Durasi Kegiatan -->
        <div class="mb-6">
            <label class="block font-semibold mb-2">Durasi Kegiatan</label>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1">Tanggal & Jam Mulai</label>
                    <input name="start_datetime" type="datetime-local"
                        class="w-full border border-gray-300 px-4 py-2 rounded">
                </div>
                <div>
                    <label class="block mb-1">Tanggal & Jam Selesai</label>
                    <input name="end_datetime" type="datetime-local"
                        class="w-full border border-gray-300 px-4 py-2 rounded">
                </div>
            </div>
        </div>

        <!-- Tujuan Peminjaman -->
        <div class="mb-6">
            <label class="block font-semibold mb-2">Tujuan Peminjaman</label>
            <input name="tujuan_peminjaman" type="text" class="w-full border border-gray-300 px-4 py-2 rounded">
        </div>
        </div>

        <!-- Submit -->
        <div class="text-center">
            <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700" type="submit">SUBMIT</button>
        </div>
    </form>

</x-admin-layout>
