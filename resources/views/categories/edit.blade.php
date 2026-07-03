<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Edit Kategori') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg p-6">
                <form action="{{ route('categories.update', $category) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                        <input type="text" name="name" value="{{ old('name', $category->name) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm dark:shadow-gray-900 focus:border-blue-500 focus:ring-blue-500" required>
                        @error('name') <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Slug</label>
                        <input type="text" name="slug" value="{{ old('slug', $category->slug) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm dark:shadow-gray-900 focus:border-blue-500 focus:ring-blue-500" required>
                        @error('slug') <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                        <textarea name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm dark:shadow-gray-900 focus:border-blue-500 focus:ring-blue-500">{{ old('description', $category->description) }}</textarea>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="bg-blue-500 dark:bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">Update</button>
                        <a href="{{ route('categories.index') }}" class="bg-gray-300 dark:bg-gray-700 hover:bg-gray-400 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-bold py-2 px-4 rounded text-sm">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
