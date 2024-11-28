<x-app-layout>
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4">Editar Noticia</h1>
        <form action="{{ route('news.update', $news->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-gray-700">Título:</label>
                <input type="text" id="title" name="title" value="{{ $news->title }}" class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label for="content" class="block text-gray-700">Contenido:</label>
                <textarea id="content" name="content" rows="6" class="w-full p-2 border rounded">{{ $news->content }}</textarea>
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-gray-700">Categoría:</label>
                <select id="category_id" name="category_id" class="w-full p-2 border rounded">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $news->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="image_url" class="block text-gray-700">URL de Imagen:</label>
                <input type="text" id="image_url" name="image_url" value="{{ $news->image_url }}" class="w-full p-2 border rounded">
            </div>

            <!-- Botón para guardar los cambios, con fondo azul y texto blanco -->
            <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Guardar Cambios
            </button>

        </form>
    </div>
</x-app-layout>
