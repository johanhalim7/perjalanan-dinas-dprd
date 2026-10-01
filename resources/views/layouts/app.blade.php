<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistem Informasi Perjalanan Dinas DPRD Kota Cirebon') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- App CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- ✅ SELECT2 CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
        rel="stylesheet"
    />

    <!-- 🎨 Select2 biar nyatu sama Tailwind -->
    <style>
        .select2-container .select2-selection--multiple {
            min-height: 44px;
            border-radius: 0.75rem;
            border: 1px solid #d1d5db;
            padding: 4px;
        }

        .select2-container--default
        .select2-selection--multiple
        .select2-selection__choice {
            background-color: #e0f2fe;
            border: none;
            color: #0369a1;
            padding: 4px 8px;
            border-radius: 9999px;
            font-size: 0.75rem;
        }

        .select2-selection__choice__remove {
            color: #0369a1 !important;
            margin-right: 4px;
        }

        .select2-container--default
        .select2-selection--multiple
        .select2-selection__rendered {
            display: flex;
            gap: 4px;
            flex-wrap: wrap;
        }
    </style>

    @stack('styles')
</head>

<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">

<div
    x-data="{ sidebarOpen: true }"
    class="flex min-h-screen"
>

    {{-- SIDEBAR --}}
    @auth
        @include('layouts.sidebar')
    @endauth

    {{-- MAIN CONTENT --}}
    <div
        class="flex flex-col flex-1 transition-all duration-300 ease-in-out
               max-w-full overflow-x-hidden"
        :class="sidebarOpen ? 'ml-64' : 'ml-20'"
    >

        {{-- TOP NAV --}}
        @include('layouts.navigation')

        {{-- PAGE HEADING --}}
        @if (isset($header))
            <header
                class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700
                       transition-all duration-300 ease-in-out"
                :class="sidebarOpen ? 'translate-x-0 opacity-100'
                                    : 'translate-x-2 opacity-90'"
            >
                <div class="px-6 py-3">
                    <h1 class="text-xl font-semibold tracking-tight">
                        {{ $header }}
                    </h1>
                </div>
            </header>
        @endif

        {{-- PAGE CONTENT --}}
        <main
            class="flex-1 p-6 transition-all duration-300 ease-in-out
                   max-w-full overflow-x-hidden"
            :class="sidebarOpen ? 'translate-x-0' : 'translate-x-2'"
        >
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6
                        max-w-full overflow-x-auto">
                {{ $slot }}
            </div>
        </main>

        {{-- FOOTER --}}
        <footer
            class="bg-white dark:bg-gray-800 border-t px-6 py-4 text-sm
                   text-gray-500 flex justify-between transition-all duration-300 ease-in-out"
            :class="sidebarOpen ? 'translate-x-0 opacity-100'
                                : 'translate-x-2 opacity-90'"
        >
            <span>© {{ date('Y') }} DPRD Kota Cirebon</span>
            <span>Sistem Informasi Perjalanan Dinas</span>
        </footer>

    </div>
</div>

{{-- MODALS --}}
@stack('modals')

<!-- ✅ jQuery (WAJIB UNTUK SELECT2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- ✅ SELECT2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- SCRIPT TAMBAHAN PER HALAMAN --}}
@stack('scripts')

</body>
</html>
