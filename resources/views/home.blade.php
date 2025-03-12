<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    @vite(['resources/css/app.css'])

</head>

<body>
<x-navigation/>

@if(session('success'))
    <div class="bg-green-600 text-white text-center p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-center mb-6">Página de Inicio</h1>

    <div class="flex justify-end mb-4">
        <a href="{{ route('posts.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700">
            + Crear Post
        </a>
    </div>

    <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($posts as $post)
            <div class="bg-white p-4 rounded-lg shadow-lg border">

                <img src="{{ $post->image }}" class="w-full h-48 object-cover rounded-lg" alt="Imagen del post">

                <h2 class="mt-3 text-xl font-semibold">
                    <a href="{{ route('posts.show', $post->id) }}" class="text-blue-600 hover:underline">
                        {{ $post->title }}
                    </a>
                </h2>
                <p class="mt-2 text-gray-700 break-words">{!! Str::limit(strip_tags($post->body, 100)) !!}</p>
                <livewire:like-post :post="$post" />
            </div>
        @endforeach
    </div>
</div>

<footer class="bg-gray-200 text-center p-4 mt-8">
    <p>©2025 Todos los derechos reservados PeakPost</p>
</footer>
</body>
</html>
