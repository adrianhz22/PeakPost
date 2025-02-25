<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Post Detalle</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100">

<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden mt-10">

    <img src="{{ $post->image }}" alt="Imagen del post"
         class="w-full h-64 object-cover">

    <div class="p-6">

        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $post->title }}</h1>

        <p class="text-gray-700 leading-relaxed">{!! $post->body !!}</p>

        <div class="mt-6 flex space-x-4">
            <a href="/edit/{{ $post->id }}"
               class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                Editar
            </a>

            <form action="/destroy/{{ $post->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-red-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-red-700 transition">
                    Eliminar
                </button>
            </form>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('home') }}"
               class="text-blue-500 hover:underline font-medium">
                Volver al inicio
            </a>
        </div>
    </div>
</div>

</body>
</html>

