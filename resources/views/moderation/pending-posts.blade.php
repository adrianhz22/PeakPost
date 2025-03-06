<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revisión de posts</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<x-navigation/>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Posts Pendientes</h1>


    @if($posts->count() > 0)
        @foreach($posts as $post)
            <div class="bg-white shadow-md rounded-lg p-6 mb-6 flex space-x-6">

                <img src="{{ $post->image }}" alt="Imagen del post" class="w-32 h-32 object-cover rounded-lg">

                <div class="flex-1">

                    <a href="{{ route('moderation.pending-show', $post) }}"
                       class="text-xl font-semibold text-gray-800 hover:text-blue-500">
                        {{ $post->title }}
                    </a>

                    <div class="text-gray-600 mt-2 flex items-center space-x-4">

                        <p><strong>Autor:</strong> {{ $post->user->name }}</p>

                        <p><strong>Fecha:</strong> {{ $post->created_at->format('d/m/Y') }}</p>
                    </div>

                    <p class="text-gray-700 mt-4">{!! Str::limit($post->body, 150) !!}</p>
                </div>
            </div>
        @endforeach
    @else
        <p class="text-center text-gray-500">No hay posts pendientes</p>
    @endif
</div>

</body>
</html>
