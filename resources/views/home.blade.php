<x-app-layout>
    <!-- Sección inicial -->
    <section class="bg-white dark:bg-gray-900">
        <div class="gap-16 items-center py-12 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
            <div class="font-light text-gray-500 sm:text-lg dark:text-gray-400 animate-fade-in">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                    La teva font d'informació a la Península
                </h2>
                <p class="mb-4">
                    Som el teu portal de notícies més proper. Cobertura completa sobre política, economia, cultura i més. La veu que fa falta per entendre el que passa al nostre voltant.
                </p>
                <p class="mb-6">
                    Des de notícies locals fins als esdeveniments internacionals, t'ofrim una visió clara i actualitzada. No et perdis mai més res!
                </p>
                <a href="#news" class="inline-flex items-center px-5 py-3 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                    Explora Notícies →
                </a>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-8 lg:mt-0">
                <img class="w-full rounded-lg shadow-lg hover:scale-105 transition-transform duration-300" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/content/office-long-2.png" alt="Notícies">
                <img class="mt-4 w-full lg:mt-10 rounded-lg shadow-lg hover:scale-105 transition-transform duration-300" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/content/office-long-1.png" alt="Notícies">
            </div>
        </div>
    </section>

    <!-- Sección de noticias dinámicas -->
    <section id="news" class="bg-gray-50 dark:bg-gray-900 py-16">
        <div class="px-4 mx-auto max-w-screen-xl">
            <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-8 text-center animate-slide-up">
                Últimes Notícies
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 masonry">
                @foreach ($news as $index => $singleNews)
                    <!-- Variar el tamaño dependiendo del índice -->
                    <div class="@if ($index % 7 === 0) col-span-2 @endif bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:scale-105 transition-transform duration-300">
                        <img class="w-full @if ($index % 7 === 0) h-60 @elseif ($index % 4 === 0) h-48 @else h-40 @endif object-cover lazyload" src="{{ $singleNews->image_url }}" alt="{{ $singleNews->title }}">
                        <div class="p-4">
                            <span class="inline-block @if ($index % 7 === 0) bg-blue-600 @elseif ($index % 4 === 0) bg-green-600 @else bg-yellow-600 @endif text-white text-xs font-semibold px-2 py-1 rounded mb-2">
                                {{ $singleNews->category->name }} 📅
                            </span>
                            <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-1 line-clamp-2">
                                {{ $singleNews->title }}
                            </h3>
                            <p class="text-xs text-gray-700 dark:text-gray-400 mb-4 line-clamp-3">
                                {{ Str::limit($singleNews->content, 120) }}
                            </p>
                            <a href="{{ route('news.show', $singleNews->id) }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                                Llegir més →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <style>
        /* Animaciones */
        .animate-fade-in {
            animation: fadeIn 1.2s ease-out;
        }

        .animate-slide-up {
            animation: slideUp 1s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Masonry layout para tarjetas */
        .masonry {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            grid-gap: 16px;
        }

        .lazyload {
            opacity: 0;
            transition: opacity 0.3s ease-in;
        }

        .lazyload[data-loaded] {
            opacity: 1;
        }
    </style>

    <script>
        // Script para Lazy Loading
        document.addEventListener("DOMContentLoaded", function () {
            const lazyImages = document.querySelectorAll("img.lazyload");
            lazyImages.forEach(img => {
                const observer = new IntersectionObserver(entries => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            img.src = img.dataset.src || img.src;
                            img.setAttribute("data-loaded", true);
                        }
                    });
                });
                observer.observe(img);
            });
        });
    </script>
</x-app-layout>
