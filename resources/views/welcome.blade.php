<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistem Informasi Perjalanan Dinas DPRD Kota Cirebon</title>

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ===== CINEMATIC REVEAL ===== */
        .reveal {
            opacity: 0;
            transform: translateY(60px) scale(.96);
            transition: all 1s cubic-bezier(.16,1,.3,1);
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        /* ===== PARALLAX FLOAT ===== */
        .float {
            animation: float 8s ease-in-out infinite;
        }
        @keyframes float {
            0%,100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        /* ===== NAV SHRINK ===== */
        .nav-shrink {
            height: 56px;
            backdrop-filter: blur(20px);
        }
    </style>
</head>

<body class="antialiased font-sans bg-gray-950 text-gray-200">

<!-- ================= NAVBAR ================= -->
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

        <!-- ACTION -->
        <a href="{{ route('login') }}"
           class="inline-flex items-center gap-2
                  bg-white text-gray-900
                  font-semibold text-sm
                  px-6 py-2.5 rounded-xl
                  hover:bg-gray-100 transition shadow-lg">
            🔐 Login Sistem
        </a>
    </div>
</nav>

<!-- ================= HERO CINEMATIC ================= -->
<section class="relative min-h-screen flex items-center overflow-hidden">

    <!-- BACKGROUND GRADIENT MESH -->
    <div class="absolute inset-0 bg-gradient-to-br from-blue-800 via-indigo-700 to-purple-800"></div>
    <div class="absolute -top-1/2 -left-1/3 w-[900px] h-[900px] bg-white/10 rounded-full blur-[120px]"></div>
    <div class="absolute -bottom-1/3 -right-1/3 w-[900px] h-[900px] bg-black/20 rounded-full blur-[140px]"></div>

    <div class="relative max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-20 items-center">

        <!-- HERO TEXT -->
        <div class="reveal text-white">
            <span class="inline-flex items-center gap-2
                         px-5 py-2 rounded-full
                         bg-white/10 text-sm mb-8">
                🏛️ Platform Resmi Pemerintah Daerah
            </span>

            <h1 class="text-5xl lg:text-6xl font-bold leading-tight mb-8">
                Sistem Informasi<br>
                <span class="text-blue-200">Perjalanan Dinas</span>
            </h1>

            <p class="text-xl text-white/90 max-w-xl mb-12">
                Solusi digital terintegrasi untuk
                <strong>pengelolaan perjalanan dinas</strong>,
                <strong>pengawasan anggaran</strong>, dan
                <strong>pelaporan resmi</strong>
                DPRD Kota Cirebon.
            </p>

            <div class="flex flex-wrap gap-4">
                <a href="{{ route('login') }}"
                   class="inline-flex items-center gap-2
                          bg-white text-gray-900
                          font-semibold px-10 py-4
                          rounded-xl shadow-2xl
                          hover:bg-gray-100 transition">
                    🚀 Masuk ke Sistem
                </a>

                <a href="#story"
                   class="inline-flex items-center gap-2
                          border border-white/40 text-white
                          px-10 py-4 rounded-xl
                          hover:bg-white/10 transition">
                    Lihat Alur Sistem
                </a>
            </div>
        </div>

        <!-- HERO VISUAL -->
        <div class="reveal float">
            <div class="relative bg-white/10 backdrop-blur-xl
                        rounded-[32px] p-10 shadow-[0_40px_120px_rgba(0,0,0,.6)]">

                <div class="space-y-4 text-white">
                    <div class="bg-white/10 rounded-xl p-4">✈️ Input Perjalanan Dinas</div>
                    <div class="bg-white/10 rounded-xl p-4">💰 Kontrol Anggaran</div>
                    <div class="bg-white/10 rounded-xl p-4">📄 Laporan PDF Resmi</div>
                    <div class="bg-white/10 rounded-xl p-4">👤 Multi User & Role</div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- ================= STORY SECTION ================= -->
<section id="story" class="py-32 bg-gray-950">
    <div class="max-w-6xl mx-auto px-6 text-center reveal">
        <h2 class="text-4xl font-bold mb-8 text-white">
            Dari Proses Manual ke Sistem Digital
        </h2>

        <p class="text-gray-400 text-lg leading-relaxed max-w-3xl mx-auto">
            Sistem ini dirancang untuk menggantikan proses administrasi perjalanan dinas
            yang sebelumnya manual dan terfragmentasi,
            menjadi <strong class="text-white">terstruktur, transparan, dan terdokumentasi</strong>
            dalam satu platform terintegrasi.
        </p>
    </div>
</section>

<!-- ================= FEATURE EXPERIENCE ================= -->
<section class="py-32 bg-gradient-to-b from-gray-950 to-gray-900">
    <div class="max-w-7xl mx-auto px-6">

        <h2 class="text-4xl font-bold text-center mb-20 reveal text-white">
            Fitur yang Dibangun untuk Instansi
        </h2>

        <div class="grid md:grid-cols-3 gap-12">

            <div class="group reveal bg-gray-900 border border-white/10
                        rounded-[28px] p-10
                        hover:-translate-y-3 hover:shadow-[0_30px_80px_rgba(0,0,0,.7)]
                        transition-all duration-500">
                <div class="text-4xl mb-6">✈️</div>
                <h3 class="text-xl font-semibold mb-4 text-white">
                    Manajemen Perjalanan
                </h3>
                <p class="text-gray-400 leading-relaxed">
                    Data perjalanan dinas dikelola secara terpusat,
                    mudah ditelusuri, dan aman.
                </p>
            </div>

            <div class="group reveal bg-gray-900 border border-white/10
                        rounded-[28px] p-10
                        hover:-translate-y-3 hover:shadow-[0_30px_80px_rgba(0,0,0,.7)]
                        transition-all duration-500">
                <div class="text-4xl mb-6">💰</div>
                <h3 class="text-xl font-semibold mb-4 text-white">
                    Pengawasan Anggaran
                </h3>
                <p class="text-gray-400 leading-relaxed">
                    Transparansi anggaran untuk mendukung
                    akuntabilitas administrasi.
                </p>
            </div>

            <div class="group reveal bg-gray-900 border border-white/10
                        rounded-[28px] p-10
                        hover:-translate-y-3 hover:shadow-[0_30px_80px_rgba(0,0,0,.7)]
                        transition-all duration-500">
                <div class="text-4xl mb-6">📄</div>
                <h3 class="text-xl font-semibold mb-4 text-white">
                    Laporan Resmi
                </h3>
                <p class="text-gray-400 leading-relaxed">
                    Generate laporan PDF resmi siap cetak dan arsip.
                </p>
            </div>

        </div>
    </div>
</section>

<!-- ================= FINAL CTA ================= -->
<section class="py-40 bg-gradient-to-br from-blue-700 to-indigo-800 text-white text-center">
    <h2 class="text-4xl font-bold mb-8 reveal">
        Sistem Siap Digunakan.
    </h2>

    <p class="text-xl text-white/90 mb-14 reveal">
        Administrasi perjalanan dinas yang rapi,
        modern, dan sesuai kebutuhan instansi.
    </p>

    <a href="{{ route('login') }}"
       class="inline-flex items-center gap-2
              bg-white text-gray-900
              font-semibold px-14 py-5
              rounded-2xl shadow-2xl
              hover:bg-gray-100 transition reveal">
        🔐 Login Sekarang
    </a>
</section>

<!-- ================= FOOTER ================= -->
<footer class="bg-black text-gray-500 py-10 text-center text-sm">
    <p class="text-gray-400 font-semibold mb-1">
        Sistem Informasi Perjalanan Dinas
    </p>
    <p>© {{ date('Y') }} DPRD Kota Cirebon</p>
</footer>

<!-- ================= SCRIPT ================= -->
<script>
    const reveal = () => {
        document.querySelectorAll('.reveal').forEach(el => {
            if (el.getBoundingClientRect().top < window.innerHeight - 120) {
                el.classList.add('active');
            }
        });
    };

    const nav = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        nav.classList.toggle('nav-shrink', window.scrollY > 40);
        reveal();
    });

    window.addEventListener('load', reveal);
</script>

</body>
</html>
