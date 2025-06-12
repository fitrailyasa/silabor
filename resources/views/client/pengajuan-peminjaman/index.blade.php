<x-admin-layout>

    <!-- Title -->
    <x-slot name="title">
        Pengajuan Peminjaman
    </x-slot>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>

    <form class="bg-white p-8 rounded shadow mb-5" method="POST" action="{{ route('mahasiswa.pengajuan-peminjaman.store') }}" enctype="multipart/form-data">
        <div x-data="{ jenis: 'pribadi', anggota_id: '', daftarAnggota: [], alat_id: '', qty: 1, daftarAlat: [] }">
            <!-- Jenis Peminjaman -->
            <div class="mb-6">
                <label class="font-semibold block mb-2">Jenis Peminjaman</label>
                <div class="flex space-x-4">
                    <label>
                        <input type="radio" name="jenis" value="pribadi" x-model="jenis" class="hidden">
                        <div :class="jenis === 'pribadi' ? 'bg-gray-800 text-white' :
                            'bg-white border border-gray-300 text-gray-700'"
                            class="px-4 py-2 rounded cursor-pointer">
                            PRIBADI
                        </div>
                    </label>
                    <label>
                        <input type="radio" name="jenis" value="kelompok" x-model="jenis" class="hidden">
                        <div :class="jenis === 'kelompok' ? 'bg-gray-800 text-white' :
                            'bg-white border border-gray-300 text-gray-700'"
                            class="px-4 py-2 rounded cursor-pointer">
                            KELOMPOK
                        </div>
                    </label>
                </div>
            </div>

            <!-- Tambah Anggota (hanya jika kelompok) -->
            <div class="mb-6" x-show="jenis === 'kelompok'" x-cloak>
                <label class="block font-semibold mb-2">Tambah Anggota</label>
                <div class="flex items-center gap-2 mb-2">
                    <select x-model="anggota_id" class="border border-gray-300 px-4 py-2 rounded w-1/2">
                        <option value="" disabled selected>Pilih Anggota</option>
                        @foreach ($anggotas as $anggota)
                            <option value="{{ $anggota->name }}">{{ $anggota->name }}</option>
                        @endforeach
                    </select>
                    <button type="button"
                        @click="if (anggota && !daftarAnggota.includes(anggota)) { daftarAnggota.push(anggota); anggota = '' }"
                        class="bg-blue-600 text-white px-4 py-2 rounded">+</button>
                </div>
                <ul class="list-decimal pl-5 space-y-1">
                    <template x-for="(item, index) in daftarAnggota" :key="index">
                        <li x-text="`${item}`"></li>
                    </template>
                </ul>
            </div>

            <!-- Keperluan -->
            <div class="mb-6">
                <label class="block font-semibold mb-2">Keperluan</label>
                <input name="tujuan_peminjaman" type="text" class="w-full border border-gray-300 px-4 py-2 rounded"
                    placeholder="Masukkan keperluan">
            </div>

            <!-- Durasi Kegiatan -->
            <div class="mb-6">
                <label class="block font-semibold mb-2">Durasi Kegiatan</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1">Tanggal Mulai</label>
                        <input type="date" class="w-full border border-gray-300 px-4 py-2 rounded">
                    </div>
                    <div>
                        <label class="block mb-1">Tanggal Selesai</label>
                        <input type="date" class="w-full border border-gray-300 px-4 py-2 rounded">
                    </div>
                </div>
            </div>

            <!-- Judul Penelitian -->
            <div class="mb-6">
                <label class="block font-semibold mb-2">Judul Penelitian</label>
                <input name="judul_penelitian" type="text" class="w-full border border-gray-300 px-4 py-2 rounded">
            </div>

            <!-- Dosen Pembimbing -->
            <div class="mb-6">
                <label class="block font-semibold mb-2">Dosen Pembimbing</label>
                <select name="dosen_pembimbing" class="border border-gray-300 px-4 py-2 rounded w-full">
                    <option value="" disabled selected>Pilih Dosen</option>
                    @foreach ($dosens as $dosen)
                        <option value="{{ $dosen->id }}">{{ $dosen->name }}</option>
                    @endforeach
                </select>
            </div>

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

        <!-- Submit -->
        <div class="text-center">
            <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700" type="submit">SUBMIT</button>
        </div>
    </form>

</x-admin-layout>
