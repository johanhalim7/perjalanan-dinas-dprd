<aside
    class="fixed inset-y-0 left-0 bg-white dark:bg-gray-900
           border-r border-gray-200 dark:border-gray-700
           transition-all duration-300 z-40"
    :class="sidebarOpen ? 'w-64' : 'w-22'"
>

    {{-- HEADER --}}
    <div class="flex items-center justify-between p-4 border-b dark:border-gray-700">
        <div class="flex items-center gap-3 overflow-hidden">
            <span class="text-xl">🏛️</span>
            <div x-show="sidebarOpen" x-transition>
                <div class="font-bold text-sm">SIPD DPRD</div>
                <div class="text-xs text-gray-500">Kota Cirebon</div>
            </div>
        </div>

        {{-- TOGGLE --}}
        <button
            @click="sidebarOpen = !sidebarOpen"
            class="p-1 rounded hover:bg-gray-100 dark:hover:bg-gray-800"
        >
            <svg class="w-5 h-5 transform transition-transform"
                 :class="sidebarOpen ? '' : 'rotate-180'"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
    </div>

    {{-- MENU --}}
    <nav class="px-2 py-4 space-y-1">

        {{-- DASHBOARD --}}
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg transition
           {{ request()->routeIs('dashboard') 
                ? 'bg-blue-100 text-blue-700 font-semibold' 
                : 'hover:bg-blue-50' }}">
            🏠
            <span x-show="sidebarOpen">Dashboard</span>
        </a>

        {{-- PERJALANAN DINAS --}}
        <a href="{{ route('perjalanan-dinas.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg transition
           {{ request()->routeIs('perjalanan-dinas.*') 
                ? 'bg-blue-100 text-blue-700 font-semibold' 
                : 'hover:bg-blue-50' }}">
            ✈️
            <span x-show="sidebarOpen">Perjalanan Dinas</span>
        </a>

                {{-- PROFIL --}}
        <a href="{{ route('profile.edit') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg transition
           {{ request()->routeIs('profile.*')
                ? 'bg-blue-100 text-blue-700 font-semibold'
                : 'hover:bg-blue-50' }}">
            👤
            <span x-show="sidebarOpen">Profil Saya</span>
        </a>

        {{-- LOGOUT --}}
        <form method="POST" action="{{ route('logout') }}" class="pt-4">
            @csrf
            <button
                class="flex items-center gap-3 w-full px-3 py-2 rounded-lg
                       text-red-600 transition hover:bg-red-50">
                🚪
                <span x-show="sidebarOpen">Logout</span>
            </button>
        </form>

    </nav>
</aside>
