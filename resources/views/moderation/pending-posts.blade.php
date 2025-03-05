<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revision de posts</title>
</head>
<body>

<x-navigation/>

<h1>Posts pendientes</h1>

@if($posts->count() > 0)
    @foreach($posts as $post)
        <div>
            <h2>{{ $post->title }}</h2>
            <p><strong>Autor:</strong> {{ $post->user->name }}</p>
            <p>{{ Str::limit($post->body, 150) }}</p>

            <a href="{{ route('moderation.pending-show', $post) }}">Ver mas</a>

            <form action="" method="POST">
                @csrf
                @method('PUT')
                <button type="submit">Aprobar</button>
            </form>

            <form action="" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Rechazar</button>
            </form>
        </div>
        <hr>
    @endforeach
@else
    <p>No hay posts pendientes</p>
@endif

</body>
</html>

