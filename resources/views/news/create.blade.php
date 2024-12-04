<x-app-layout>
    <main class="py-12">
        <div class="max-w-4xl mx-auto px-4">
            
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">Crear Notícia</h1>

            @if ($errors->any())
                <div class="mb-6">
                    <ul class="list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('news.store') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Título</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" 
                           class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Contenido</label>
                    <textarea id="content" name="content" rows="6" 
                              class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('content') }}</textarea>
                </div>

                <div> 
                    <label for="image_url" class="block text-sm font-medium text-gray-700 dark:text-gray-400">URL de Imagen</label>
                    <input type="url" id="image_url" name="image_url" value="{{ old('image_url') }}" 
                           class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Categoría</label>
                    <select id="category_id" name="category_id" 
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <button type="submit" 
                            class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-blue-300">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </main>
</x-app-layout>
