<x-app-layout>
    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
        <div class="px-4 mx-auto max-w-screen-xl">
            <h1 class="mb-4 text-4xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-5xl dark:text-white">Categories</h1>
            <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($categories as $category)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ $category->name }}</h2>
                        <p class="text-gray-500 dark:text-gray-400">{{ $category->description ?? 'No description available.' }}</p>
                        <a href="{{ route('categories.show', $category->slug) }}" class="mt-4 inline-block text-blue-600 hover:underline">
                            View News
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
</x-app-layout>
