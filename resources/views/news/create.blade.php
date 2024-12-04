<x-app-layout>
    <section class="bg-gray-50 dark:bg-gray-900 py-16">
        <div class="px-4 mx-auto max-w-screen-xl">
            <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-8 text-center">
                Crear Notícia
            </h2>

            <!-- Formulario para crear noticia -->
            <form action="{{ route('news.store') }}" method="POST" class="max-w-lg mx-auto">
                @csrf
                <!-- Título -->
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 dark:text-gray-300 text-sm font-semibold mb-2">Títol</label>
                    <input type="text" id="title" name="title" class="w-full p-3 border border-gray-300 rounded-lg" required>
                </div>

                <!-- Contenido -->
                <div class="mb-4">
                    <label for="content" class="block text-gray-700 dark:text-gray-300 text-sm font-semibold mb-2">Contingut</label>
                    <textarea id="content" name="content" rows="5" class="w-full p-3 border border-gray-300 rounded-lg" required></textarea>
                </div>

                <!-- URL de la imagen -->
                <div class="mb-4">
                    <label for="image_url" class="block text-gray-700 dark:text-gray-300 text-sm font-semibold mb-2">URL de la Imatge</label>
                    <input type="url" id="image_url" name="image_url" class="w-full p-3 border border-gray-300 rounded-lg" required>
                </div>

                <!-- Categoría -->
                <div class="mb-4">
                    <label for="category_id" class="block text-gray-700 dark:text-gray-300 text-sm font-semibold mb-2">Categoria</label>
                    <select id="category_id" name="category_id" class="w-full p-3 border border-gray-300 rounded-lg" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Botón de enviar -->
                <button type="submit" class="w-full px-6 py-3 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                    Crear Notícia
                </button>
            </form>
        </div>
    </section>
</x-app-layout>
