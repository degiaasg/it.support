<nav x-data="{ 
    open: false,
    get dark() {
        return document.documentElement.classList.contains('dark');
    },
    toggleDark() {
        var isDark = !this.dark;
        document.documentElement.classList.toggle('dark', isDark);
        localStorage.setItem('darkMode', isDark);
    }
}">
    <!-- Mobile header with toggle -->
    <div class="lg:hidden flex items-center justify-between bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-4 h-16">
        <a href="{{ route('dashboard') }}" class="shrink-0">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
        </a>
        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{'hidden': open, 'inline-flex': ! open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{'hidden': ! open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Mobile drawer -->
    <template x-teleport="body">
        <div x-show="open" class="relative z-50 lg:hidden" x-cloak>
            <div x-show="open" @click="open = false" class="fixed inset-0 bg-gray-900/50 dark:bg-gray-950/70 transition-opacity"></div>
            <div x-show="open" @click.away="open = false" class="fixed inset-y-0 left-0 w-64 bg-white dark:bg-gray-800 shadow-xl flex flex-col">
                <div class="flex items-center justify-between h-16 px-6 border-b border-gray-200 dark:border-gray-700 shrink-0">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <x-application-logo class="block h-8 w-auto fill-current text-gray-800 dark:text-gray-200" />
                        <span class="font-semibold text-base text-gray-800 dark:text-gray-200">IT Maintenance</span>
                    </a>
                    <button @click="open = false" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto px-3 py-4 space-y-1">
                    @include('partials.sidebar-menu')
                </div>

                <div class="shrink-0 border-t border-gray-200 dark:border-gray-700">
                    <button @click="toggleDark(); open = false" class="flex items-center gap-3 w-full px-4 py-3 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <template x-if="!dark">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                        </template>
                        <template x-if="dark">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </template>
                        <span x-text="dark ? 'Terang' : 'Gelap'"></span>
                    </button>

                    <div class="border-t border-gray-200 dark:border-gray-700 p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center text-sm font-medium text-gray-600 dark:text-gray-300 shrink-0">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 dark:text-gray-200 truncate">{{ Auth::user()->name }}</p>
                                <p class="text-xs mt-0.5">
                                    <span class="px-1.5 py-0.5 text-xs rounded
                                        @if(auth()->user()->role === 'admin') bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200
                                        @elseif(auth()->user()->role === 'technician') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                        @else bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                        @endif">{{ ucfirst(auth()->user()->role) }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="mt-3 space-y-1">
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-3 py-2 text-sm rounded-lg text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center gap-2 w-full px-3 py-2 text-sm rounded-lg text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <!-- Desktop sidebar -->
    <div class="hidden lg:fixed lg:inset-y-0 lg:flex lg:w-64 lg:flex-col bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700">
        <div class="flex items-center h-16 px-6 border-b border-gray-200 dark:border-gray-700 shrink-0">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                <span class="font-semibold text-lg text-gray-800 dark:text-gray-200">IT Maintenance</span>
            </a>
        </div>

        <div class="flex-1 overflow-y-auto px-3 py-4 space-y-1">
            @include('partials.sidebar-menu')
        </div>

        <div class="shrink-0 border-t border-gray-200 dark:border-gray-700">
            <button @click="toggleDark()" class="flex items-center gap-3 w-full px-4 py-3 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-150">
                <template x-if="!dark">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                </template>
                <template x-if="dark">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </template>
                <span x-text="dark ? 'Terang' : 'Gelap'"></span>
            </button>

            <div class="border-t border-gray-200 dark:border-gray-700 p-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center text-sm font-medium text-gray-600 dark:text-gray-300 shrink-0">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-gray-200 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs mt-0.5">
                            <span class="px-1.5 py-0.5 text-xs rounded
                                @if(auth()->user()->role === 'admin') bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200
                                @elseif(auth()->user()->role === 'technician') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                @else bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                @endif">{{ ucfirst(auth()->user()->role) }}</span>
                        </p>
                    </div>
                    <div x-data="{ profileOpen: false }" class="relative shrink-0">
                        <button @click="profileOpen = ! profileOpen" class="p-1 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 rounded hover:bg-gray-100 dark:hover:bg-gray-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg>
                        </button>
                        <div x-show="profileOpen" @click.away="profileOpen = false" class="absolute left-0 bottom-full mb-2 w-48 bg-white dark:bg-gray-700 rounded-md shadow-lg border border-gray-200 dark:border-gray-600 z-50" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 rounded-t-md">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 rounded-b-md">Log Out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
