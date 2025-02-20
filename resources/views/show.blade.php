<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio</title>
    @vite(['resources/css/app.css'])
</head>

<body>

<a href="/edit/{{ $post->id }}">Editar</a>

<form action="/destroy/{{ $post->id }}" method="POST">
    @csrf
    @method('DELETE')

    <button type="submit">
        Eliminar
    </button>
</form>

<h1>Post en detalle</h1></br>

<h2 class="text-2xl">{{ $post->title }}</h2>
</br>
<p>{{ $post->body }}</p>

<a href="{{ route('home') }}">Volver</a>

</body>
</html>
