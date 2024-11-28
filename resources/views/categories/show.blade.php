<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold mb-8 text-gray-900">{{ $category->name }}</h1>

            <!-- Grid de Noticias -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($news as $newsItem)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition-transform duration-300">
                        <img class="w-full h-48 object-cover" src="{{ $newsItem->image_url }}" alt="{{ $newsItem->title }}">
                        <div class="p-6 flex flex-col">
                            <!-- Título -->
                            <h2 class="text-xl font-bold text-gray-800 mb-2">
                                {{ $newsItem->title }}
                            </h2>

                            <!-- Autor y Fecha -->
                            <div class="flex items-center text-sm text-gray-500 mb-4">
                                <img class="w-8 h-8 rounded-full mr-2" src="https://i.pravatar.cc/150?u={{ $newsItem->user_id }}" alt="User Avatar">
                                <div>
                                    <p>{{ $newsItem->user->name ?? 'Anonymous' }}</p>
                                    <p class="text-xs">{{ $newsItem->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>

                            <!-- Contenido Breve -->
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                {{ Str::limit($newsItem->content, 100) }}
                            </p>

                            <!-- Botón Leer Más -->
                            <a href="{{ route('news.show', $newsItem->id) }}" class="mt-auto inline-flex items-center text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md font-medium text-sm transition">
                                Leer más
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Paginación -->
            <div class="mt-8">
                {{ $news->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
