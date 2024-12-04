<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold mb-8 text-gray-900">Editar Notícia</h1>

            <form action="{{ route('news.update', $news->id) }}" method="POST" class="bg-white rounded-lg shadow-md p-6">
                @csrf
                @method('PUT')

                <!-- Campo Título -->
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Títol:</label>
                    <input 
                        type="text" 
                        id="title" 
                        name="title" 
                        value="{{ old('title', $news->title) }}" 
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Escriu el títol de la notícia">
                </div>

                <!-- Campo Contenido -->
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Contingut:</label>
                    <textarea 
                        id="content" 
                        name="content" 
                        rows="6" 
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Escriu el contingut de la notícia">{{ old('content', $news->content) }}</textarea>
                </div>

                <!-- Campo Categoría -->
                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Categoria:</label>
                    <select 
                        id="category_id" 
                        name="category_id" 
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $news->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Campo URL de Imagen -->
                <div class="mb-6">
                    <label for="image_url" class="block text-sm font-medium text-gray-700 mb-2">URL de la Imatge:</label>
                    <input 
                        type="url" 
                        id="image_url" 
                        name="image_url" 
                        value="{{ old('image_url', $news->image_url) }}" 
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Escriu l'URL de la imatge">
                </div>

                <!-- Botón para guardar -->
                <div class="flex justify-end">
                    <button 
                        type="submit" 
                        class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Guardar Canvis
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
