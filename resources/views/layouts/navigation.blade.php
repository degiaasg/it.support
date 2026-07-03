<nav x-data="{ open: false }">
    <!-- Mobile header with toggle -->
    <div class="lg:hidden flex items-center justify-between bg-white border-b border-gray-200 px-4 h-16">
        <a href="{{ route('dashboard') }}" class="shrink-0">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
        </a>
        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{'hidden': open, 'inline-flex': ! open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{'hidden': ! open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Mobile overlay + sidebar -->
    <template x-teleport="body">
        <div x-show="open" class="relative z-50 lg:hidden">
            <div x-show="open" @click="open = false" class="fixed inset-0 bg-gray-900/50 transition-opacity"></div>
            <div x-show="open" @click.away="open = false" class="fixed inset-y-0 left-0 w-64 bg-white shadow-xl">
                <div class="flex items-center h-16 px-6 border-b border-gray-200">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <x-application-logo class="block h-8 w-auto fill-current text-gray-800" />
                        <span class="font-semibold text-base text-gray-800">IT Maintenance</span>
                    </a>
                </div>
                <div class="overflow-y-auto px-3 py-4 space-y-1 h-[calc(100%-4rem)]">
                    <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span>Dashboard</span>
                    </x-sidebar-link>
                    <x-sidebar-link :href="route('devices.index')" :active="request()->routeIs('devices.*')">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>Perangkat</span>
                    </x-sidebar-link>
                    <x-sidebar-link :href="route('tickets.index')" :active="request()->routeIs('tickets.*')">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        <span>Tiket</span>
                    </x-sidebar-link>
                    @if(auth()->user()->role !== 'user')
                    <div class="pt-4 pb-2">
                        <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Manajemen</p>
                    </div>
                    <x-sidebar-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        <span>Kategori</span>
                    </x-sidebar-link>
                    <x-sidebar-link :href="route('maintenance-logs.index')" :active="request()->routeIs('maintenance-logs.*')">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        <span>Maintenance</span>
                    </x-sidebar-link>
                    <x-sidebar-link :href="route('spare-parts.index')" :active="request()->routeIs('spare-parts.*')">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        <span>Spare Part</span>
                    </x-sidebar-link>
                    <x-sidebar-link :href="route('reports.index')" :active="request()->routeIs('reports.*')">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span>Laporan</span>
                    </x-sidebar-link>
                    @endif
                </div>
            </div>
        </div>
    </template>

    <!-- Desktop sidebar -->
    <div class="hidden lg:fixed lg:inset-y-0 lg:flex lg:w-64 lg:flex-col bg-white border-r border-gray-200">
        <div class="flex items-center h-16 px-6 border-b border-gray-200 shrink-0">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                <span class="font-semibold text-lg text-gray-800">IT Maintenance</span>
            </a>
        </div>

        <div class="flex-1 overflow-y-auto px-3 py-4 space-y-1">
            <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span>Dashboard</span>
            </x-sidebar-link>

            <x-sidebar-link :href="route('devices.index')" :active="request()->routeIs('devices.*')">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <span>Perangkat</span>
            </x-sidebar-link>

            <x-sidebar-link :href="route('tickets.index')" :active="request()->routeIs('tickets.*')">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                <span>Tiket</span>
            </x-sidebar-link>

            @if(auth()->user()->role !== 'user')
            <div class="pt-4 pb-2">
                <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Manajemen</p>
            </div>

            <x-sidebar-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                <span>Kategori</span>
            </x-sidebar-link>

            <x-sidebar-link :href="route('maintenance-logs.index')" :active="request()->routeIs('maintenance-logs.*')">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                <span>Maintenance</span>
            </x-sidebar-link>

            <x-sidebar-link :href="route('spare-parts.index')" :active="request()->routeIs('spare-parts.*')">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                <span>Spare Part</span>
            </x-sidebar-link>

            <x-sidebar-link :href="route('reports.index')" :active="request()->routeIs('reports.*')">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span>Laporan</span>
            </x-sidebar-link>
            @endif
        </div>

        <div class="shrink-0 border-t border-gray-200 p-4">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-sm font-medium text-gray-600 shrink-0">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs mt-0.5">
                        <span class="px-1.5 py-0.5 text-xs rounded
                            @if(auth()->user()->role === 'admin') bg-purple-100 text-purple-800
                            @elseif(auth()->user()->role === 'technician') bg-blue-100 text-blue-800
                            @else bg-green-100 text-green-800
                            @endif">{{ ucfirst(auth()->user()->role) }}</span>
                    </p>
                </div>
                <div x-data="{ open: false }" class="relative shrink-0">
                    <button @click="open = ! open" class="p-1 text-gray-400 hover:text-gray-600 rounded hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute left-0 bottom-full mb-2 w-48 bg-white rounded-md shadow-lg border border-gray-200 z-50" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-t-md">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-b-md">Log Out</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
