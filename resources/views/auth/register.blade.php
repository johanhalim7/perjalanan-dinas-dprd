<x-guest-layout>
    <div class="relative w-full max-w-md
                bg-white/10 backdrop-blur-xl
                border border-white/20
                rounded-[40px] p-12
                shadow-[0_60px_160px_rgba(0,0,0,.7)]
                transition-all duration-500
                reveal delay-2">

        <!-- GLOW EDGE -->
        <div class="absolute inset-0 rounded-[40px]
                    bg-gradient-to-br from-blue-400/20 via-transparent to-purple-400/20
                    opacity-60 pointer-events-none"></div>

        <!-- HEADER -->
        <div class="relative text-center mb-12 reveal delay-3">
            <div class="flex justify-center mb-6">
                <div class="h-16 w-16 rounded-3xl
                            bg-white/10 backdrop-blur
                            flex items-center justify-center
                            shadow-lg">
                    <img src="{{ asset('favicon.png') }}"
                         class="h-10 w-10 object-contain"
                         alt="Logo DPRD">
                </div>
            </div>

            <h2 class="text-3xl font-bold mb-3">
                Registrasi Akun
            </h2>

            <p class="text-sm text-white/60">
                Buat akun untuk mengakses<br>
                Sistem Informasi Perjalanan Dinas
            </p>
        </div>

        <form method="POST" action="{{ route('register') }}"
              class="space-y-7 relative reveal delay-3">
            @csrf

            <!-- NAMA -->
            <div>
                <label class="block text-xs uppercase tracking-widest
                              text-white/50 mb-2">
                    Nama Lengkap
                </label>
                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       required autofocus
                       class="w-full px-4 py-3.5 rounded-xl
                              bg-white/10 text-white
                              border border-white/20
                              placeholder-white/40
                              focus:ring-2 focus:ring-blue-400
                              transition-all">
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            <!-- EMAIL -->
            <div>
                <label class="block text-xs uppercase tracking-widest
                              text-white/50 mb-2">
                    Email
                </label>
                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       class="w-full px-4 py-3.5 rounded-xl
                              bg-white/10 text-white
                              border border-white/20
                              placeholder-white/40
                              focus:ring-2 focus:ring-blue-400
                              transition-all">
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- PASSWORD -->
            <div>
                <label class="block text-xs uppercase tracking-widest
                              text-white/50 mb-2">
                    Password
                </label>
                <input type="password"
                       name="password"
                       required
                       class="w-full px-4 py-3.5 rounded-xl
                              bg-white/10 text-white
                              border border-white/20
                              placeholder-white/40
                              focus:ring-2 focus:ring-blue-400
                              transition-all">
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- KONFIRMASI PASSWORD -->
            <div>
                <label class="block text-xs uppercase tracking-widest
                              text-white/50 mb-2">
                    Konfirmasi Password
                </label>
                <input type="password"
                       name="password_confirmation"
                       required
                       class="w-full px-4 py-3.5 rounded-xl
                              bg-white/10 text-white
                              border border-white/20
                              placeholder-white/40
                              focus:ring-2 focus:ring-blue-400
                              transition-all">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </div>

            <!-- FOOTER ACTION -->
            <div class="flex items-center justify-between pt-4 text-sm text-white/60">
                <a href="{{ route('login') }}"
                   class="hover:text-white transition">
                    Sudah punya akun?
                </a>

                <button type="submit" 
                        class="bg-white text-gray-900
                               font-semibold px-6 py-3.5 rounded-xl
                               hover:bg-gray-100
                               active:scale-[.98]
                               transition-all shadow-lg">
                    Daftar
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
