<x-admin-layout>

    <!-- Title -->
    <x-slot name="title">
        Penggunaan Alat
    </x-slot>

    @include('components.alert')

    <!-- Tailwind CSS & AlpineJS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>

    <!-- Flatpickr CSS & JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Flatpickr Time Plugin -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/confirmDate/confirmDate.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/confirmDate/confirmDate.css">

    @if($alats->isEmpty())
        <div class="text-danger">
            <p class="mb-3">Tidak ada alat yang tersedia, silahkan ajukan peminjaman alat terlebih dahulu.</p>
            <a href="{{ route('client.pengajuan-peminjaman.index') }}" class="btn btn-primary"><i class="fas fa-file-signature"></i> Ajukan Peminjaman Alat</a>
        </div>
    @endif

    <div x-data="penggunaanAlat()">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <template x-for="(group, baseName) in compactedAlat" :key="baseName">
                <div
                    class="rounded-xl shadow-lg p-4 flex flex-col border-2 transition-all duration-300 bg-gradient-to-br from-blue-50 via-white to-pink-50 border-blue-200 hover:border-blue-600 hover:scale-105">
                    <img :src="group[0].img ? '/storage/' + group[0].img : '/assets/img/default.png'"
                        class="w-full h-40 object-cover rounded-t-xl mb-4 border-b-4 border-white shadow-md"
                        :alt="baseName">
                    <div class="font-bold text-lg mb-1 text-blue-700" x-text="baseName"></div>
                    <div class="text-gray-500 text-sm mb-1" x-text="group[0].ruangan?.name"></div>
                    <div class="text-sm mb-1">Total: <span class="font-semibold text-blue-600"
                            x-text="group.length"></span></div>
                    <div class="text-sm mb-2">Tersedia: <span class="font-semibold text-green-600"
                            x-text="group.filter(a => a.status === 'Tersedia').length"></span></div>
                    <button @click="openModal(baseName)"
                        class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-4 py-2 rounded shadow hover:from-blue-600 hover:to-blue-500 w-full transition-all duration-300 font-semibold mt-2">Ajukan
                        Penggunaan</button>
                    <button @click="openDetailModal(baseName)"
                        class="bg-gradient-to-r from-gray-400 to-gray-500 text-white px-4 py-2 rounded shadow w-full mt-2">Detail</button>
                </div>
            </template>
        </div>

        <!-- Modal -->
        <div x-show="showModal" class="fixed inset-0 flex items-center justify-center z-50"
            style="background: rgba(0,0,0,0.4); display: none;" @click.self="closeModal">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
                <button @click="closeModal"
                    class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">&times;</button>
                <h2 class="text-xl font-bold mb-4">Pinjam Alat: <span x-text="modalBaseName"></span></h2>
                <form @submit.prevent="submitForm">
                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Tujuan Penggunaan<span class="text-red-600">*</span></label>
                        <textarea x-model="form.tujuan_penggunaan" class="w-full border border-gray-300 px-3 py-2 rounded" required
                            placeholder="Jelaskan tujuan penggunaan alat ini..."></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-3 mb-4">
                        <div>
                            <label class="block font-semibold mb-1">Tanggal Mulai<span class="text-red-600">*</span></label>
                            <input type="text" x-ref="startTime" x-model="form.waktu_mulai"
                                class="w-full border border-gray-300 px-3 py-2 rounded" required
                                placeholder="Pilih tanggal">
                        </div>
                        <div>
                            <label class="block font-semibold mb-1">Tanggal Selesai<span class="text-red-600">*</span></label>
                            <input type="text" x-ref="endTime" x-model="form.waktu_selesai"
                                class="w-full border border-gray-300 px-3 py-2 rounded" required
                                placeholder="Pilih tanggal">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Jumlah<span class="text-red-600">*</span></label>
                        <input type="number" min="1" :max="modalMaxQty" x-model.number="form.qty"
                            class="w-full border border-gray-300 px-3 py-2 rounded" required>
                        <div class="text-xs text-gray-500 mt-1">Tersedia: <span x-text="modalMaxQty"></span> unit</div>
                    </div>
                    <template x-if="errorMessage">
                        <div class="text-red-600 text-sm mb-2" x-text="errorMessage"></div>
                    </template>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="closeModal"
                            class="px-4 py-2 rounded border border-gray-300">Batal</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Ajukan
                            Penggunaan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Detail Alat -->
        <div x-show="showDetailModal" class="fixed inset-0 flex items-center justify-center z-50"
            style="background: rgba(0,0,0,0.4); display: none;" @click.self="closeDetailModal">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 relative">
                <button @click="closeDetailModal"
                    class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">&times;</button>
                <h2 class="text-xl font-bold mb-4">Detail Alat: <span x-text="detailBaseName"></span></h2>
                <template x-if="compactedAlat[detailBaseName]">
                    <div>
                        <div class="mb-3">
                            <span class="font-bold">Ringkasan:</span>
                            <p class="m-0 p-0">Total Alat: <span x-text="compactedAlat[detailBaseName].length"></span>
                            </p>
                            <p class="m-0 p-0">Jumlah Baik: <span class="text-green-600"
                                    x-text="compactedAlat[detailBaseName].filter(a => a.condition === 'Baik').length"></span>
                            </p>
                            <p class="m-0 p-0">Jumlah Rusak: <span class="text-red-600"
                                    x-text="compactedAlat[detailBaseName].filter(a => a.condition === 'Rusak').length"></span>
                            </p>
                            <p class="m-0 p-0">Jumlah Tersedia: <span class="text-blue-600"
                                    x-text="compactedAlat[detailBaseName].filter(a => a.status === 'Tersedia').length"></span>
                            </p>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full border text-xs">
                                <thead>
                                    <tr>
                                        <th class="border px-2 py-1">Nama Alat</th>
                                        <th class="border px-2 py-1">Kondisi</th>
                                        <th class="border px-2 py-1">Status</th>
                                        <th class="border px-2 py-1">Lokasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template x-for="alat in compactedAlat[detailBaseName]" :key="alat.id">
                                        <tr>
                                            <td class="border px-2 py-1" x-text="alat.name"></td>
                                            <td class="border px-2 py-1" x-text="alat.condition"></td>
                                            <td class="border px-2 py-1" x-text="alat.status"></td>
                                            <td class="border px-2 py-1" x-text="alat.ruangan?.name || '-'"></td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <script>
        function penggunaanAlat() {
            const allAlats = @json($alats);
            let compacted = {};
            allAlats.forEach(alat => {
                const baseName = alat.name.replace(/\s+#\d+$/, '');
                if (!compacted[baseName]) compacted[baseName] = [];
                compacted[baseName].push(alat);
            });
            return {
                compactedAlat: compacted,
                showModal: false,
                modalBaseName: '',
                modalMaxQty: 1,
                modalAlatIds: [],
                errorMessage: '',
                form: {
                    tujuan_penggunaan: '',
                    waktu_mulai: '',
                    waktu_selesai: '',
                    qty: 1,
                },
                showDetailModal: false,
                detailBaseName: '',
                openDetailModal(baseName) {
                    this.detailBaseName = baseName;
                    this.showDetailModal = true;
                },
                closeDetailModal() {
                    this.showDetailModal = false;
                },
                openModal(baseName) {
                    this.modalBaseName = baseName;
                    const group = this.compactedAlat[baseName] || [];
                    this.modalMaxQty = group.filter(a => a.status === 'Tersedia').length;
                    this.modalAlatIds = group.filter(a => a.status === 'Tersedia').map(a => a.id);
                    this.form = {
                        tujuan_penggunaan: '',
                        waktu_mulai: '',
                        waktu_selesai: '',
                        qty: 1
                    };
                    this.errorMessage = '';
                    this.showModal = true;
                    this.$nextTick(() => {
                        if (this.$refs.startTime) {
                            flatpickr(this.$refs.startTime, {
                                enableTime: true,
                                dateFormat: 'Y-m-d H:i',
                                time_24hr: true,
                                minDate: 'today',
                                onChange: (selectedDates, dateStr) => {
                                    this.form.waktu_mulai = dateStr;
                                    if (this.$refs.endTime._flatpickr) {
                                        this.$refs.endTime._flatpickr.set('minDate', dateStr);
                                    }
                                }
                            });
                        }
                        if (this.$refs.endTime) {
                            flatpickr(this.$refs.endTime, {
                                enableTime: true,
                                dateFormat: 'Y-m-d H:i',
                                time_24hr: true,
                                minDate: 'today',
                                onChange: (selectedDates, dateStr) => {
                                    this.form.waktu_selesai = dateStr;
                                }
                            });
                        }
                    });
                },
                closeModal() {
                    this.showModal = false;
                },
                submitForm() {
                    if (!this.form.tujuan_penggunaan || !this.form.waktu_mulai || !this.form.waktu_selesai || !this.form
                        .qty) {
                        this.errorMessage = 'Semua field wajib diisi.';
                        return;
                    }
                    if (this.form.qty < 1 || this.form.qty > this.modalMaxQty) {
                        this.errorMessage = 'Jumlah tidak valid.';
                        return;
                    }
                    if (this.form.waktu_selesai < this.form.waktu_mulai) {
                        this.errorMessage = 'Tanggal selesai tidak boleh lebih awal dari tanggal mulai.';
                        return;
                    }
                    // Kirim form secara dinamis
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = "{{ route('client.penggunaan-alat.store') }}";
                    form.innerHTML = `@csrf` +
                        this.modalAlatIds.slice(0, this.form.qty).map(id =>
                            `<input type='hidden' name='alat_id[]' value='${id}' />`).join('') +
                        `<input type='hidden' name='waktu_mulai' value='${this.form.waktu_mulai}' />` +
                        `<input type='hidden' name='waktu_selesai' value='${this.form.waktu_selesai}' />` +
                        `<input type='hidden' name='tujuan_penggunaan' value='${this.form.tujuan_penggunaan.replace(/'/g, '&#39;')}' />`;
                    document.body.appendChild(form);
                    form.submit();
                }
            }
        }
    </script>

</x-admin-layout>
