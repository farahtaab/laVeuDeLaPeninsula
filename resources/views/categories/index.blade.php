<x-app-layout>
    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
        <div class="px-4 mx-auto max-w-screen-xl">
            <h1 class="mb-4 text-4xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-5xl dark:text-white">
                Noticias de {{ $category->name }}
            </h1>
            @if ($news->isNotEmpty())
                <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($news as $singleNews)
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                            <img src="{{ $singleNews->image_url }}" alt="{{ $singleNews->title }}" class="rounded-t-lg w-full h-40 object-cover mb-4">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                                {{ $singleNews->title }}
                            </h2>
                            <p class="text-gray-500 dark:text-gray-400">
                                {{ Str::limit($singleNews->content, 100) }}
                            </p>
                            <a href="{{ route('news.show', $singleNews->id) }}" class="mt-4 inline-block text-blue-600 dark:text-blue-400 hover:underline">
                                Leer más →
                            </a>

                            <!-- Eliminar noticia si pertenece al usuario autenticado -->
                            @if ($singleNews->user_id === auth()->id())
                                <form action="{{ route('news.destroy', $singleNews->id) }}" method="POST" class="mt-4">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-800">
                                        Eliminar Noticia
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>

                <!-- Paginación -->
                <div class="mt-8">
                    {{ $news->links() }}
                </div>
            @else
                <p class="text-gray-500 dark:text-gray-400 mt-6">
                    No hay noticias disponibles para esta categoría.
                </p>
            @endif
        </div>
    </main>
</x-app-layout>
