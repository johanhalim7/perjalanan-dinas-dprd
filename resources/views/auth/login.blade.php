<x-guest-layout>
    <div class="relative w-full max-w-md
                bg-white/10 backdrop-blur-md
                border border-white/20
                rounded-[40px] p-12
                shadow-[0_30px_80px_rgba(0,0,0,.5)]
                transition-[opacity,transform] duration-500 ease-out
                will-change-transform will-change-opacity
                reveal delay-2">

        <!-- GLOW EDGE -->
        <div class="absolute inset-0 rounded-[40px]
                    bg-gradient-to-br from-blue-400/20 via-transparent to-purple-400/20
                    opacity-60 pointer-events-none"></div>

        <!-- HEADER -->
        <div class="relative text-center mb-12
                    transition-[opacity,transform] duration-500 ease-out
                    will-change-transform will-change-opacity
                    reveal delay-3">

            <div class="flex justify-center mb-6">
                <div class="h-16 w-16 rounded-3xl
                            bg-white/10 backdrop-blur-sm
                            flex items-center justify-center
                            shadow-md">
                    <img src="{{ asset('favicon.png') }}"
                         class="h-10 w-10 object-contain"
                         alt="Logo DPRD">
                </div>
            </div>

            <h2 class="text-3xl font-bold mb-3 text-white">
                Login Sistem
            </h2>

            <p class="text-sm text-white/60">
                Sistem Informasi Perjalanan Dinas<br>
                DPRD Kota Cirebon
            </p>
        </div>

        <form method="POST" action="{{ route('login') }}"
              class="space-y-7 relative
                     transition-[opacity,transform] duration-500 ease-out
                     will-change-transform will-change-opacity
                     reveal delay-3">
            @csrf

            <!-- EMAIL -->
            <div>
                <label class="block text-xs uppercase tracking-widest
                              text-white/50 mb-2">
                    Email
                </label>
                <input type="email" name="email" required autofocus
                       class="w-full px-4 py-3.5 rounded-xl
                              bg-white/10 text-white
                              border border-white/20
                              focus:ring-2 focus:ring-blue-400
                              transition-colors duration-300">
            </div>

            <!-- PASSWORD -->
            <div>
                <label class="block text-xs uppercase tracking-widest
                              text-white/50 mb-2">
                    Password
                </label>
                <input type="password" name="password" required
                       class="w-full px-4 py-3.5 rounded-xl
                              bg-white/10 text-white
                              border border-white/20
                              focus:ring-2 focus:ring-blue-400
                              transition-colors duration-300">
            </div>

            <div class="flex items-center justify-between text-sm text-white/60">
                <label class="inline-flex items-center gap-2">
                    <input type="checkbox"
                           name="remember"
                           class="rounded bg-white/10 border-white/30">
                    Ingat saya
                </label>

                <a href="{{ route('password.request') }}"
                   class="hover:text-white transition-colors">
                    Lupa password?
                </a>
            </div>

            <button type="submit"
                    class="w-full mt-6 bg-white text-gray-900
                           font-semibold py-4 rounded-xl
                           hover:bg-gray-100
                           active:scale-[.98]
                           transition-[background-color,transform]
                           duration-300 shadow-lg">
                🔐 Masuk ke Sistem
            </button>
        </form>
    </div>
</x-guest-layout>
