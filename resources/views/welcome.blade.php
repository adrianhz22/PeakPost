<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido | PeakPost</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100">

<section class="relative w-full h-screen bg-cover bg-center" style="background-image: url('/assets/banner.jpg');">
    <div class="absolute inset-0 bg-black bg-opacity-60"></div>
    <div class="relative flex flex-col justify-center items-center h-full text-center text-white px-6">
        <h1 class="text-5xl font-extrabold mb-4">Bienvenido a <span class="text-blue-400">PeakPost</span></h1>
        <p class="text-lg text-gray-300 max-w-2xl">Descubre, comparte y documenta tus mejores aventuras en la montaña.</p>
        <div class="mt-8 space-x-4">
            <a href="{{ route('login') }}"
               class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold transition">
                Iniciar Sesión
            </a>
            <a href="{{ route('register') }}"
               class="bg-gray-900 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                Registrarse
            </a>
        </div>
    </div>
</section>

<section class="py-16 bg-white text-gray-700">
    <div class="max-w-5xl mx-auto px-6">
        <h2 class="text-4xl font-bold text-center text-gray-800 mb-8">Sobre Nosotros</h2>
        <p class="text-lg text-center text-gray-600 max-w-3xl mx-auto">
            PeakPost es una plataforma diseñada para los amantes de la montaña y la aventura. Comparte tus
            experiencias, encuentra nuevas rutas y conecta con otros exploradores como tú.
        </p>
    </div>
</section>

<section class="py-16 bg-gray-100">
    <div class="max-w-5xl mx-auto px-6 grid md:grid-cols-3 gap-8">

        <div class="bg-white shadow-lg rounded-lg p-6 text-center">
            <h3 class="text-2xl font-bold text-gray-800">Explora Nuevas Rutas</h3>
            <p class="text-gray-600 mt-2">Encuentra senderos increíbles y aventúrate en nuevas experiencias.</p>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6 text-center">
            <h3 class="text-2xl font-bold text-gray-800">Comparte tu Experiencia</h3>
            <p class="text-gray-600 mt-2">Publica fotos y relatos de tus excursiones favoritas.</p>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6 text-center">
            <h3 class="text-2xl font-bold text-gray-800">Conéctate con la Comunidad</h3>
            <p class="text-gray-600 mt-2">Únete a otros aventureros y descubre nuevas historias.</p>
        </div>
    </div>
</section>

<footer class="py-8 bg-gray-900 text-white text-center">
    <p class="text-gray-400">&copy; 2025 PeakPost. Todos los derechos reservados.</p>
</footer>

</body>
</html>

