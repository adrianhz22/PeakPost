<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Post Detalle</title>
    @vite(['resources/css/app.css'])
    <script src="https://unpkg.com/@heroicons/react/solid"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden mt-10">

    <img src="{{ $post->image }}" alt="Imagen del post" class="w-full h-64 object-cover">

    <div class="p-6">

        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $post->title }}</h1>

        <p class="text-gray-700 leading-relaxed">{!! $post->body !!}</p>

        @if(Auth::id() === $post->user_id)
            <div class="mt-6 flex space-x-4">
                <a href="/edit/{{ $post->id }}"
                   class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                    Editar
                </a>

                <form action="/destroy/{{ $post->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-red-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-red-700 transition">
                        Eliminar
                    </button>
                </form>
            </div>
        @endif

        <div class="mt-6 flex justify-between items-center">
            <a href="{{ route('post.pdf', $post->id) }}"
               class="flex items-center space-x-2 text-gray-700 hover:text-red-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 hover:text-red-700 transition"
                     viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M12 2a1 1 0 011 1v12.59l3.3-3.3a1 1 0 111.4 1.42l-5 5a1 1 0 01-1.4 0l-5-5a1 1 0 011.4-1.42L11 15.59V3a1 1 0 011-1z"
                          clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M4 19a1 1 0 011-1h14a1 1 0 011 1v2H4v-2z" clip-rule="evenodd"/>
                </svg>
                <span class="font-medium">Descargar PDF</span>
            </a>
        </div>


        <div class="mt-6 text-center">
            <a href="{{ route('home') }}" class="text-blue-500 hover:underline font-medium">
                Volver al inicio
            </a>
        </div>
    </div>

    <div class="p-6 border-t">
        <h2 class="text-xl font-semibold mb-4">Comentarios</h2>

        <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-6">
            @csrf
            <textarea name="content" rows="3" class="w-full p-2 border rounded focus:ring focus:ring-blue-300"
                      placeholder="Escribe un comentario..." required></textarea>
            <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Comentar
            </button>
        </form>

        <div class="space-y-4">
            @foreach ($post->comments as $comment)
                <div class="bg-gray-100 p-4 rounded-lg shadow mb-4">
                    <div class="flex items-center justify-between">
                        <p class="font-semibold text-gray-800">{{ $comment->user->name }}</p>
                        <span class="text-sm text-gray-500">{{ $comment->created_at->format('d/m/Y') }}</span>
                    </div>
                    <p class="text-gray-700 mt-2">{{ $comment->content }}</p>
                </div>
            @endforeach

        </div>
    </div>
</div>

</body>
</html>
