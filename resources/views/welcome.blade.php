<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Welcome') }} | PeakPost</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100">

<section class="relative w-full h-screen bg-cover bg-center" style="background-image: url('/assets/banner.jpg');">
    <div class="absolute inset-0 bg-black bg-opacity-60"></div>
    <div class="relative flex flex-col justify-center items-center h-full text-center text-white px-6">
        <h1 class="text-5xl font-extrabold mb-4">{{ __('Welcome to') }} <span class="text-blue-400">PeakPost</span></h1>
        <p class="text-lg text-gray-300 max-w-2xl">{{ __('Discover, share, and document your best adventures in the mountains.') }}</p>
        <div class="mt-8 space-x-4">
            <a href="{{ route('login') }}"
               class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold transition">
                {{ __('Login') }}
            </a>
            <a href="{{ route('register') }}"
               class="bg-gray-900 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                {{ __('Register') }}
            </a>
        </div>
    </div>
</section>

<section class="py-16 bg-white text-gray-700">
    <div class="max-w-5xl mx-auto px-6">
        <h2 class="text-4xl font-bold text-center text-gray-800 mb-8">{{ __('About Us') }}</h2>
        <p class="text-lg text-center text-gray-600 max-w-3xl mx-auto">
            {{ __('PeakPost is a platform designed for mountain and adventure lovers. Share your experiences, find new routes, and connect with other explorers like you.') }}
        </p>
    </div>
</section>

<section class="py-16 bg-gray-100">
    <div class="max-w-5xl mx-auto px-6 grid md:grid-cols-3 gap-8">

        <div class="bg-white shadow-lg rounded-lg p-6 text-center">
            <h3 class="text-2xl font-bold text-gray-800">{{ __('Explore New Routes') }}</h3>
            <p class="text-gray-600 mt-2">{{ __('Find incredible trails and venture into new experiences.') }}</p>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6 text-center">
            <h3 class="text-2xl font-bold text-gray-800">{{ __('Share your experience') }}</h3>
            <p class="text-gray-600 mt-2">{{ __('Post photos and stories of your favorite excursions.') }}</p>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6 text-center">
            <h3 class="text-2xl font-bold text-gray-800">{{ __('Connect with the Community') }}</h3>
            <p class="text-gray-600 mt-2">{{ __('Join other adventurers and discover new stories.') }}</p>
        </div>
    </div>
</section>

<footer class="py-8 bg-gray-900 text-white text-center">
    <p class="text-gray-400">&copy; 2025 PeakPost. {{ __('All rights reserved.') }}</p>
</footer>

</body>
</html>

