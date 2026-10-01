<x-app-layout>

    <x-slot name="header">
        Edit Perjalanan Dinas
    </x-slot>

    <x-slot name="description">
        Perbarui data perjalanan dinas pegawai DPRD Kota Cirebon
    </x-slot>

    <div class="max-w-5xl mx-auto py-10 space-y-8">

        {{-- CARD --}}
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">

            {{-- HEADER CARD --}}
            <div class="px-8 py-6 bg-gradient-to-r from-blue-600 to-indigo-600 text-white">
                <h3 class="text-xl font-semibold flex items-center gap-2">
                    ✏️ Edit Perjalanan Dinas
                </h3>
                <p class="text-sm text-blue-100 mt-1">
                    Perbarui data perjalanan dinas dengan benar
                </p>
            </div>

{{-- BODY --}}
<div class="px-8 pb-8 pt-0 space-y-6">

    {{-- ERROR --}}
    @if ($errors->any())
        <div class="rounded-2xl border border-red-200 bg-red-50 px-6 py-4 text-red-700">
            <ul class="list-disc list-inside text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        method="POST"
        action="{{ route('perjalanan-dinas.update', $data->id) }}"
        enctype="multipart/form-data"
        class="space-y-10">
        @csrf
        @method('PUT')

        {{-- SECTION: PEGAWAI --}}
        <div class="space-y-4">
            <h4 class="text-base font-semibold text-gray-800 border-b pb-2">
                👤 Data Pegawai
            </h4>

                        <div>
                            <label class="block text-sm font-medium mb-1">
                                Pegawai / Anggota
                            </label>

                            <select
                                name="user_id[]"
                                id="pegawai-select"
                                multiple
                                required
                                class="w-full">
                                @foreach ($pegawai as $p)
                                    <option value="{{ $p->id }}"
                                        @selected($data->pegawai->contains($p->id))>
                                        {{ $p->name }} ({{ $p->jabatan }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- SECTION: PERJALANAN --}}
                    <div class="space-y-4">
                        <h4 class="text-base font-semibold text-gray-800 dark:text-gray-200 border-b pb-2">
                            ✈️ Detail Perjalanan
                        </h4>

                        {{-- TUJUAN --}}
                        <div>
                            <label class="block text-sm font-medium mb-1">
                                Tujuan Perjalanan
                            </label>
                            <input
                                type="text"
                                name="tujuan"
                                value="{{ old('tujuan', $data->tujuan) }}"
                                required
                                class="w-full rounded-xl border-gray-300 focus:ring focus:ring-blue-200">
                        </div>

                        {{-- TANGGAL --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium mb-1">
                                    Tanggal Berangkat
                                </label>
                                <input
                                    type="date"
                                    name="tanggal_berangkat"
                                    value="{{ old('tanggal_berangkat', $data->tanggal_berangkat) }}"
                                    required
                                    class="w-full rounded-xl border-gray-300 focus:ring focus:ring-blue-200">
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-1">
                                    Tanggal Pulang
                                </label>
                                <input
                                    type="date"
                                    name="tanggal_pulang"
                                    value="{{ old('tanggal_pulang', $data->tanggal_pulang) }}"
                                    required
                                    class="w-full rounded-xl border-gray-300 focus:ring focus:ring-blue-200">
                            </div>
                        </div>
                    </div>

                    {{-- SECTION: ADMINISTRASI --}}
                    <div class="space-y-4">
                        <h4 class="text-base font-semibold text-gray-800 dark:text-gray-200 border-b pb-2">
                            💼 Administrasi
                        </h4>

                        {{-- ANGGARAN --}}
                        <div>
                            <label class="block text-sm font-medium mb-1">
                                Anggaran (Rp)
                            </label>
                            <input
                                type="number"
                                name="anggaran"
                                value="{{ old('anggaran', $data->anggaran) }}"
                                required
                                class="w-full rounded-xl border-gray-300 focus:ring focus:ring-green-200">
                        </div>

                        {{-- SURAT TUGAS --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Surat Tugas (PDF)
                            </label>

                            @if ($data->surat_tugas)
                                <p class="text-sm mb-2 text-gray-600">
                                    File saat ini:
                                    <a href="{{ route('perjalanan-dinas.download-surat-tugas', $data->id) }}"
                                       class="text-blue-600 underline">
                                        Download Surat Tugas
                                    </a>
                                </p>
                            @endif

                            <label
                                id="pdf-wrapper"
                                class="flex items-center gap-3 cursor-pointer
                                       border border-dashed border-gray-300
                                       rounded-xl px-4 py-3
                                       hover:bg-gray-50 transition">

                                <span id="pdf-icon">📄</span>

                                <span id="pdf-name" class="text-sm text-gray-600">
                                    Upload file Surat Tugas baru (opsional)
                                </span>

                                <input
                                    type="file"
                                    name="surat_tugas"
                                    accept="application/pdf"
                                    class="hidden"
                                    onchange="showPDFName(event)">
                            </label>

                            <p id="pdf-info"
                               class="mt-2 hidden text-xs text-gray-500">
                                Klik lagi untuk mengganti file
                            </p>
                        </div>
                    </div>

                    {{-- ACTION --}}
                    <div class="flex justify-end gap-4 pt-6 border-t">
                        <a
                            href="{{ route('perjalanan-dinas.index') }}"
                            class="px-6 py-2.5 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200">
                            ← Kembali
                        </a>

                        <button
                            type="submit"
                            class="px-8 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow">
                            💾 Update Data
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    {{-- SELECT2 --}}
    @push('scripts')
    <script>
        $(document).ready(function () {
            $('#pegawai-select').select2({
                placeholder: 'Pilih pegawai',
                width: '100%'
            });
        });
    </script>
    @endpush

    {{-- SCRIPT PDF --}}
    <script>
        function showPDFName(event) {
            const file = event.target.files[0];
            if (!file) return;

            document.getElementById('pdf-name').textContent = file.name;
            document.getElementById('pdf-info').classList.remove('hidden');

            const wrapper = document.getElementById('pdf-wrapper');
            wrapper.classList.remove('border-gray-300');
            wrapper.classList.add('border-green-400', 'bg-green-50');

            document.getElementById('pdf-icon').textContent = '✅';
        }
    </script>

</x-app-layout>
