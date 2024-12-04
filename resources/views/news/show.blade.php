<x-app-layout>
    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
        <div class="flex justify-between px-4 mx-auto max-w-screen-xl">
            <article
                class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                <header class="mb-4 lg:mb-6 not-format">
                    <address class="flex items-center mb-6 not-italic">
                        <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                            <img class="mr-4 w-16 h-16 rounded-full" src="https://picsum.photos/64"
                                alt="{{ $news->user?->name ?? 'Anonymous' }}">
                            <div>
                                <a href="#" rel="author" class="text-xl font-bold text-gray-900 dark:text-white">
                                    {{ $news->user?->name ?? 'Anonymous' }}
                                </a>
                                <p class="text-base text-gray-500 dark:text-gray-400">Author</p>
                                <p class="text-base text-gray-500 dark:text-gray-400">
                                    <time pubdate
                                        datetime="{{ $news->created_at }}">{{ $news->created_at->format('M d, Y') }}</time>
                                </p>
                            </div>
                        </div>
                    </address>
                    <h1
                        class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">
                        {{ $news->title }}
                    </h1>
                </header>

                @if(!empty($news->summary))
                    <p class="lead">{{ $news->summary }}</p>
                @endif

                @if(!empty($news->image_url))
                    <figure>
                        <img src="{{ $news->image_url }}" alt="{{ $news->title }}" class="rounded-lg w-full mb-4">
                        @if(!empty($news->caption))
                            <figcaption class="text-gray-500 dark:text-gray-400 text-sm">
                                {{ $news->caption }}
                            </figcaption>
                        @endif
                    </figure>
                @endif

                <p>{{ $news->content }}</p>

                {{-- Mensajes de éxito o error --}}
                @if(session('success'))
                    <div class="p-4 mb-4 text-sm text-green-800 bg-green-100 rounded-lg" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="p-4 mb-4 text-sm text-red-800 bg-red-100 rounded-lg" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <h2 class="mt-8 text-2xl font-bold">Comentarios</h2>
                @if($news->comments->isNotEmpty())
                    <section class="mt-4 space-y-4">
                        @foreach($news->comments as $comment)
                            <article class="p-4 border rounded-lg bg-gray-100 dark:bg-gray-800">
                                <div class="flex justify-between items-center">
                                    <p class="text-sm font-bold text-gray-900 dark:text-white">
                                        {{ $comment->user?->name ?? 'Usuario Anónimo' }}
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $comment->created_at->format('d M, Y') }}
                                    </p>
                                </div>
                                <p class="mt-2 text-gray-700 dark:text-gray-300">{{ $comment->content }}</p>

                                <!-- Botón para eliminar el comentario -->
                                @if($comment->user_id === auth()->id())
                                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            Eliminar
                                        </button>
                                    </form>
                                @endif
                            </article>
                        @endforeach
                    </section>
                @else
                    <p class="text-gray-500 dark:text-gray-400 mt-4">No hay comentarios en esta noticia.</p>
                @endif

                <!-- Formulario para crear comentario -->
                <form method="POST" action="{{ route('news.comments.store', $news->id) }}" class="mt-6">
                    @csrf
                    <textarea name="content" rows="4"
                        class="block w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-gray-100"
                        placeholder="Escribe tu comentario aquí..." required></textarea>
                    <button type="submit"
                        class="mt-2 px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700">
                        Enviar
                    </button>
                </form>

                {{-- Botón para editar --}}
                @if($news->user_id === auth()->id())
                    <div class="mt-8">
                        <a href="{{ route('news.edit', $news->id) }}"
                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Editar Noticia
                        </a>
                    </div>
                @endif
            </article>
        </div>
    </main>
</x-app-layout>
