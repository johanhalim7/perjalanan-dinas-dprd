<nav
    x-data="{ open: false }"
    class="sticky top-0 z-50
           bg-white/80 dark:bg-gray-900/80 backdrop-blur-md
           border-b border-gray-200 dark:border-gray-700">

    <div class="px-6">
        <div class="flex h-16 items-center justify-between">

            <!-- LEFT : BRAND -->
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 group">

                    <x-application-logo
                        class="h-9 w-auto text-blue-600 dark:text-blue-400
                               group-hover:scale-105 transition-transform" />

                    <div class="hidden sm:block leading-tight">
                        <div class="text-sm font-semibold text-gray-800 dark:text-gray-100">
                            Sistem Informasi
                        </div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">
                            Perjalanan Dinas DPRD Kota Cirebon
                        </div>
                    </div>
                </a>
            </div>

            <!-- RIGHT : USER -->
            <div class="hidden sm:flex items-center gap-3">

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center gap-3 px-3 py-2 rounded-full
                                   bg-gray-100/70 dark:bg-gray-800/70
                                   hover:bg-gray-200 dark:hover:bg-gray-700
                                   transition shadow-sm">

                            <!-- Avatar -->
                            <div
                                class="h-8 w-8 rounded-full
                                       bg-gradient-to-br from-blue-600 to-indigo-600
                                       text-white flex items-center justify-center
                                       font-semibold text-sm">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>

                            <!-- Name -->
                            <div class="hidden md:block text-sm font-medium text-gray-700 dark:text-gray-200">
                                {{ Auth::user()->name }}
                            </div>

                            <!-- Chevron -->
                            <svg class="h-4 w-4 text-gray-500 transition-transform group-hover:rotate-180"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-2">
                            <div class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                                {{ Auth::user()->name }}
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ Auth::user()->email }}
                            </div>
                        </div>

                        <div class="border-t dark:border-gray-700 my-1"></div>

                        <x-dropdown-link :href="route('profile.edit')">
                            👤 Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                🚪 Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>

            </div>

            <!-- MOBILE TOGGLE -->
            <div class="flex sm:hidden">
                <button
                    @click="open = !open"
                    class="p-2 rounded-lg
                           text-gray-600 dark:text-gray-300
                           hover:bg-gray-100 dark:hover:bg-gray-800
                           transition">

                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- MOBILE MENU -->
    <div
        x-show="open"
        x-transition
        class="sm:hidden border-t border-gray-200 dark:border-gray-700
               bg-white dark:bg-gray-900">

        <div class="px-6 py-4 space-y-2">
            <x-responsive-nav-link
                :href="route('dashboard')"
                :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>

            <x-responsive-nav-link
                :href="route('perjalanan-dinas.index')"
                :active="request()->routeIs('perjalanan-dinas.*')">
                Perjalanan Dinas
            </x-responsive-nav-link>
        </div>

        <div class="border-t border-gray-200 dark:border-gray-700 px-6 py-4">
            <div class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                {{ Auth::user()->name }}
            </div>
            <div class="text-xs text-gray-500">
                {{ Auth::user()->email }}
            </div>

            <div class="mt-3 space-y-2">
                <x-responsive-nav-link :href="route('profile.edit')">
                    Profile
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link
                        :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Log Out
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
