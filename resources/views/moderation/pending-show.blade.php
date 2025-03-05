<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revisión del Post</title>
</head>
<body>

<x-navigation/>

<h1>{{ $post->title }}</h1>
<p><strong>Autor:</strong> {{ $post->user->name }}</p>
<p>{{ $post->body }}</p>

<form action="{{ route('moderation.approve', $post) }}" method="POST">
    @csrf
    @method('PUT')
    <button type="submit">Aprobar</button>
</form>

<form action="{{ route('moderation.reject', $post) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Rechazar</button>
</form>

<a href="{{ route('moderation.pending-posts') }}">Volver a la lista</a>

</body>
</html>
