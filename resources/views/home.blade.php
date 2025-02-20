<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio</title>
    @vite(['resources/css/app.css'])
</head>

<body>

<h1>Pagina de inicio</h1>
<p>Contenido de la pagina de inicio</p></br>

<a href="{{ route('create') }}">+ Crear post</a>

<div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

    @foreach($posts as $post)
        <div class="bg-amber-100 p-4">
            <a href="/post/{{ $post->id }}" class="text-2xl">{{ $post->title }}</a>
            <p>{{ $post->body }}</p>
        </div>
    @endforeach
</div>

<footer class="bg-gray-200 text-center">
    <p>©2025 Todos los derechos reservados PeakPost
    <p>
</footer>

</body>
</html>
