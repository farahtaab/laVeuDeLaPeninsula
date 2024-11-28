<x-app-layout>
    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
        <div class="flex justify-between px-4 mx-auto max-w-screen-xl">
            <article class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                <header class="mb-4 lg:mb-6 not-format">
                    <address class="flex items-center mb-6 not-italic">
                        <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                            <img class="mr-4 w-16 h-16 rounded-full" src="https://picsum.photos/64" alt="{{ $news->user?->name ?? 'Anonymous' }}">
                            <div>
                                <a href="#" rel="author" class="text-xl font-bold text-gray-900 dark:text-white">
                                    {{ $news->user?->name ?? 'Anonymous' }}
                                </a>
                                <p class="text-base text-gray-500 dark:text-gray-400">Author</p>
                                <p class="text-base text-gray-500 dark:text-gray-400">
                                    <time pubdate datetime="{{ $news->created_at }}">{{ $news->created_at->format('M d, Y') }}</time>
                                </p>
                            </div>
                        </div>
                    </address>
                    <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">
                        {{ $news->title }}
                    </h1>
                </header>

                <p class="lead">{{ $news->summary ?? 'Resumen no disponible' }}</p>

                <figure>
                    <img src="{{ $news->image_url }}" alt="{{ $news->title }}" class="rounded-lg w-full mb-4">
                    <figcaption class="text-gray-500 dark:text-gray-400 text-sm">{{ $news->caption ?? 'Sin descripción' }}</figcaption>
                </figure>

                <p>{{ $news->content }}</p>

                <h2 class="mt-8 text-2xl font-bold">Comentarios</h2>
                @if($news->comments->isNotEmpty())
                <section class="mt-4 space-y-4 comment-list">
                    @foreach($news->comments as $comment)
                    <article class="p-4 border rounded-lg bg-gray-100 dark:bg-gray-800 comment-item" data-comment-id="{{ $comment->id }}">
                        <div class="flex justify-between items-center">
                            <p class="text-sm font-bold text-gray-900 dark:text-white">
                                {{ $comment->user?->name ?? 'Usuario Anónimo' }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $comment->created_at->format('d M, Y') }}
                            </p>
                        </div>
                        <p class="mt-2 text-gray-700 dark:text-gray-300">{{ $comment->content }}</p>

                        @if($comment->user_id === auth()->id())
                        <button class="delete-comment text-red-600 hover:text-red-800 mt-2" data-comment-id="{{ $comment->id }}">Eliminar</button>
                        @endif
                    </article>
                    @endforeach
                </section>
                @else
                <p class="text-gray-500 dark:text-gray-400 mt-4">No hay comentarios en esta noticia.</p>
                @endif

                <!-- Formulario para crear comentario -->
                <form method="POST" action="{{ route('news.comments.store', $news->id) }}" class="mt-6" id="commentForm">
                    @csrf
                    <textarea
                        name="content"
                        rows="4"
                        class="block w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-gray-100"
                        placeholder="Escribe tu comentario aquí..."
                        required></textarea>
                    <button
                        type="submit"
                        class="mt-2 px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700">
                        Enviar comentario
                    </button>
                </form>

            </article>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const commentForm = document.querySelector('#commentForm');
            const commentList = document.querySelector('.comment-list');

            // Agregar un comentario
            commentForm.addEventListener('submit', function(e) {
                e.preventDefault(); // Evitar la redirección de la página

                const formData = new FormData(commentForm);
                const newsId = {{ $news->id }}; // ID de la noticia
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Obtener el token CSRF

                // Hacer la petición POST para agregar el comentario
                fetch(`/news/${newsId}/comments`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    body: formData
                })
                .then(response => response.json()) // Esperamos respuesta en formato JSON
                .then(data => {
                    if (data.comment) {
                        // Crear un nuevo comentario dinámicamente en el DOM
                        const newComment = document.createElement('article');
                        newComment.classList.add('p-4', 'border', 'rounded-lg', 'bg-gray-100', 'dark:bg-gray-800', 'comment-item');
                        newComment.setAttribute('data-comment-id', data.comment.id);
                        newComment.innerHTML = `
                            <div class="flex justify-between items-center">
                                <p class="text-sm font-bold text-gray-900 dark:text-white">${data.comment.user.name}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">${data.comment.created_at}</p>
                            </div>
                            <p class="mt-2 text-gray-700 dark:text-gray-300">${data.comment.content}</p>
                            <button class="delete-comment text-red-600 hover:text-red-800 mt-2" data-comment-id="${data.comment.id}">Eliminar</button>
                        `;
                        // Insertar el nuevo comentario en el DOM
                        commentList.prepend(newComment);
                        commentForm.reset(); // Limpiar el formulario de comentario
                    } else {
                        console.error('Error al crear el comentario');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });

            // Eliminar un comentario
            commentList.addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('delete-comment')) {
                    const commentId = e.target.getAttribute('data-comment-id');
                    const newsId = {{ $news->id }}; // ID de la noticia
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Obtener el token CSRF

                    fetch(`/news/${newsId}/comments/${commentId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': token
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message === 'Comentario eliminado con éxito.') {
                            // Eliminar el comentario del DOM
                            const commentElement = e.target.closest('.comment-item');
                            commentElement.remove();
                        } else {
                            console.error('Error al eliminar el comentario');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                }
            });
        });
    </script>
</x-app-layout>