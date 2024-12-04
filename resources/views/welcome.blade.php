<x-guest-layout>
    <section class="bg-gray-100 dark:bg-gray-900 min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 text-center">
                Benvingut/da
            </h1>
            <p class="text-gray-600 dark:text-gray-400 mb-6 text-center">
                Inicia sessió o registra't per continuar.
            </p>
            <div class="flex flex-col space-y-4">
                <a href="{{ route('login') }}" class="w-full px-4 py-2 text-center text-white bg-blue-600 hover:bg-blue-700 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-300">
                    Inicia sessió
                </a>
                <a href="{{ route('register') }}" class="w-full px-4 py-2 text-center text-blue-600 border border-blue-600 hover:bg-blue-100 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-300">
                    Registra't
                </a>
            </div>
        </div>
    </section>
</x-guest-layout>
