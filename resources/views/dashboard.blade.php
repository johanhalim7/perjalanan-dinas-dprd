<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                    Dashboard
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Ringkasan aktivitas & statistik perjalanan dinas
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- WELCOME CARD --}}
            <div class="relative overflow-hidden rounded-2xl shadow-lg
                        bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-600
                        text-white p-8">
                <div class="absolute right-0 top-0 opacity-20 text-8xl select-none">
                    🏢
                </div>

                <h3 class="text-3xl font-bold mb-2">
                    Selamat Datang, {{ auth()->user()->name }} 👋
                </h3>
                <p class="text-sm opacity-90 max-w-xl">
                    Anda berada di Sistem Informasi Perjalanan Dinas
                    DPRD Kota Cirebon. Kelola data perjalanan, dokumen,
                    dan laporan secara terpusat dan aman.
                </p>
            </div>

            {{-- STATISTIK --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                {{-- TOTAL PERJALANAN --}}
                <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow
                            hover:shadow-xl transition p-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Total Perjalanan
                    </p>
                    <p class="text-3xl font-extrabold text-gray-800 dark:text-white mt-2">
                        {{ $totalPerjalanan }}
                    </p>
                </div>

                {{-- TOTAL ANGGARAN --}}
                <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow
                            hover:shadow-xl transition p-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Total Anggaran
                    </p>
                    <p class="text-2xl font-bold text-green-600 mt-2">
                        Rp {{ number_format($totalAnggaran) }}
                    </p>
                </div>

                {{-- TAHUN AKTIF --}}
                <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow
                            hover:shadow-xl transition p-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Tahun Aktif
                    </p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-white mt-2">
                        {{ $tahunAktif }}
                    </p>
                </div>

                {{-- STATUS USER --}}
                <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow
                            hover:shadow-xl transition p-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Status Akun
                    </p>
                    <p class="text-xl font-semibold mt-2
                        {{ auth()->user()->role === 'admin'
                            ? 'text-blue-600'
                            : 'text-indigo-600' }}">
                        {{ ucfirst(auth()->user()->role) }}
                    </p>
                </div>
            </div>

            {{-- QUICK ACTION --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
                <h4 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-4">
                    Aksi Cepat
                </h4>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">

                    <a href="{{ route('perjalanan-dinas.index') }}"
                       class="flex items-center gap-3 p-4 rounded-xl
                              bg-blue-50 hover:bg-blue-100
                              dark:bg-blue-900/30 dark:hover:bg-blue-900/50
                              transition">
                        <span class="text-2xl">📋</span>
                        <div>
                            <p class="font-semibold text-gray-800 dark:text-white">
                                Data Perjalanan
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Lihat & kelola data
                            </p>
                        </div>
                    </a>

                    @if(auth()->user()->role === 'admin')
                    <a href="{{ route('perjalanan-dinas.create') }}"
                       class="flex items-center gap-3 p-4 rounded-xl
                              bg-green-50 hover:bg-green-100
                              dark:bg-green-900/30 dark:hover:bg-green-900/50
                              transition">
                        <span class="text-2xl">➕</span>
                        <div>
                            <p class="font-semibold text-gray-800 dark:text-white">
                                Tambah Perjalanan
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Input perjalanan dinas
                            </p>
                        </div>
                    </a>

                    <a href="{{ route('register') }}"
                       class="flex items-center gap-3 p-4 rounded-xl
                              bg-green-50 hover:bg-green-100
                              dark:bg-green-900/30 dark:hover:bg-green-900/50
                              transition">
                        <span class="text-2xl">➕</span>
                        <div>
                            <p class="font-semibold text-gray-800 dark:text-white">
                                Tambah User
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Input user baru
                            </p>
                        </div>
                    </a>
                    @endif

                    <a href="{{ route('profile.edit') }}"
                       class="flex items-center gap-3 p-4 rounded-xl
                              bg-gray-50 hover:bg-gray-100
                              dark:bg-gray-700 dark:hover:bg-gray-600
                              transition">
                        <span class="text-2xl">👤</span>
                        <div>
                            <p class="font-semibold text-gray-800 dark:text-white">
                                Profil Saya
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Pengaturan akun
                            </p>
                        </div>
                    </a>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
