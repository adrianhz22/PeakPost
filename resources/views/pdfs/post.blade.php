<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Descarga</title>
    <style>
        h1 {
            color: darkblue;
        }
    </style>
</head>
<body>
    <h1>{{ $post->title }}</h1>
    <p><strong>Autor:</strong> {{ $post->user->name }}</p>
    <p><strong>Contenido:</strong> {{ $post->body }}</p>
    <p><strong>Fecha de publicacion:</strong> {{ $post->created_at->format('d/m/Y') }}</p>
</body>
</html>
