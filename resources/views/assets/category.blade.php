<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $category['label'] }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach($items as $item)
                @php $itemSlug = \Illuminate\Support\Str::slug($item['name']); @endphp
                <a href="{{ route('assets.item', ['slug' => $slug, 'item' => $itemSlug]) }}" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg p-6 block hover:ring-2 hover:ring-indigo-500 dark:hover:ring-indigo-400 transition-all duration-150">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ $item['name'] }}</div>
                    <div class="text-4xl font-bold mt-2 text-gray-900 dark:text-gray-100">{{ $item['total'] }}</div>
                    <div class="text-xs text-gray-400 dark:text-gray-500 mt-3 space-y-1">
                        <div class="flex justify-between">
                            <span>Tersedia</span>
                            <span class="font-medium text-green-600 dark:text-green-400">{{ $item['available'] }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Digunakan</span>
                            <span class="font-medium text-blue-600 dark:text-blue-400">{{ $item['in_use'] }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Maintenance</span>
                            <span class="font-medium text-yellow-600 dark:text-yellow-400">{{ $item['maintenance'] }}</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
