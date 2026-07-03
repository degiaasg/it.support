<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Manajemen User') }}</h2>
            <a href="{{ route('users.create') }}" class="bg-blue-500 dark:bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">+ Tambah User</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="bg-green-100 dark:bg-green-900/50 border border-green-400 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
            @endif
            @if(session('error'))
            <div class="bg-red-100 dark:bg-red-900/50 border border-red-400 dark:border-red-800 text-red-700 dark:text-red-300 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="border-b dark:border-gray-700">
                                <th class="text-left py-3 px-2">Nama</th>
                                <th class="text-left py-3 px-2">Email</th>
                                <th class="text-left py-3 px-2">Role</th>
                                <th class="text-left py-3 px-2">Telepon</th>
                                <th class="text-left py-3 px-2">Posisi</th>
                                <th class="text-center py-3 px-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="py-3 px-2 font-medium">{{ $user->name }}</td>
                                <td class="py-3 px-2 text-gray-500 dark:text-gray-400">{{ $user->email }}</td>
                                <td class="py-3 px-2">
                                    <span class="px-2 py-1 text-xs rounded
                                        @if($user->role === 'admin') bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200
                                        @elseif($user->role === 'technician') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                        @else bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                        @endif">{{ ucfirst($user->role) }}</span>
                                </td>
                                <td class="py-3 px-2 text-gray-500 dark:text-gray-400">{{ $user->phone ?? '-' }}</td>
                                <td class="py-3 px-2 text-gray-500 dark:text-gray-400">{{ $user->position ?? '-' }}</td>
                                <td class="py-3 px-2 text-center">
                                    <a href="{{ route('users.edit', $user) }}" class="text-blue-600 dark:text-blue-400 hover:underline text-xs me-2">Edit</a>
                                    @if($user->id !== auth()->id())
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:underline text-xs">Hapus</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-6 text-center text-gray-500 dark:text-gray-400">Belum ada user.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">{{ $users->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
