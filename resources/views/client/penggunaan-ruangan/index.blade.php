<x-admin-layout>

    <!-- Title -->
    <x-slot name="title">
        Penggunaan Ruangan
    </x-slot>

    @include('components.alert')

    <!-- Tailwind CSS & AlpineJS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Flatpickr CSS & JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Flatpickr Time Plugin -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/confirmDate/confirmDate.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/confirmDate/confirmDate.css">

    <form x-data="formHandler()" class="bg-white p-8 rounded shadow mb-5 pb-5" method="POST"
        action="{{ route('client.penggunaan-ruangan.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Ruangan -->
        <div class="mb-6">
            <label class="block font-semibold mb-2">Ruangan<span class="text-red-600">*</span></label>
            <select name="ruangan_id" class="border border-gray-300 px-4 py-2 rounded w-full" required>
                <option value="" disabled selected>Pilih Ruangan</option>
                @foreach ($ruangans as $ruangan)
                    <option value="{{ $ruangan->id }}">{{ $ruangan->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Durasi Kegiatan -->
        <div class="mb-6">
            <label class="block font-semibold mb-2">Durasi Kegiatan<span class="text-red-600">*</span></label>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1">Waktu Mulai<span class="text-red-600">*</span></label>
                    <input type="text" id="start_time" name="waktu_mulai" x-model="startTime"
                        class="w-full border border-gray-300 px-4 py-2 rounded" required placeholder="2020-01-01 00:00">
                </div>
                <div>
                    <label class="block mb-1">Waktu Selesai<span class="text-red-600">*</span></label>
                    <input type="text" id="end_time" name="waktu_selesai" x-model="endTime"
                        class="w-full border border-gray-300 px-4 py-2 rounded" required placeholder="2020-01-01 02:00"
                        :disabled="!startTime">
                    <p x-show="errorMessage" x-text="errorMessage" class="text-red-600 text-sm mt-1"></p>
                </div>
            </div>
        </div>

        <!-- Tujuan Penggunaan -->
        <div class="mb-6">
            <label class="block font-semibold mb-2">Tujuan Penggunaan<span class="text-red-600">*</span></label>
            <input name="tujuan_penggunaan" type="text" class="w-full border border-gray-300 px-4 py-2 rounded"
                required value="{{ old('tujuan_penggunaan') }}" placeholder="Tujuan Penggunaan">
        </div>

        <!-- Surat -->
        <div class="mb-6">
            <label class="block font-semibold mb-2">Surat (Opsional)</label>
            <input name="penanggung_jawab" type="file" accept="application/pdf" class="w-full border border-gray-300 px-4 py-2 rounded">
        </div>

        <!-- Submit -->
        <div class="text-center">
            <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700" type="submit">SUBMIT</button>
        </div>
    </form>

    <script>
        function formHandler() {
            return {
                startTime: '',
                endTime: '',
                errorMessage: '',
                endPicker: null, // reference to end_time flatpickr

                init() {
                    const startPicker = flatpickr("#start_time", {
                        enableTime: true,
                        dateFormat: "Y-m-d H:i",
                        time_24hr: true,
                        minDate: "today",
                        onChange: (selectedDates, dateStr) => {
                            this.startTime = dateStr;
                            this.updateEndPickerMinDate(dateStr);
                            this.validateTimes();
                        }
                    });

                    this.endPicker = flatpickr("#end_time", {
                        enableTime: true,
                        dateFormat: "Y-m-d H:i",
                        time_24hr: true,
                        minDate: "today", // default, will be updated dynamically
                        onChange: (selectedDates, dateStr) => {
                            this.endTime = dateStr;
                            this.validateTimes();
                        }
                    });
                },

                updateEndPickerMinDate(startDateStr) {
                    if (this.endPicker) {
                        this.endPicker.set('minDate', startDateStr);
                    }
                },

                validateTimes() {
                    if (this.startTime && this.endTime && this.endTime < this.startTime) {
                        this.errorMessage = "Waktu selesai tidak boleh lebih awal dari waktu mulai.";
                        this.endTime = '';
                        document.getElementById('end_time').value = '';
                    } else {
                        this.errorMessage = '';
                    }
                }
            }
        }
    </script>

</x-admin-layout>
