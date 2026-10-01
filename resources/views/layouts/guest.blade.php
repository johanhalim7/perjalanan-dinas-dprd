<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Sistem Informasi Perjalanan Dinas DPRD Kota Cirebon') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* === CINEMATIC REVEAL (SAMA DENGAN LANDING PAGE) === */
        .reveal {
            opacity: 0;
            transform: translateY(60px) scale(.96);
            transition: all 1s cubic-bezier(.16,1,.3,1);
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
        .delay-1 { transition-delay: .15s; }
        .delay-2 { transition-delay: .3s; }
        .delay-3 { transition-delay: .45s; }

        /* soft grain */
        .grain::after {
            content:"";
            position:absolute;
            inset:0;
            background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='120' height='120'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.9' numOctaves='4'/%3E%3C/filter%3E%3Crect width='120' height='120' filter='url(%23n)' opacity='.03'/%3E%3C/svg%3E");
            pointer-events:none;
        }
    </style>
</head>

<body class="font-sans antialiased text-white">

<!-- NAVBAR -->
<nav id="navbar"
     class="fixed inset-x-0 top-0 z-50 h-16
            bg-gray-900/70 backdrop-blur-xl
            border-b border-white/10 transition-all">
    <div class="w-full px-6 h-full flex items-center justify-between">

        <!-- BRAND -->
        <div class="flex items-center gap-4">
            <img src="{{ asset('favicon.png') }}"
                 alt="Logo DPRD Kota Cirebon"
                 class="h-10 w-10 object-contain">

            <div class="leading-tight">
                <div class="text-sm font-semibold text-white">
                    DPRD Kota Cirebon
                </div>
                <div class="text-xs text-gray-400">
                    Sistem Informasi Perjalanan Dinas
                </div>
            </div>
        </div>

        <!-- KEMBALI -->
        <a href="{{ url('/') }}"
           class="inline-flex items-center gap-2
                  border border-white/30 text-white
                  font-semibold text-sm
                  px-6 py-2.5 rounded-xl
                  hover:bg-white/10 transition">
            ← Kembali
        </a>
    </div>
</nav>

<!-- CANVAS -->
<div class="relative min-h-screen overflow-hidden grain
            bg-gradient-to-br from-blue-800 via-indigo-700 to-purple-800">

    <!-- LIGHT BEAMS -->
    <div class="absolute inset-y-0 right-0 w-[420px]
                bg-gradient-to-b from-white/10 via-white/5 to-transparent
                blur-[60px]"></div>

    <!-- ORBS -->
    <div class="absolute -top-1/3 -left-1/4 w-[700px] h-[700px]
                bg-white/10 rounded-full blur-[160px]"></div>
    <div class="absolute -bottom-1/3 -right-1/4 w-[700px] h-[700px]
                bg-black/30 rounded-full blur-[180px]"></div>

    <div class="relative max-w-7xl mx-auto px-6 pt-36 pb-24
                grid grid-cols-1 lg:grid-cols-2 gap-24 items-center">

        <!-- LEFT STORY -->
        <div class="hidden lg:block reveal">
            <span class="inline-flex items-center gap-2
                         mb-8 px-5 py-2 rounded-full
                         bg-white/10 text-sm tracking-wide
                         reveal delay-1">
                🏛️ Platform Resmi Pemerintah Daerah
            </span>

            <h1 class="text-6xl font-bold leading-tight mb-10 reveal delay-2">
                Sistem Informasi<br>
                <span class="text-blue-200">Perjalanan Dinas</span>
            </h1>

            <p class="text-white/80 text-lg leading-relaxed max-w-xl reveal delay-3">
                Portal internal resmi DPRD Kota Cirebon untuk pengelolaan
                perjalanan dinas yang
                <span class="font-semibold text-white">
                    tertib, transparan, dan terdokumentasi
                </span>
                dalam satu platform terintegrasi.
            </p>

            <div class="mt-20 text-sm text-white/50 reveal delay-3">
                © 2026 DPRD Kota Cirebon
            </div>
        </div>

        <!-- RIGHT SLOT -->
        <div class="flex justify-center lg:justify-end">
            {{ $slot }}
        </div>

    </div>
</div>

<script>
    const reveal = () => {
        document.querySelectorAll('.reveal').forEach(el => {
            if (el.getBoundingClientRect().top < window.innerHeight - 120) {
                el.classList.add('active');
            }
        });
    };

    window.addEventListener('load', reveal);
    window.addEventListener('scroll', reveal);
</script>

</body>
</html>
