<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revisión del Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<x-navigation/>

<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden mt-10">

    <img src="{{ $post->image }}" alt="Imagen del post" class="w-full h-64 object-cover">

    <div class="p-6">

        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $post->title }}</h1>
        <p class="text-gray-600 mb-4"><strong>Autor:</strong> {{ $post->user->name }}</p>
        <p class="text-gray-700 leading-relaxed mb-6">{!! $post->body !!}</p>

        <div class="mt-4 flex justify-start space-x-4">

            <form action="{{ route('moderation.approve', $post) }}" method="POST" class="inline-block">
                @csrf
                @method('PUT')
                <button type="submit"
                        class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-700 transition">
                    Aprobar
                </button>
            </form>

            <form action="{{ route('moderation.reject', $post) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition">
                    Rechazar
                </button>
            </form>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('moderation.pending-posts') }}" class="text-blue-500 hover:underline font-medium">
                Volver a posts pendientes
            </a>
        </div>

    </div>
</div>

</body>
</html>
