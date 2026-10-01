<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-extrabold text-gray-800 dark:text-gray-100">
                    Perjalanan Dinas
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Manajemen perjalanan dinas & dokumen pendukung
                </p>
            </div>

            <div class="flex items-center gap-3">


                {{-- TOMBOL TAMBAH (ADMIN SAJA) --}}
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('perjalanan-dinas.create') }}"
                       class="inline-flex items-center gap-2
                              bg-gradient-to-r from-blue-600 to-indigo-600
                              hover:from-blue-700 hover:to-indigo-700
                              text-white px-5 py-2.5 rounded-xl shadow-lg transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Data
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 space-y-8">

            {{-- ALERT --}}
            @if(session('success'))
                <div class="bg-green-50 border border-green-200
                            text-green-800 px-5 py-4 rounded-xl shadow">
                    {{ session('success') }}
                </div>
            @endif

{{-- FILTER --}}
<form method="GET"
      class="bg-white dark:bg-gray-800
             rounded-2xl shadow-lg p-6
             flex flex-wrap gap-4 items-center">

    <select name="bulan" class="rounded-xl border-gray-300">
        <option value="">Semua Bulan</option>
        @for($i = 1; $i <= 12; $i++)
            <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                Bulan {{ $i }}
            </option>
        @endfor
    </select>

    <select name="tahun" class="rounded-xl border-gray-300">
        <option value="">Semua Tahun</option>
        @for($y = date('Y'); $y >= date('Y') - 5; $y--)
            <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>
                {{ $y }}
            </option>
        @endfor
    </select>

    <button class="bg-gray-900 text-white px-5 py-2 rounded-xl">
        Terapkan
    </button>

    <div class="ml-auto flex gap-2">
        <a target="_blank"
           href="{{ route('perjalanan-dinas.preview.pdf', request()->query()) }}"
           class="bg-blue-500 text-white px-4 py-2 rounded-xl">
            Preview
        </a>

        <a href="{{ route('perjalanan-dinas.export.pdf', request()->query()) }}"
           class="bg-red-500 text-white px-4 py-2 rounded-xl">
            Export
        </a>
    </div>
</form>

            {{-- SUMMARY --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gradient-to-br from-green-500 to-emerald-600
                                text-white p-6 rounded-2xl shadow-xl">
                        <p class="text-sm opacity-80">Total Anggaran</p>
                        <p class="text-2xl font-extrabold mt-2">
                            Rp {{ number_format($totalAnggaran ?? 0) }}
                        </p>
                    </div>
                </div>

            {{-- TABLE --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr class="uppercase text-xs">
                                <th class="px-4 py-4">No</th>
                                <th class="px-4 py-4">Pegawai</th>
                                <th class="px-4 py-4">Tujuan</th>
                                <th class="px-4 py-4">Tanggal</th>
                                <th class="px-4 py-4">Anggaran</th>
                                <th class="px-4 py-4 text-center">Dokumen</th>
                                <th class="px-4 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">
                            @foreach($data as $i => $item)
                                <tr>
                                    <td class="px-4 py-4 text-center">{{ $i + 1 }}</td>

<td class="px-4 py-4 space-y-1">
    @foreach ($item->pegawai as $p)
        <div>
            <b>{{ $p->name }}</b><br>
            <span class="text-xs text-gray-500">
                {{ $p->jabatan ?? '-' }}
            </span>
        </div>
    @endforeach
</td>

                                    <td class="px-4 py-4">{{ $item->tujuan }}</td>

                                    <td class="px-4 py-4 text-xs">
                                        {{ $item->tanggal_berangkat }}<br>
                                        s/d {{ $item->tanggal_pulang }}
                                    </td>

                                    <td class="px-4 py-4 font-bold text-green-600">
                                        Rp {{ number_format($item->anggaran) }}
                                    </td>

                                    {{-- DOKUMEN --}}
                                    <td class="px-4 py-4 text-center space-y-2">
                                        @if($item->surat_tugas)
                                            <a href="{{ route('perjalanan-dinas.preview-surat-tugas', $item->id) }}"
                                               target="_blank"
                                               class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs">
                                                📄 Surat Tugas
                                            </a>
                                        @endif

                                        @if($item->detailPerjalanan->whereNotNull('laporan')->count())
                                            @php
                                                $laporan = $item->detailPerjalanan->whereNotNull('laporan')->first();
                                            @endphp
                                            <a href="{{ route('detail-perjalanan-dinas.preview-laporan', $laporan->id) }}"
                                               target="_blank"
                                               class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs">
                                                📝 Laporan Perjalanan
                                            </a>
                                        @else
                                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-600 text-xs">
                                                📝 Belum Upload
                                            </span>
                                        @endif
                                    </td>

                                    {{-- AKSI --}}
                                    <td class="px-4 py-4 text-center">
                                        <a href="{{ route('perjalanan-dinas.show', $item->id) }}"
                                           class="px-4 py-1.5 rounded-lg bg-gray-200 text-xs">
                                            Detail
                                        </a>

                                        @if(auth()->user()->role === 'admin')
                                            <div class="mt-2 flex justify-center gap-2">
                                                <a href="{{ route('perjalanan-dinas.edit', $item->id) }}"
                                                   class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs">
                                                    Edit
                                                </a>

                                                <form action="{{ route('perjalanan-dinas.destroy', $item->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Hapus data ini?')"
                                                            class="px-3 py-1 bg-red-100 text-red-700 rounded-lg text-xs">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
