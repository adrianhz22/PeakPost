<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Posts</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100 text-gray-900">

<x-navigation/>

<div class="container mx-auto mt-10 px-4">
    <h1 class="text-3xl font-bold text-center mb-6">Mis Publicaciones</h1>

    @if($posts->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($posts as $post)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="{{ asset($post->image) }}" alt="Imagen de {{ $post->title }}" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <h2 class="text-xl font-semibold">{{ $post->title }}</h2>
                        <p class="text-gray-600 mt-2">{!! Str::limit(strip_tags($post->body, 100)) !!}</p>
                        <a href="{{ route('posts.show', $post->id) }}"
                           class="inline-block mt-3 text-blue-500 hover:underline">
                            Ver más
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center">
            <p class="text-gray-600 text-lg mb-4">Vaya... Parece que aún no has publicado nada. ¡Porque no comenzar ahora!</p>
            <a href="{{ route('posts.create') }}"
               class="bg-blue-500 text-white px-6 py-2 rounded-3xl hover:bg-blue-600">
                +
            </a>
        </div>
    @endif

</div>

</body>
</html>


