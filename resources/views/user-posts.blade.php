<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis posts</title>
    @vite(['resources/css/app.css'])
</head>

<body>
<x-navigation/>

@if($posts->count() > 0)
    @foreach($posts as $post)
        <div class="post">
            <h2>{{ $post->title }}</h2>
            <p>{{ Str::limit($post->body, 100) }}</p>
            <a href="{{ route('show', $post->id) }}">Ver más</a>
        </div>
    @endforeach
@else
    <p>Todavia no has subido nada</p>
@endif

</body>
</html>
