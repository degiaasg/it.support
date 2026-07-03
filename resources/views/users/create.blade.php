<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Tambah User') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('users.store') }}" method="POST" class="max-w-lg">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="name" value="Nama" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-1" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="email" value="Email" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email')" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="password" value="Password" />
                            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" required />
                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="password_confirmation" value="Konfirmasi Password" />
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" required />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="role" value="Role" />
                            <select id="role" name="role" class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm dark:shadow-gray-900">
                                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="technician" {{ old('role') === 'technician' ? 'selected' : '' }}>Technician</option>
                                <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-1" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="phone" value="Telepon" />
                            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone')" />
                            <x-input-error :messages="$errors->get('phone')" class="mt-1" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="position" value="Posisi" />
                            <x-text-input id="position" name="position" type="text" class="mt-1 block w-full" :value="old('position')" />
                            <x-input-error :messages="$errors->get('position')" class="mt-1" />
                        </div>

                        <div class="flex items-center gap-3">
                            <x-primary-button>Simpan</x-primary-button>
                            <a href="{{ route('users.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
