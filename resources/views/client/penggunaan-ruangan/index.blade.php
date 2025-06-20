<x-admin-layout>

    <!-- Title -->
    <x-slot name="title">
        Penggunaan Ruangan
    </x-slot>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>

    <form class="bg-white p-8 rounded shadow mb-5" method="POST" action="{{ route('mahasiswa.penggunaan-ruangan.store') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <!-- Ruangan -->
            <div class="mb-6">
                <label class="block font-semibold mb-2">Ruangan</label>
                <select name="ruangan_id" class="border border-gray-300 px-4 py-2 rounded w-full">
                    <option value="" disabled selected>Pilih Ruangan</option>
                    @foreach ($ruangans as $ruangan)
                        <option value="{{ $ruangan->id }}">{{ $ruangan->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Durasi Kegiatan -->
            <div class="mb-6">
                <label class="block font-semibold mb-2">Durasi Kegiatan</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1">Tanggal & Jam Mulai</label>
                        <input name="start_datetime" type="datetime-local"
                            class="w-full border border-gray-300 px-4 py-2 rounded" required>
                    </div>
                    <div>
                        <label class="block mb-1">Tanggal & Jam Selesai</label>
                        <input name="end_datetime" type="datetime-local"
                            class="w-full border border-gray-300 px-4 py-2 rounded" required>
                    </div>
                </div>
            </div>

            <!-- Tujuan Peminjaman -->
            <div class="mb-6">
                <label class="block font-semibold mb-2">Tujuan Peminjaman</label>
                <input name="tujuan_peminjaman" type="text" class="w-full border border-gray-300 px-4 py-2 rounded" required value="{{ old('tujuan_peminjaman') }}">
            </div>
        </div>

        <!-- Submit -->
        <div class="text-center">
            <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700" type="submit">SUBMIT</button>
        </div>
    </form>

</x-admin-layout>
