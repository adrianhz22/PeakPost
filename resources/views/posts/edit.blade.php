<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Editar Post</title>


    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>

</head>
<body class="bg-gray-100">
<x-navigation/>

<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg mt-10">
    <h1 class="text-3xl font-bold mb-6 text-center">Editar Post</h1>

    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label class="block font-semibold">Título:</label>
        <input type="text" name="title" value="{{ old('title', $post->title) }}"
               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4">
        @error('title')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <label class="block font-semibold">Contenido:</label>
        <input id="body" type="hidden" name="body" value="{{ old('body', $post->body) }}">
        <trix-editor input="body" class="mb-4"></trix-editor>
        @error('body')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <div class="mb-4">
            <label class="block font-semibold">Imagen Actual:</label>
            <img src="{{ $post->image }}" class="w-full h-64 object-cover rounded-lg">
        </div>

        <div class="dropzone border-2 border-dashed p-6 text-center" id="imagenDropzone">
        </div>
        <input type="hidden" name="image">
        @error('image')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <button type="submit" class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg mt-6 hover:bg-blue-700">
            Guardar Cambios
        </button>
    </form>

    <a href="{{ route('home') }}" class="block text-center mt-4 text-gray-500 hover:underline">Volver</a>
</div>

</body>
</html>

