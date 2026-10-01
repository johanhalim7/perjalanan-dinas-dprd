<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold">Detail Perjalanan Dinas</h2>
    </x-slot>

    @php
        $user = auth()->user();
    @endphp

    <div class="max-w-5xl mx-auto py-8 space-y-6">

{{-- INFO UTAMA --}}
<div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 space-y-8">

    {{-- HEADER --}}
    <div class="flex items-center gap-3">
        <div class="h-10 w-10 rounded-xl bg-blue-100 flex items-center justify-center text-blue-700">
            📄
        </div>
        <h3 class="text-lg font-semibold text-gray-800">
            Informasi Perjalanan Dinas
        </h3>
    </div>

    {{-- PEGAWAI --}}
    <div>
        <p class="text-sm text-gray-500 mb-3">Pegawai / Anggota</p>

        <div class="flex flex-wrap gap-4">
            @foreach ($perjalanan->pegawai as $p)
                <div
                    class="flex items-center gap-4
                           px-5 py-3 rounded-2xl
                           bg-gradient-to-br from-blue-50 to-white
                           border border-blue-100
                           shadow-sm">

                    <div class="h-10 w-10 rounded-full bg-blue-600 text-white
                                flex items-center justify-center font-bold">
                        {{ strtoupper(substr($p->name, 0, 1)) }}
                    </div>

                    <div>
                        <p class="font-semibold text-gray-800">
                            {{ $p->name }}
                        </p>
                        <p class="text-xs text-gray-500">
                            {{ $p->jabatan ?? '—' }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- DETAIL --}}
    <div class="grid md:grid-cols-3 gap-6">

        {{-- TUJUAN --}}
        <div class="rounded-2xl border border-gray-100 p-5">
            <p class="text-sm text-gray-500 mb-1">Tujuan</p>
            <p class="font-semibold text-gray-800">
                {{ $perjalanan->tujuan }}
            </p>
        </div>

        {{-- TANGGAL --}}
        <div class="rounded-2xl border border-gray-100 p-5">
            <p class="text-sm text-gray-500 mb-1">Tanggal</p>
            <p class="font-semibold text-gray-800 leading-relaxed">
                {{ \Carbon\Carbon::parse($perjalanan->tanggal_berangkat)->format('d M Y') }}
                <span class="text-gray-400">—</span>
                {{ \Carbon\Carbon::parse($perjalanan->tanggal_pulang)->format('d M Y') }}
            </p>
        </div>

        {{-- ANGGARAN --}}
        <div class="rounded-2xl border border-green-100 bg-green-50/50 p-5">
            <p class="text-sm text-gray-500 mb-1">Anggaran</p>
            <p class="text-lg font-bold text-green-700">
                Rp {{ number_format($perjalanan->anggaran, 0, ',', '.') }}
            </p>
        </div>

    </div>
</div>

        {{-- DETAIL KEGIATAN --}}
        <div class="bg-white rounded-2xl shadow p-6">
            <h3 class="text-lg font-bold mb-4">Detail Kegiatan</h3>

    <table class="w-full table-fixed text-sm border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Ringkasan Kegiatan</th>
                        <th class="px-4 py-2 text-center">Foto</th>
                        <th class="px-4 py-2 text-center">Laporan</th>
                        <th class="px-4 py-2 text-center">Status</th>
                        @if($user && $user->role === 'admin')
                            <th class="px-4 py-2 text-center">Aksi</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                    @forelse($perjalanan->detailPerjalanan as $detail)
                        <tr class="border-t">
                            <td class="px-4 py-2 overflow-wrap-anywhere">
                                {{ $detail->ringkasan_kegiatan }}
                            </td>

                            {{-- FOTO KEGIATAN (OPSI 3) --}}
<td class="px-4 py-2 text-center">
    @if($detail->foto_kegiatan)
        <div
            class="mx-auto w-40 h-28 rounded-xl overflow-hidden
                   bg-gray-100 border shadow-sm cursor-pointer group"
            onclick="openImageModal('{{ asset('storage/'.$detail->foto_kegiatan) }}')"
        >
            <img
                src="{{ asset('storage/'.$detail->foto_kegiatan) }}"
                alt="Foto kegiatan"
                class="w-full h-full object-contain bg-white
                       transition-transform duration-300
                       group-hover:scale-105"
            >
        </div>

        <p class="mt-1 text-xs text-gray-500">
            Klik untuk memperbesar
        </p>
    @else
        <span class="text-gray-400 text-xs">Tidak ada</span>
    @endif
</td>


                            <td class="px-4 py-2 text-center">
                                @if($detail->laporan)
                                    <a href="{{ asset('storage/'.$detail->laporan) }}"
                                       target="_blank"
                                       class="text-blue-600 underline">
                                        Lihat
                                    </a>
                                @else
                                    <span class="text-gray-400 text-xs">Belum upload</span>
                                @endif
                            </td>

                            <td class="px-4 py-2 text-center">
                                @if($user && $user->role === 'admin')
                                    <form action="{{ route('detail-perjalanan-dinas.update-status', $detail->id) }}"
                                          method="POST">
                                        @csrf
                                        @method('PUT')

                                        <select name="status"
                                                onchange="this.form.submit()"
                                                class="text-xs rounded-lg border-gray-300">
                                            <option value="belum_selesai" @selected($detail->status === 'belum_selesai')>
                                                Belum Selesai
                                            </option>
                                            <option value="berjalan" @selected($detail->status === 'berjalan')>
                                                Berjalan
                                            </option>
                                            <option value="selesai" @selected($detail->status === 'selesai')>
                                                Selesai
                                            </option>
                                        </select>
                                    </form>
                                @else
                                    <span @class([
                                        'px-3 py-1 rounded-full text-xs',
                                        'bg-gray-100 text-gray-600' => $detail->status === 'belum_selesai',
                                        'bg-yellow-100 text-yellow-700' => $detail->status === 'berjalan',
                                        'bg-green-100 text-green-700' => $detail->status === 'selesai',
                                    ])>
                                        {{ ucwords(str_replace('_', ' ', $detail->status)) }}
                                    </span>
                                @endif
                                @if($user && $user->role === 'admin')
    <td class="px-4 py-2 text-center">
        <form action="{{ route('detail-perjalanan-dinas.destroy', $detail->id) }}"
              method="POST"
              onsubmit="return confirm('Yakin ingin menghapus detail kegiatan ini?')">
            @csrf
            @method('DELETE')

            <button type="submit"
                    class="bg-red-100 text-red-600 hover:bg-red-200
                           px-3 py-1 rounded-lg text-xs font-semibold transition">
                🗑 Hapus
            </button>
        </form>
    </td>
@endif

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-400">
                                Belum ada detail kegiatan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
{{-- FORM TAMBAH DETAIL --}}
@if(
    $user &&
    in_array($user->role, ['admin', 'pegawai']) &&
    $perjalanan->detailPerjalanan->isEmpty()
)
    <div class="mt-8 bg-white rounded-2xl shadow-lg p-6">
        <h3 class="text-lg font-bold mb-6 flex items-center gap-2">
            📝 Tambah Detail Kegiatan
        </h3>

        <form action="{{ route('detail-perjalanan-dinas.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-6">
            @csrf

            <input type="hidden" name="perjalanan_dinas_id" value="{{ $perjalanan->id }}">

            {{-- Ringkasan --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Ringkasan Kegiatan
                </label>
                <textarea
                    name="ringkasan_kegiatan"
                    rows="4"
                    required
                    placeholder="Tuliskan ringkasan kegiatan selama perjalanan dinas..."
                    class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                ></textarea>
            </div>

{{-- Upload Foto --}}
<div>
    <label class="block text-sm font-medium text-gray-700 mb-3">
        Foto Kegiatan
    </label>

    <div class="flex items-start gap-8">
        {{-- LEFT : Upload --}}
        <div class="space-y-2">
            <label
                class="inline-flex items-center gap-2 cursor-pointer
                       bg-blue-50 text-blue-700 px-5 py-2 rounded-xl
                       text-sm font-semibold hover:bg-blue-100 transition">
                📷 Pilih Foto
                <input type="file"
                       name="foto_kegiatan"
                       accept="image/*"
                       class="hidden"
                       onchange="previewFoto(event)">
            </label>

            <p class="text-xs text-gray-500">
                JPG / PNG • Maks 2MB
            </p>
        </div>

        {{-- RIGHT : Preview --}}
        <div id="foto-preview-wrapper" class="hidden">
            <div class="relative w-[360px] h-[240px] rounded-2xl overflow-hidden shadow-xl group bg-gray-100">
                <img id="foto-preview"
                     class="w-full h-full object-contain bg-white">

                {{-- Overlay --}}
                <div
                    class="absolute inset-0 bg-black/40 opacity-0
                           group-hover:opacity-100 transition
                           flex flex-col items-center justify-center gap-3 text-white">
                    <p id="foto-name"
                       class="text-xs bg-black/60 px-3 py-1 rounded-lg max-w-[90%] truncate"></p>

                    <button type="button"
                            onclick="removeFoto()"
                            class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg text-sm font-semibold">
                        ❌ Hapus Foto
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- Upload Laporan --}}
<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">
        File Laporan (PDF)
    </label>

    <label
        id="laporan-wrapper"
        class="flex items-center gap-3 cursor-pointer
               border border-dashed border-gray-300
               rounded-xl px-4 py-3
               hover:bg-gray-50 transition">

        <span id="laporan-icon">📄</span>

        <span id="laporan-name" class="text-sm text-gray-600">
            Upload file laporan (PDF)
        </span>

        <input
            type="file"
            name="laporan"
            accept="application/pdf"
            class="hidden"
            onchange="showLaporanName(event)">
    </label>

    <p id="laporan-info"
       class="mt-2 hidden text-xs text-gray-500">
        Klik lagi untuk mengganti file
    </p>
</div>

            {{-- Button --}}
            <div class="flex justify-end">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-xl shadow transition">
                    💾 Simpan Detail
                </button>
            </div>
        </form>
    </div>
@endif


        </div>
    </div>

    {{-- SCRIPT PREVIEW FOTO --}}
<script>
    function openImageModal(src) {
        const modal = document.getElementById('image-modal');
        const img = document.getElementById('image-modal-content');

        img.src = src;
        modal.classList.remove('hidden');
        modal.classList.add('flex'); 
    }

    function closeImageModal() {
        const modal = document.getElementById('image-modal');
        const img = document.getElementById('image-modal-content');

        img.src = '';

        modal.classList.remove('flex'); 
        modal.classList.add('hidden');
    }
</script>

<script>
    function previewFoto(event) {
        const file = event.target.files[0];
        if (!file) return;

        if (!file.type.startsWith('image/')) {
            alert('File harus berupa gambar');
            event.target.value = '';
            return;
        }

        const img = document.getElementById('foto-preview');
        const wrapper = document.getElementById('foto-preview-wrapper');

        img.src = URL.createObjectURL(file);
        img.onload = () => URL.revokeObjectURL(img.src);

        document.getElementById('foto-name').innerText = file.name;
        wrapper.classList.remove('hidden');
    }

    function removeFoto() {
        document.querySelector('input[name="foto_kegiatan"]').value = '';
        document.getElementById('foto-preview').src = '';
        document.getElementById('foto-preview-wrapper').classList.add('hidden');
    }
</script>

<script>
    function showLaporanName(event) {
        const file = event.target.files[0];
        if (!file) return;

        if (file.type !== 'application/pdf') {
            alert('File harus berupa PDF');
            event.target.value = '';
            return;
        }

        // Update text
        document.getElementById('laporan-name').textContent = file.name;
        document.getElementById('laporan-info').classList.remove('hidden');

        // Visual feedback
        const wrapper = document.getElementById('laporan-wrapper');
        wrapper.classList.remove('border-gray-300');
        wrapper.classList.add('border-green-400', 'bg-green-50');

        document.getElementById('laporan-icon').textContent = '✅';
    }
</script>

{{-- MODAL PREVIEW FOTO --}}
@push('modals')
<div
    id="image-modal"
    class="fixed inset-0 z-[9999]
           bg-black/70 backdrop-blur-sm
           items-center justify-center
           hidden"
>
    <button
        onclick="closeImageModal()"
        class="absolute top-6 right-6
               text-white text-4xl font-bold">
        ×
    </button>

    <img
        id="image-modal-content"
        class="max-w-[90vw] max-h-[85vh]
               object-contain bg-black
               rounded-xl shadow-2xl">
</div>
@endpush
<script>
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            const modal = document.getElementById('image-modal');

            // cek apakah modal sedang terbuka
            if (!modal.classList.contains('hidden')) {
                closeImageModal();
            }
        }
    });
</script>



</x-app-layout>
